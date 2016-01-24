<?php

namespace dokify2\objs;

use dokify2\tables\AgreementTable;
use dokify2\models\RelationModel;
use dokify2\objs\Company;
use dokify2\objs\Relation;

class Agreement extends \JNMFW\ObjBase {
	/**
	 * @var RelationModel 
	 */
	private $relationModel;
	
	/**
	 * @var Company[] 
	 */
	private $companies;
	
	/**
	 * @var Relation[]
	 */
	private $valid_relatios;
	
	public function __construct($item) {
		parent::__construct($item);
		$this->relationModel = RelationModel::getInstance();
	}
	
	/**
	 * @return AgreementTable
	 */
	public function getItem() {
		return $this->item;
	}
	
	public function toJSON() {
		$data = get_object_vars($this->getItem());
		//$data['companies'] = $this->getCompanies();
		$data['valid_relations'] = array_map(function($relation) {
			return $relation->toJSON();
		}, $this->getValidRelations());
		$data['long_name'] = $this->getLongName();
		return $data;
	}
	
	public function getLongName() {
		$names = array();
		foreach ($this->getCompanies() as $company) {
			$names[] = $company->getItem()->name;
		}
		return implode(' > ', $names);
	}
	
	/**
	 * @return Company[]
	 */
	public function getCompanies() {
		if ($this->companies) {
			return $this->companies;
		}
		
		$ids_relations = $this->db->getQueryBuilderSelect('agreement_relations')
				->columns('id_relation')
				->order($this->db->quoteName('order'), 'ASC')
				->where('id_agreement', $this->getItem()->id)
				->loadValueArray();
		
		$order = array();
		foreach ($ids_relations as $id) {
			$order[$id] = count($order);
		}
		
		
		$relations = $this->relationModel->getByIDs($ids_relations);
		$companies = array();
		
		usort($relations, function($a, $b) use ($order) {
			return $order[$a->getItem()->id] < $order[$b->getItem()->id] ? -1 : 1;
		});
		
		if ($relations) {
			//should exist at least one relation!
			$companies[] = $relations[0]->getClient();
		}
		
		foreach ($relations as $relation) {
			$companies[] = $relation->getProvider();
		}
		
		$this->companies = $companies;
		return $this->companies;
	}
	
	public function isEmpty() {
		return !count($this->getCompanies());
	}
	
	/**
	 * @return Company
	 */
	private function getFirstClient() {
		$companies = $this->getCompanies();
		return $companies ? $companies[0] : null;
	}
	
	/**
	 * @return Company
	 */
	private function getLastProvider() {
		$companies = $this->getCompanies();
		return $companies ? $companies[count($companies)-1] : null;
	}
	
	private function getCompaniesIDs() {
		$companies = $this->getCompanies();
		return array_map(function($company) {
			return $company->getItem()->id;
		}, $companies);
	}
	
	private function clearCache() {
		$this->companies = array();
		$this->valid_relatios = array();
	}
	
	/**
	 * @return Relation[]
	 */
	public function getValidRelations() {
		//get valid relations (keep downstream)
		
		if ($this->valid_relatios) {
			return $this->valid_relatios;
		}
		
		$ids_companies = $this->getCompaniesIDs();
		
		//should exist at least two companies!
		$id_company_client = $this->getFirstClient()->getItem()->id;
		$id_company_provider = $this->getLastProvider()->getItem()->id;
		
		$ids_relations = $this->db->getQueryBuilderSelect('relations')
			->columns('id')
			->setGlueOr()
			->whereOr($this->db->createConditionAnds()
				->where('provider', $id_company_client)
				->whereRaw('client NOT IN '.$this->db->quoteArray($ids_companies).'')
			)
			->whereOr($this->db->createConditionAnds()
				->where('client', $id_company_provider)
				->whereRaw('provider NOT IN '.$this->db->quoteArray($ids_companies).'')
			)
			->loadValueArray();
		
		$this->valid_relatios = $this->relationModel->getByIDs($ids_relations);
		return $this->valid_relatios;
	}
	
	/**
	 * @param int id_relation
	 */
	public function addRelation($id_relation) {
		$out = true;
		if ($this->isEmpty()) {
			$this->addClient($id_relation);
		}
		else {
			$relation = $this->relationModel->getByID($id_relation);
			if ($relation->getClient()->getItem()->id == $this->getLastProvider()->getItem()->id) {
				$this->addProvider($id_relation);
			}
			elseif ($relation->getProvider()->getItem()->id == $this->getFirstClient()->getItem()->id) {
				$this->addClient($id_relation);
			}
			else {
				$out = false; //invalid relation!
			}
		}
		$this->clearCache();
		return $out;
	}
	
	private function addClient($id_relation) {
		$this->db->getQueryBuilderUpdate('agreement_relations')
			->set(array(
				'order' => $this->db->quoteName('order').' + 1'
			), false)
			->where('id_agreement', $this->getItem()->id)
			->execute();
		
		return $this->db->getQueryBuilderInsert('agreement_relations')
			->data(array(
				'id_agreement' => $this->getItem()->id,
				'id_relation' => $id_relation,
				'order' => 1
			))
			->execute();
	}
	
	private function addProvider($id_relation) {
		$order = $this->db->getQueryBuilderSelect('agreement_relations')
				->columns('MAX('.$this->db->quoteName('order').')')
				->where('id_agreement', $this->getItem()->id)
				->loadValue();
		$order = $order ? $order+1 : 1;
		
		return $this->db->getQueryBuilderInsert('agreement_relations')
			->data(array(
				'id_agreement' => $this->getItem()->id,
				'id_relation' => $id_relation,
				'order' => $order
			))
			->execute();
	}
}
