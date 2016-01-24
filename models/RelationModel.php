<?php

namespace dokify2\models;

use dokify2\objs\Relation;
use dokify2\models\CompanyModel;
use JNMFW\helpers\HLang;
use dokify2\langs\Lang;

class RelationModel extends BaseModel {
	private $companyModel;
	
	public function __construct() {
		parent::__construct();
		$this->companyModel = CompanyModel::getInstance();
	}
	
	/**
	 * @return RelationModel
	 */
	public static function getInstance() {
		return parent::getInstance();
	}
	
	/**
	 * @return Relation
	 */
	public function getByID($id) {
		return parent::getObjByID($id, 'Relation');
	}
	
	/**
	 * @return Relation[]
	 */
	public function getByIDs($ids) {
		return parent::getObjsByIDs($ids, 'Relation');
	}
	
	/**
	 * @return Relation[]
	 */
	public function getAll() {
		return parent::getObjs('Relation');
	}
	
	public function exists($id_client, $id_provider) {
		return !!$this->db->getQueryBuilderSelect('relations')
			->columns('id')
			->where('client', $id_client)
			->where('provider', $id_provider)
			->loadValue();
	}
	
	public function getForCompanyID($id) {
		$data = array();
		
		//get proviers
		
		$ids = $this->db->getQueryBuilderSelect('relations')
			->columns('provider')
			->where('client', $id)
			->loadValueArray();
		
		$companies = $this->companyModel->getByIDs($ids);
		foreach ($companies as $company) {
			$item = $company->getItem();
			$data[] = array(
				'id' => $item->id,
				'name' => $item->name,
				'relation' => HLang::get(Lang::generic_provider)
			);
		}
		
		//get clients
		
		$ids = $this->db->getQueryBuilderSelect('relations')
			->columns('client')
			->where('provider', $id)
			->loadValueArray();
		
		$companies = $this->companyModel->getByIDs($ids);
		foreach ($companies as $company) {
			$item = $company->getItem();
			$data[] = array(
				'id' => $item->id,
				'name' => $item->name,
				'relation' => HLang::get(Lang::generic_client)
			);
		}
		
		return $data;
	}
}
