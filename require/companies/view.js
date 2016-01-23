define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		Event = require('Event'),
		jstemplate = require('jstemplate'),
		alertify = require('alertify'),
		lang = require('lang'),
		_ = require('underscore');
	
	var View = function() {
		this.$root = $('#companies');
		
		this.$list = this.$('.list');
		this.$deleteBtn = this.$('.delete');
		this.$viewBtn = this.$('.view');
		this.$modifyBtn = this.$('.modify');
		this.$addForm = this.$('.add');
		this.$name = this.$('.name');
		
		this.onDelete = new Event();
		this.onView = new Event();
		this.onModify = new Event();
		this.onAdd = new Event();
		
		this.tplOption = jstemplate.parse('<option value="{value}">{text}</option>');
		
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
		
		this.$list.change(function() {
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
			var html = this.tplOption.rende({
				value: id,
				text: name
			});
			this.$list.append(html);
			if (selected) {
				this.setSelected(id);
			}
		},
		remove: function(id) {
			this.$list.find('option[value="'+id+'"]').remove();
		},
		modify: function(id, name) {
			this.$list.find('option[value="'+id+'"]').text(name);
		},
		refreshList: function(list) {
			var self = this;
			var sorted = _.sortBy(list, function(option) {
				return option.name;
			});
			this.clearList();
			_.each(sorted, function(option) {
				self.add(option.id, option.name);
			});
		},
		clearList: function() {
			this.$list.html('');
			this.add('', '');
		},
		clearName: function() {
			this.$name.val('');
		},
		getSelected: function() {
			var id = this.$list.val();
			return id ? parseInt(id) : null;
		},
		setSelected: function(id) {
			this.$list.val(id).change();
		}
	};
	
	module.exports = View;
	
});