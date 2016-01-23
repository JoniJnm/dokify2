<?php

namespace dokify2\models;

use dokify2\objs\Company;

class BundleModel extends BaseModel {
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
}
