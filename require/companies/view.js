define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		Event = require('Event'),
		alertify = require('alertify'),
		lang = require('lang'),
		_ = require('underscore'),
		Select = require('select');
	
	var View = function() {
		this.$root = $('#companies');
		
		this.select = new Select(this.$('.list'));
		this.$deleteBtn = this.$('.delete');
		this.$viewBtn = this.$('.view');
		this.$modifyBtn = this.$('.modify');
		this.$addForm = this.$('.add');
		this.$name = this.$('.name');
		
		this.onDelete = new Event();
		this.onView = new Event();
		this.onModify = new Event();
		this.onAdd = new Event();
				
		var self = this;
		
		this.$deleteBtn.click(function() {
			var id = self.getSelected();
			self.onDelete.trigger(id);
		});
		
		this.$viewBtn.click(function() {
			var id = self.getSelected();
			self.onView.trigger(id);
		});
		
		this.$modifyBtn.click(function() {
			var id = self.getSelected();
			alertify.prompt(lang.generic.company_name, '', function(evt, value) {
				self.onModify.trigger(id, value);
			});
		});
		
		this.$addForm.submit(function(event) {
			event.preventDefault();
			
			var name = self.$name.val();
			self.onAdd.trigger(name);
		});
		
		this.select.onChange(function() {
			var hide = !self.getSelected();
			self.$viewBtn.toggleClass('hidden', hide);
			self.$deleteBtn.toggleClass('hidden', hide);
			self.$modifyBtn.toggleClass('hidden', hide);
		});
	};
	
	View.prototype = {
		$: function(selector) {
			return this.$root.find(selector);
		},
		add: function(id, name, selected) {
			this.select.add(id, name, selected);
		},
		remove: function(id) {
			this.select.remove(id);
		},
		modify: function(id, name) {
			this.select.modify(id, name);
		},
		refreshList: function(list) {
			this.select.refresh(list);
		},
		clearList: function() {
			this.select.clear();
		},
		clearName: function() {
			this.$name.val('');
		},
		getSelected: function() {
			return this.select.getSelected();
		},
		setSelected: function(id) {
			this.select.setSelected(id);
		}
	};
	
	module.exports = View;
	
});