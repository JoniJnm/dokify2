define(function(require, exports, module) {
	'use strict';

	var
		$ = require('jquery'),
		CompanyModel = require('companies/model'),
		RelationsModel = require('relations/model');
		
	$(document).ready(function() {
		var company = new CompanyModel();
		var relations = new RelationsModel(company);
		
		company.fetchAll();
		relations.fetchAll();
		
		//debug
		window.company = company;
		window.relations = relations;
	});
});
