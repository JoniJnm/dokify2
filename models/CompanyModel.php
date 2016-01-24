<?php

namespace dokify2\models;

use dokify2\objs\Company;

class CompanyModel extends BaseModel {
	/**
	 * @return CompanyModel
	 */
	public static function getInstance() {
		return parent::getInstance();
	}
	
	public function exists($name) {
		return !!$this->db->getQueryBuilderSelect('companies')
			->columns('id')
			->where('name', $name)
			->loadValue();
	}
	
	/**
	 * @return Company
	 */
	public function getByID($id) {
		return parent::getObjByID($id, 'Company');
	}
	
	/**
	 * @return Company[]
	 */
	public function getByIDs($ids) {
		return parent::getObjsByIDs($ids, 'Company');
	}
	
	/**
	 * @return Company[]
	 */
	public function getAll() {
		return parent::getObjs('Company');
	}
}
