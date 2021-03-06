define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		View = require('companies/view'),
		lang = require('lang'),
		Event = require('event');
	
	var Model = function() {
		this.view = new View();
		
		this.view.onAdd.attach(this.onAdd, this);
		this.view.onDelete.attach(this.destroy, this);
		this.view.onModify.attach(this.modify, this);
		this.view.onShowRelations.attach(this.showRelations, this);
		
		this.onCreate = new Event();
		this.onDestroy = new Event();
		this.onModify = new Event();
	};
	
	Model.prototype = {
		onAdd: function(name) {
			var self = this;
			this.add(name).done(function() {
				self.view.clearName();
			});
		},
		add: function(name) {
			var self = this;
			return $.post('rest/company/create', {
				name: name
			}).done(function(data) {
				self.view.add(data.id, name, true);
				self.onCreate.trigger(data.id, name);
			});
		},
		destroy: function(id) {
			var self = this;
			return $.post('rest/company/destroy', {
				id: id
			}).done(function() {
				self.view.remove(id);
				self.onDestroy.trigger(id);
			});
		},
		modify: function(id, name) {
			var self = this;
			return $.post('rest/company/update', {
				id: id,
				name: name
			}, function() {
				self.view.modify(id, name);
				self.onModify.trigger(id, name);
			});
		},
		showRelations: function(id) {
			var self = this;
			$.get('rest/relations/company', {
				id: id
			}, function(rows) {
				var data = {
					columns: {
						//id: 'ID',
						name: lang.generic.company_name,
						relation: lang.generic.relation
					},
					rows: rows
				};
				self.view.showRelations(data);
			});
		},
		fetchAll: function() {
			var self = this;
			$.get('rest/companies/get', function(list) {
				self.view.refreshList(list);
			});
		},
		observe: function(select) {
			this.view.observe(select);
		}
	};
	
	module.exports = Model;
});