<?php

namespace dokify2\objs;

use dokify2\tables\CompanyTable;

class Company extends \JNMFW\ObjBase {
	/**
	 * @return CompanyTable
	 */
	public function getItem() {
		return $this->item;
	}
}
