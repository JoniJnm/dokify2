define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		View = require('companies/view');
	
	var Model = function() {
		this.view = new View();
		
		this.view.onAdd.attach(this.onAdd, this);
		this.view.onDelete.attach(this.destroy, this);
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
			}).done(function(id) {
				self.view.add(id, name, true);
			});
		},
		destroy: function(id) {
			var self = this;
			return $.post('rest/company/destroy', {
				id: id
			}).done(function() {
				self.view.remove(id);
			});
		},
		fetchAll: function() {
			var self = this;
			$.get('rest/companies/get').done(function(list) {
				self.view.refreshList(list);
			});
		}
	};
	
	module.exports = Model;
});