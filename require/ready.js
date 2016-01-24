define(function(require, exports, module) {
	'use strict';

	var
		$ = require('jquery'),
		CompaniesModel = require('companies/model'),
		RelationsModel = require('relations/model'),
		AgreementCreateModel = require('agreement-create/model'),
		AgreementModifyModel = require('agreement-modify/model');
		
	$(document).ready(function() {
		var companies = new CompaniesModel();
		var relations = new RelationsModel(companies);
		var agreementCreate = new AgreementCreateModel(companies, relations);
		var agreementModify = new AgreementModifyModel(companies, relations, agreementCreate);
		
		companies.fetchAll();
		relations.fetchAll();
		agreementModify.fetchAll();
		
		
		//debug
		window.companies = companies;
		window.relations = relations;
		window.agreementCreate = agreementCreate;
		window.agreementModify = agreementModify;
	});
});
