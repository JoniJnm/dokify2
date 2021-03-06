<?php

namespace dokify2\tables;

class RelationTable extends \JNMFW\TableBase {
	public $id;
	public $client;
	public $provider;
	
	public function getPrimaryKey() {
		return 'id';
	}

	public function getTableName() {
		return 'relations';
	}
	
	/**
	 * @return RelationTable
	 */
	public static function get($id) {
		return parent::get($id);
	}
	
	/**
	 * @return RelationTable[]
	 */
	public static function getMulti($ids) {
		return parent::getMulti($ids);
	}
	
	/**
	 * @return RelationTable[]
	 */
	public static function getAll() {
		return parent::getAll();
	}
}
