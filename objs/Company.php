<?php

namespace dokify2\objs;

use dokify2\tables\CompanyTable;
use dokify2\models\AgreementModel;

class Company extends \JNMFW\ObjBase {
	private $agreementModel;
	
	public function __construct($item) {
		parent::__construct($item);
		$this->agreementModel = AgreementModel::getInstance();
	}
	
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
	
	/**
	 * @return Company[]
	 */
	public function getCompaniesInAgreement() {
		$current_id = $this->getItem()->id;
		$ids = $this->agreementModel->getIDsByCompanyID($current_id);
		$agreements = $this->agreementModel->getByIDs($ids);
		$out = array();
		$added = array();
		foreach ($agreements as $agreement) {
			$companies = $agreement->getCompanies();
			foreach ($companies as $company) {
				$id_company = $company->getItem()->id;
				if ($current_id != $id_company && !isset($added[$id_company])) {
					$added[$id_company] = true;
					$out[] = $company;
				}
			}
		}
		return $out;
	}
}
