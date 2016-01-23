<?php

namespace dokify2\tables;

class CompanyTable extends \JNMFW\TableBase {
	public $id;
	public $name;
	
	public function getPrimaryKey() {
		return 'id';
	}

	public function getTableName() {
		return 'companies';
	}
	
	/**
	 * @return CompanyTable
	 */
	public static function get($id) {
		return parent::get($id);
	}
	
	/**
	 * @return CompanyTable[]
	 */
	public static function getMulti($ids) {
		return parent::getMulti($ids);
	}
	
	/**
	 * @return CompanyTable[]
	 */
	public static function getAll() {
		return parent::getAll();
	}
}
