define(function(require, exports, module) {
	'use strict';

	var
		$ = require('jquery'),
		CompanyModel = require('companies/model'),
		RelationsModel = require('relations/model'),
		AgreementCreateModel = require('agreement-create/model'),
		AgreementModifyModel = require('agreement-modify/model');
		
	$(document).ready(function() {
		var company = new CompanyModel();
		var relations = new RelationsModel(company);
		var agreementCreate = new AgreementCreateModel(relations);
		var agreementModify = new AgreementModifyModel(relations, agreementCreate);
		
		company.fetchAll();
		relations.fetchAll();
		agreementModify.fetchAll();
		
		
		//debug
		window.company = company;
		window.relations = relations;
		window.agreementCreate = agreementCreate;
		window.agreementModify = agreementModify;
	});
});
