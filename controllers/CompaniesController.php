<?php

namespace dokify2\controllers;

use dokify2\tables\CompanyTable;

class CompaniesController extends \JNMFW\ControllerBase {
	public function get() {
		$data = CompanyTable::getAll();
		$this->server->sendData($data);
	}
}
