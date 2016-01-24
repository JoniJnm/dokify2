require.config({
	baseUrl: "require",
	shim: {
		tplparse: {
			deps: [
				'jstemplate'
			]
		},
		underscore: {
			deps: [
				'jquery'
			]
		},
		bootstrap: {
			deps: [
				'jquery'
			]
		}
	},
	paths: {
		bootstrap: '../bower_components/bootstrap/dist/js/bootstrap.min',
		jquery: '../bower_components/jquery/dist/jquery.min',
		text: '../bower_components/text/text',
		i18n: '../bower_components/i18n/i18n',
		jstemplate: '../bower_components/jstemplate/dist/jstemplate.min',
		tplparse: '../bower_components/jstemplate/src/tplparse',
		underscore: '../bower_components/underscore/underscore-min',
		alertify: '../bower_components/AlertifyJS/build/alertify.min'
	}
});

require(['alertify', 'i18n!nls/app', 'jquery'], function(alertify, lang, $) {
	alertify.defaults.glossary = {
		title: lang.app.title,
		ok: lang.generic.confirm,
		cancel: lang.generic.cancel
	};
	alertify.set('notifier','position', 'top-right');
	
	define("lang", lang);
	
	$.ajaxSetup({
		error: function(jqXHR) {
			if (jqXHR.responseJSON && jqXHR.responseJSON.msg) {
				var msg = jqXHR.responseJSON.msg;
				alertify.error(msg);
			}
		}
	});
	
	require(['ready'], function() {
		
	});
});