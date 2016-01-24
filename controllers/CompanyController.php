<?php

namespace dokify2\controllers;

use dokify2\tables\CompanyTable;
use dokify2\models\CompanyModel;
use JNMFW\helpers\HLang;
use dokify2\langs\Lang;

class CompanyController extends \JNMFW\ControllerBase {
	/**
	 * @var CompanyModel 
	 */
	private $companyModel = null;
	
	public function __construct() {
		parent::__construct();
		$this->companyModel = CompanyModel::getInstance();
	}
	
	public function add() {
		$name = $this->request->get('name');
		
		if ($this->companyModel->exists($name)) {
			$this->server->sendConflict(HLang::get(Lang::alert_company_exists));
		}
		
		$item = new CompanyTable();
		$item->name = $name;
		$item->insert();
		
		$this->server->sendData($item->id);
	}
	
	public function update() {
		$id = $this->request->get('id');
		$name = $this->request->get('name');
		
		$item = CompanyTable::get($id);
		
		if ($item) {
			$item->name = $name;
			$item->update();
			$this->server->sendOK();
		}
		else {
			$this->server->sendNotFound();
		}
		
		$this->server->sendData(array(
			'id' => $item->id
		));
	}
	
	public function destroy() {
		$id = $this->request->get('id');
		$item = CompanyTable::get($id);
		
		if ($item) {
			$item->delete();
			$this->server->sendOK();
		}
		else {
			$this->server->sendNotFound();
		}
	}
}
