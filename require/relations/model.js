define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		View = require('relations/view');
	
	var Model = function(companies) {
		this.view = new View();
		this.companies = companies;
		
		var self = this;
		
		this.companies.onCreate.attach(function(id, name) {
			self.view.addCompany(id, name);
			self.fetchAll(true);
		});
		this.companies.onDestroy.attach(function(id) {
			self.view.removeCompany(id);
			self.fetchAll(true);
		});
		this.companies.onModify.attach(function(id, name) {
			self.view.modifyCompany(id, name);
			self.fetchAll(true);
		});
		this.companies.onRefresh.attach(function(list) {
			self.view.clearCompanies();
			for (var i=0; i<list.length; i++) {
				var company = list[i];
				self.view.addCompany(company.id, company.name);
			}
		});
		
		this.view.onAdd.attach(this.onAdd, this);
		this.view.onDelete.attach(this.destroy, this);
	};
	
	Model.prototype = {
		onAdd: function(id_client, id_provider) {
			var self = this;
			this.add(id_client, id_provider)
				.done(function() {
					self.view.unselectCompanies();
				});
		},
		add: function(id_client, id_provider) {
			var self = this;
			return $.post('rest/relation/add', {
				id_client: id_client,
				id_provider: id_provider
			}, function(data) {
				self.view.add(data.id, data.name, true);
			});
		},
		destroy: function(id) {
			var self = this;
			return $.post('rest/relation/destroy', {
				id: id
			}, function() {
				self.view.remove(id);
			});
		},
		fetchAll: function(keepSelected) {
			var self = this;
			$.get('rest/relations/get', function(list) {
				self.view.refresh(list, keepSelected);
			});
		}
	};
	
	module.exports = Model;
});