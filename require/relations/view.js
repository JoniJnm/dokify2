define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		Event = require('event'),
		_ = require('underscore'),
		alertify = require('alertify'),
		Select = require('select'),
		lang = require('lang');
	
	var View = function() {
		this.$root = $('#relations');
		
		this.client = new Select(this.$('.client'));
		this.provider = new Select(this.$('.provider'));
		this.relation = new Select(this.$('.relations'));
		this.$form = this.$('.form');
		this.$deleteBtn = this.$('.delete');
		
		this.onAdd = new Event();
		this.onDelete = new Event();
		
		var self = this;
		
		this.$form.submit(function(event) {
			event.preventDefault();
			
			var id_client = self.getSelectedClient();
			var id_provider = self.getSelectedProvider();
			
			if (id_client === id_provider) {
				alertify.alert(lang.alert.diferent_companies);
				return;
			}
			
			self.onAdd.trigger(id_client, id_provider);
		});
		
		this.$deleteBtn.click(function() {
			var id = self.getSelected();
			self.onDelete.trigger(id);
		});
		
		this.relation.onChange(function() {
			var hide = !self.getSelected();
			self.$deleteBtn.toggleClass('hidden', hide);
		});
	};
	
	View.prototype = {
		$: function(selector) {
			return this.$root.find(selector);
		},
		
		add: function(id, name, selected) {
			this.relation.add(id, name, selected);
		},
		remove: function(id) {
			this.relation.remove(id);
		},
		refresh: function(list, keepSelected) {
			this.relation.refresh(list, keepSelected);
		},
		observe: function(select) {
			this.relation.observe(select);
		},
		clear: function() {
			this.relation.clear();
		},
		getSelected: function() {
			return this.relation.getSelected();
		},
		
		unselectCompanies: function() {
			this.client.unselect();
			this.provider.unselect();
		},
		getSelectedClient: function() {
			return this.client.getSelected();
		},
		getSelectedProvider: function() {
			return this.provider.getSelected();
		},
		
		getClientSelect: function() {
			return this.client;
		},
		getProviderSelect: function() {
			return this.provider;
		}
	};
	
	module.exports = View;
	
});