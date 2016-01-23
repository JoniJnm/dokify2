<?php

namespace dokify2\controllers;

use dokify2\tables\CompanyTable;

class CompanyController extends \JNMFW\ControllerBase {
	public function add() {
		$name = $this->request->get('name');
		
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
		
		$this->server->sendData($item->id);
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
