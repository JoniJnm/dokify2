<?php

namespace dokify2\controllers;

use dokify2\tables\AgreementTable;
use dokify2\objs\Agreement;
use dokify2\models\AgreementModel;

class AgreementController extends \JNMFW\ControllerBase {
	/**
	 * @var AgreementModel 
	 */
	private $agreementModel = null;
	
	public function __construct() {
		parent::__construct();
		$this->agreementModel = AgreementModel::getInstance();
	}
	
	public function get() {
		$id_agreement = $this->request->getUInt('id');
		$agreement = $this->agreementModel->getByID($id_agreement);
		
		if (!$agreement) {
			$this->server->sendNotFound();
		}
		
		$this->server->sendData($agreement->toJSON());
	}
	
	public function create() {
		$id_relation = $this->request->getUInt('id_relation');
		$name = $this->request->get('name');
		
		$item = new AgreementTable();
		$item->name = $name;
		$item->insert();
		
		$agreement = new Agreement($item);
		$agreement->addClient($id_relation);
		
		$this->server->sendData(array(
			'id' => $item->id
		));
	}
	
	public function destroy() {
		$id = $this->request->get('id');
		$item = AgreementTable::get($id);
		
		if ($item) {
			$item->delete();
			$this->server->sendOK();
		}
		else {
			$this->server->sendNotFound();
		}
	}
}
