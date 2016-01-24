define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		Event = require('event'),
		Select = require('select'),
		_ = require('underscore');
	
	var View = function() {
		this.$root = $('#agreement_create');
		
		this.$form = this.$root;
		this.$name = this.$('.name');
		this.relation = new Select(this.$('.relation'));
		
		this.onCreate = new Event();
		
		var self = this;
		
		this.$form.submit(function(event) {
			event.preventDefault();
			var name = self.getName();
			var id_relation = self.getRelation();
			self.onCreate.trigger(name, id_relation);
		});
	};
	
	View.prototype = {
		$: function(selector) {
			return this.$root.find(selector);
		},
		
		getRelation: function() {
			return this.relation.getSelected();
		},
		getName: function() {
			return this.$name.val();
		},
		getSelect: function() {
			return this.relation;
		},
		clearForm: function() {
			this.$name.val('');
			this.relation.unselect();
		}
	};
	
	module.exports = View;
	
});