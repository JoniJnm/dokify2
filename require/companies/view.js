define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		Event = require('Event'),
		jstemplate = require('jstemplate'),
		_ = require('underscore');
	
	var View = function() {
		this.$root = $('#companies');
		
		this.$list = this.$('.list');
		this.$deleteBtn = this.$('.delete');
		this.$viewBtn = this.$('.view');
		this.$addForm = this.$('.add');
		this.$name = this.$('.name');
		
		this.onDelete = new Event();
		this.onView = new Event();
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
		
		this.$addForm.submit(function() {			
			var name = self.$name.val();
			self.onAdd.trigger(name);
			
			return false; //prevent submit form
		});
		
		this.$list.change(function() {
			var hide = !self.getSelected();
			self.$viewBtn.toggleClass('hidden', hide);
			self.$deleteBtn.toggleClass('hidden', hide);
		});
	};
	
	View.prototype = {
		$: function(selector) {
			return this.$root.find(selector);
		},
		add: function(id, name, select) {
			var html = this.tplOption.rende({
				value: id,
				text: name
			});
			this.$list.append(html);
			if (select) {
				this.setSelected(id);
			}
		},
		remove: function(id) {
			this.$list.find('option[value="'+id+'"]').remove();
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
			this.add(0, '');
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