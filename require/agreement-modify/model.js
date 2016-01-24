define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		View = require('agreement-modify/view'),
		Event = require('event');
	
	var Model = function(companies, relations, agreementCreate) {
		this.view = new View();
		this.companies = companies;
		this.relations = relations;
		this.agreementCreate = agreementCreate;
		
		
		var self = this;
		this.agreementCreate.onCreate.attach(function(id, name) {
			self.view.add(id, name, true);
		});
		this.companies.onModify.attach(function() {
			self.fetchAll();
		});
		
		this.view.onChange.attach(this.onChange, this);
		this.view.onDelete.attach(this.destroy, this);
		this.view.onAddRelation.attach(this.addRelation, this);
		
		this.relations.onCreate.attach(function() {
			self.reloadModify();
		});
		this.relations.onDestroy.attach(function() {
			self.reloadModify();
		});
	};
	
	Model.prototype = {
		refresh: function() {
			this.relations.refresh();
		},
		reloadModify: function() {
			var id_selected = this.view.getSelected();
			this.onChange(id_selected);
		},
		addRelation: function(id_agreement, id_relation) {
			var self = this;
			return $.post('rest/agreement/addRelation', {
				id_agreement: id_agreement,
				id_relation: id_relation
			}, function(data) {
				self.view.preapreModify(data.long_name, data.valid_relations);
			});
		},
		onChange: function(id_selected) {
			var self = this;
			if (id_selected) {
				$.get('rest/agreement/get', {
					id: id_selected
				}, function(data) {
					self.view.preapreModify(data.long_name, data.valid_relations);
				});
			}
			else {
				self.view.clearModify();
			}
		},
		destroy: function(id) {
			var self = this;
			return $.post('rest/agreement/destroy', {
				id: id
			}, function() {
				self.view.remove(id);
				self.view.clearModify();
			});
		},
		fetchAll: function() {
			var self = this;
			return $.get('rest/agreements/get', function(list) {
				self.view.refresh(list);
			});
		}
	};
	
	module.exports = Model;
});