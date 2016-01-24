<?php

namespace dokify2\tables;

class AgreementTable extends \JNMFW\TableBase {
	public $id;
	public $name;
	
	public function getPrimaryKey() {
		return 'id';
	}

	public function getTableName() {
		return 'agreements';
	}
	
	/**
	 * @return AgreementTable
	 */
	public static function get($id) {
		return parent::get($id);
	}
	
	/**
	 * @return AgreementTable[]
	 */
	public static function getMulti($ids) {
		return parent::getMulti($ids);
	}
	
	/**
	 * @return AgreementTable[]
	 */
	public static function getAll() {
		return parent::getAll();
	}
}
