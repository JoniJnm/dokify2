<?php

namespace dokify2\objs;

use dokify2\tables\RelationTable;
use dokify2\models\CompanyModel;
use dokify2\objs\Company;

class Relation extends \JNMFW\ObjBase {
	/**
	 * @var CompanyModel 
	 */
	private $companyModel;
	
	public function __construct($item) {
		parent::__construct($item);
		$this->companyModel = CompanyModel::getInstance();
	}
	
	/**
	 * @return RelationTable
	 */
	public function getItem() {
		return $this->item;
	}
	
	/**
	 * @return Company
	 */
	public function getClient() {
		return $this->companyModel->getByID($this->getItem()->client);
	}
	
	public function toJSON() {
		$data = get_object_vars($this->getItem());
		$data['name'] = $this->getName();
		return $data;
	}
	
	/**
	 * @return Company
	 */
	public function getProvider() {
		return $this->companyModel->getByID($this->getItem()->provider);
	}
	
	public function getName() {
		$client = $this->getClient();
		$provider = $this->getProvider();
		
		return $client->getItem()->name.' > '.$provider->getItem()->name;
	}
	
	public function inAgrement() {
		return !!$this->db->getQueryBuilderSelect('agreement_relations')
			->columns('id_agreement')
			->where('id_relation', $this->getItem()->id)
			->limit(1)
			->loadValue();
	}
}
