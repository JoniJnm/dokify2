<?php

namespace dokify2\controllers;

use dokify2\models\RelationModel;

class RelationsController extends \JNMFW\ControllerBase {
	public function get() {
		$relations = RelationModel::getInstance()->getAll();
		$data = array();
		foreach ($relations as $relation) {
			$row = get_object_vars($relation->getItem());
			$row['name'] = $relation->getName();
			$data[] = $row;
		}
		$this->server->sendData($data);
	}
}
