define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		Event = require('event'),
		alertify = require('alertify'),
		lang = require('lang'),
		_ = require('underscore'),
		Select = require('select'),
		tplRelations = require('tplparse!tpls/relations');
		
	require('datatable');
	
	var View = function() {
		this.$root = $('#companies');
		
		this.select = new Select(this.$('.list'));
		this.$deleteBtn = this.$('.delete');
		this.$viewBtn = this.$('.view');
		this.$modifyBtn = this.$('.modify');
		this.$addForm = this.$('.add');
		this.$name = this.$('.name');
		this.$relations = this.$('.relations');
		
		this.onDelete = new Event();
		this.onShowRelations = new Event();
		this.onModify = new Event();
		this.onAdd = new Event();
				
		var self = this;
		
		this.$deleteBtn.click(function() {
			var id = self.getSelected();
			self.onDelete.trigger(id);
		});
		
		this.$viewBtn.click(function() {
			var id = self.getSelected();
			self.onShowRelations.trigger(id);
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
			self.clearRelations();
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
		observe: function(select) {
			this.select.observe(select);
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
		},
		showRelations: function(data) {
			var html = tplRelations.rende(data);
			this.$relations.html(html);
			this.$relations.find('table').dataTable({
				language: lang.datatable
			});
		},
		clearRelations: function() {
			this.$relations.html('');
		}
	};
	
	module.exports = View;
	
});