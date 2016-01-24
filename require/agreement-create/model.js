define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		View = require('agreement-create/view'),
		Event = require('Event');
	
	var Model = function(companies, relations) {
		this.view = new View();
		this.companies = companies;
		this.relations = relations;
		
		this.relations.observe(this.view.getSelect());
		
		this.view.onCreate.attach(this.onCreate, this);
		
		this.onCreate = new Event();
	};
	
	Model.prototype = {
		onCreate: function(name, id_relation) {
			var self = this;
			this.create(name, id_relation).done(function() {
				self.view.clearForm();
			});
		},
		create: function(name, id_relation) {
			var self = this;
			return $.post('rest/agreement/create', {
				name: name,
				id_relation: id_relation
			}, function(data) {
				self.onCreate.trigger(data.id, name);
			});
		}
	};
	
	module.exports = Model;
});