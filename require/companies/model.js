define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		Event = require('event'),
		View = require('companies/view');
	
	var Model = function() {
		this.view = new View();
		
		this.view.onAdd.attach(this.onAdd, this);
		this.view.onDelete.attach(this.destroy, this);
		this.view.onModify.attach(this.modify, this);
		
		this.onCreate = new Event();
		this.onDestroy = new Event();
		this.onRefresh = new Event();
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
			return $.post('rest/company/add', {
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
			}).done(function() {
				self.view.modify(id, name);
				self.onModify.trigger(id, name);
			});
		},
		fetchAll: function() {
			var self = this;
			$.get('rest/companies/get', function(list) {
				self.view.refreshList(list);
				self.onRefresh.trigger(list);
			});
		}
	};
	
	module.exports = Model;
});