<?php

namespace dokify2\controllers;

use dokify2\tables\AgreementTable;

class AgreementsController extends \JNMFW\ControllerBase {
	public function get() {
		$data = AgreementTable::getAll();
		$this->server->sendData($data);
	}
}
