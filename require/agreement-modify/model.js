define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		View = require('agreement-modify/view'),
		Event = require('Event');
	
	var Model = function(relations, agreementCreate) {
		this.view = new View();
		this.relations = relations;
		this.agreementCreate = agreementCreate;
		
		
		var self = this;
		this.agreementCreate.onCreate.attach(function(id, name) {
			self.view.add(id, name, true);
		});
		
		this.view.onChange.attach(this.onChange, this);
		this.view.onDelete.attach(this.destroy, this);
	};
	
	Model.prototype = {
		refresh: function() {
			this.relations.refresh();
		},
		reloadModify: function() {
			var id_selected = this.view.getSelected();
			this.change(id_selected);
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