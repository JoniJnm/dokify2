<?php

namespace dokify2\controllers;

use dokify2\tables\CompanyTable;
use dokify2\models\CompanyModel;
use dokify2\objs\Company;
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
	
	public function create() {
		$name = $this->request->get('name');
		
		if ($this->companyModel->exists($name)) {
			$this->server->sendConflict(HLang::get(Lang::alert_company_exists));
		}
		
		$item = new CompanyTable();
		$item->name = $name;
		$item->insert();
		
		$company = new Company($item);
		
		$this->server->sendData($company->toJSON());
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
		$company = $this->companyModel->getByID($id);
		
		if ($company) {
			if ($company->hasRelations()) {
				$this->server->sendConflict(HLang::get(Lang::alert_cant_delete_company__in_relation));
			}
			$company->getItem()->delete();
			$this->server->sendOK();
		}
		else {
			$this->server->sendNotFound();
		}
	}
}
