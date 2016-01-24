<?php

namespace dokify2\models;

use dokify2\objs\Agreement;

class AgreementModel extends BaseModel {
	/**
	 * @return AgreementModel
	 */
	public static function getInstance() {
		return parent::getInstance();
	}
	
	public function getIDsByCompanyID($id_company) {
		return $this->db->getQueryBuilderSelect('relations', 'r')
			->columns('distinct ar.id_agreement')
			->innerJoin('agreement_relations', 'ar', 'ar.id_relation', 'r.id')
			->setGlueOr()
			->where('r.client', $id_company)
			->where('r.provider', $id_company)
			->loadValueArray();
	}
	
	/**
	 * @return Agreement
	 */
	public function getByID($id) {
		return parent::getObjByID($id, 'Agreement');
	}
	
	/**
	 * @return Agreement[]
	 */
	public function getByIDs($ids) {
		return parent::getObjsByIDs($ids, 'Agreement');
	}
	
	/**
	 * @return Agreement[]
	 */
	public function getAll() {
		return parent::getObjs('Agreement');
	}
}
