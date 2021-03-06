define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		View = require('relations/view'),
		Event = require('event');
	
	var Model = function(companies) {
		this.view = new View();
		this.companies = companies;
		
		this.companies.observe(this.view.getClientSelect());
		this.companies.observe(this.view.getProviderSelect());
		
		this.onCreate = new Event();
		this.onDestroy = new Event();
		
		var self = this;
		
		this.companies.onModify.attach(function() {
			self.fetchAll();
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
			return $.post('rest/relation/create', {
				id_client: id_client,
				id_provider: id_provider
			}, function(data) {
				self.view.add(data.id, data.name, true);
				self.onCreate.trigger(data.id, data.name);
			});
		},
		destroy: function(id) {
			var self = this;
			return $.post('rest/relation/destroy', {
				id: id
			}, function() {
				self.view.remove(id);
				self.onDestroy.trigger(id);
			});
		},
		fetchAll: function(keepSelected) {
			var self = this;
			$.get('rest/relations/get', function(list) {
				self.view.refresh(list, keepSelected);
			});
		},
		observe: function(select) {
			this.view.observe(select);
		}
	};
	
	module.exports = Model;
});