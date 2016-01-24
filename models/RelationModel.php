<?php

namespace dokify2\models;

use dokify2\objs\Relation;

class RelationModel extends BaseModel {
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
}
