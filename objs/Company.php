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
	
	public function toJSON() {
		return get_object_vars($this->getItem());
	}
	
	public function hasRelations() {
		return !!$this->db->getQueryBuilderSelect('relations')
			->columns('id')
			->setGlueOr()
			->where('client', $this->getItem()->id)
			->where('provider', $this->getItem()->id)
			->limit(1)
			->loadValue();
	}
}
