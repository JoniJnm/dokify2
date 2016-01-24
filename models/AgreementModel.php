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
