<?php

namespace dokify2\controllers;

use dokify2\models\RelationModel;
use dokify2\models\CompanyModel;

class RelationsController extends \JNMFW\ControllerBase {
	/**
	 * @var RelationModel 
	 */
	private $relationModel = null;
	
	public function __construct() {
		parent::__construct();
		$this->relationModel = RelationModel::getInstance();
		$this->companyModel = CompanyModel::getInstance();
	}
	
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
	
	public function company() {
		$id = $this->request->get('id');
		$company = $this->companyModel->getByID($id);
		
		if (!$company) {
			$this->server->sendNotFound();
		}
		
		$data = $this->relationModel->getForCompanyID($id);
		$this->server->sendData($data);
	}
}
