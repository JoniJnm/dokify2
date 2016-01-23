<?php

namespace langs\models;

abstract class BaseModel extends \JNMFW\ModelBase {
	protected function getObjByID($id, $name) {
		return parent::getByPrimaryKey($id, "dokify2\\tables\\".$name."Table", "dokify2\\objs\\".$name);
	}
	
	protected function getObjsByIDs($ids, $name) {
		return parent::getMultiByPrimaryKey($ids, "dokify2\\tables\\".$name."Table", "dokify2\\objs\\".$name);
	}
}
