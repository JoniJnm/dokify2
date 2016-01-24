<?php

namespace dokify2\objs;

use dokify2\tables\RelationTable;
use dokify2\models\CompanyModel;

class Relation extends \JNMFW\ObjBase {
	/**
	 * @var CompanyModel 
	 */
	private $companyModel;
	
	public function __construct($item) {
		parent::__construct($item);
		$this->companyModel = CompanyModel::getInstance();
	}
	
	/**
	 * @return RelationTable
	 */
	public function getItem() {
		return $this->item;
	}
	
	public function getName() {
		$client = $this->companyModel->getByID($this->getItem()->client);
		$provider = $this->companyModel->getByID($this->getItem()->provider);
		
		return $client->getItem()->name.' > '.$provider->getItem()->name;
	}
}
