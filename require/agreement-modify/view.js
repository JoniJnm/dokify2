define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		Event = require('Event'),
		Select = require('select'),
		_ = require('underscore');
	
	var View = function() {
		this.$root = $('#agreement_modify');
		
		this.agreements = new Select(this.$('.agreements'));
		this.$deleteBtn = this.$('.delete');
		this.$modify_section = this.$('.modify_section');
		
		this.relations = new Select(this.$('.relations'));
		this.$long_name = this.$('.long_name');
		
		this.onChange = new Event();
		this.onDelete = new Event();
		
		var self = this;
		
		this.agreements.onChange(function() {
			var id_selected = self.agreements.getSelected();
			self.onChange.trigger(id_selected);
			self.$deleteBtn.toggleClass('hidden', !id_selected);
		});
		
		this.$deleteBtn.click(function() {
			var id_selected = self.agreements.getSelected();
			self.onDelete.trigger(id_selected);
		});
	};
	
	View.prototype = {
		$: function(selector) {
			return this.$root.find(selector);
		},
		
		add: function(id, name, selected) {
			this.agreements.add(id, name, selected);
		},
		remove: function(id) {
			this.agreements.remove(id);
		},
		refresh: function(list, keepSelected) {
			this.agreements.refresh(list, keepSelected);
		},
		getSelected: function() {
			return this.agreements.getSelected();
		},
		
		preapreModify: function(long_name, relations) {
			this.$long_name.text(long_name);
			this.relations.refresh(relations);
			this.$modify_section.removeClass('hidden');
		},
		clearModify: function() {
			this.$modify_section.addClass('hidden');
			this.$long_name.text('');
			this.relations.clear();
		}
	};
	
	module.exports = View;
	
});