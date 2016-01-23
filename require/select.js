define(function(require, exports, module) {
	'use strict';
	
	var
		$ = require('jquery'),
		jstemplate = require('jstemplate'),
		_ = require('underscore');
	
	var Select = function($select) {
		this.$select = $select;
		this.tplOption = jstemplate.parse('<option value="{value}">{text}</option>');
	};
	
	Select.prototype = {
		add: function(id, name, selected) {
			var html = this.tplOption.rende({
				value: id,
				text: name
			});
			this.$select.append(html);
			if (selected) {
				this.setSelected(id);
			}
			return this;
		},
		onChange: function(func) {
			this.$select.change(func);
			return this;
		},
		refresh: function(list) {
			var self = this;
			var sorted = _.sortBy(list, function(option) {
				return option.name;
			});
			this.clear();
			_.each(sorted, function(option) {
				self.add(option.id, option.name);
			});
		},
		remove: function(id) {
			this.$select.find('option[value="'+id+'"]').remove();
			return this;
		},
		modify: function(id, name) {
			this.$select.find('option[value="'+id+'"]').text(name);
			return this;
		},
		clear: function() {
			this.$select.html('');
			this.add('', '');
			return this;
		},
		getSelected: function() {
			var id = this.$select.val();
			return id ? parseInt(id) : null;
		},
		setSelected: function(id) {
			this.$select.val(id).change();
			return this;
		}
	};
	
	module.exports = Select;
	
});