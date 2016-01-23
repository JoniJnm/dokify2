define(function(require, exports, module) {
	'use strict';

	var
		$ = require('jquery'),
		CompanyModel = require('companies/model');
		
	$(document).ready(function() {
		var company = new CompanyModel();
		company.fetchAll();
		
		//debug
		window.company = company;
	})
});
