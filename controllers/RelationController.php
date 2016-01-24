<?php

namespace dokify2\controllers;

use dokify2\tables\RelationTable;
use dokify2\objs\Relation;
use dokify2\models\RelationModel;
use JNMFW\helpers\HLang;
use dokify2\langs\Lang;

class RelationController extends \JNMFW\ControllerBase {
	/**
	 * @var RelationModel 
	 */
	private $relationModel = null;
	
	public function __construct() {
		parent::__construct();
		$this->relationModel = RelationModel::getInstance();
	}
	
	public function create() {
		$id_client = $this->request->getInt('id_client');
		$id_provider = $this->request->getInt('id_provider');
		
		if ($this->relationModel->exists($id_client, $id_provider)) {
			$this->server->sendConflict(HLang::get(Lang::alert_relation_exists));
		}
		
		$item = new RelationTable();
		$item->client = $id_client;
		$item->provider = $id_provider;
		$item->insert();
		
		$relation = new Relation($item);
		
		$this->server->sendData($relation->toJSON());
	}
	
	public function destroy() {
		$id = $this->request->get('id');
		$relation = $this->relationModel->getByID($id);
		
		if ($relation) {
			if ($relation->inAgrement()) {
				$this->server->sendConflict(HLang::get(Lang::alert_cant_delete_relation__in_agreement));
			}
			$relation->getItem()->delete();
			$this->server->sendOK();
		}
		else {
			$this->server->sendNotFound();
		}
	}
}
