define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		jstemplate = require('jstemplate'),
		_ = require('underscore');
	
	var Select = function($select) {
		this.$select = $select;
		this.tplOption = jstemplate.parse('<option value="{value}">{text}</option>');
		this.observers = [];
	};
	
	Select.prototype = {
		observe: function(select) {
			this.observers.push(select);
		},
		invoke: function(method, args) {
			args = args || [];
			_.invoke.apply(_, $.merge([this.observers, method], args));
		},
		add: function(id, name, selected) {
			var html = this.tplOption.rende({
				value: id,
				text: name
			});
			this.$select.append(html);
			if (selected) {
				this.setSelected(id);
			}
			this.invoke('add', arguments);
			return this;
		},
		onChange: function(func) {
			this.$select.change(func);
			return this;
		},
		refresh: function(list, keepSelected) {
			var self = this;
			var id = keepSelected ? this.getSelected() || '' : '';
			var sorted = _.sortBy(list, function(option) {
				return option.name;
			});
			this.clear();
			_.each(sorted, function(option) {
				self.add(option.id, option.name);
			});
			this.setSelected(id);
		},
		remove: function(id) {
			this.$select.find('option[value="'+id+'"]').remove();
			this.invoke('remove', arguments);
			return this;
		},
		modify: function(id, name) {
			this.$select.find('option[value="'+id+'"]').text(name);
			this.invoke('modify', arguments);
			return this;
		},
		clear: function() {
			this.$select.html('');
			_.each(this.observers, function(observer) {
				observer.$select.html('');
			});
			this.add('', '');
			return this;
		},
		getSelected: function() {
			var id = this.$select.val();
			return id ? parseInt(id) : null;
		},
		getSelectedName: function() {
			return this.$select.find('option:selected').text();
		},
		unselect: function() {
			return this.setSelected('');
		},
		setSelected: function(id) {
			this.$select.val(id).change();
			return this;
		}
	};
	
	module.exports = Select;
	
});