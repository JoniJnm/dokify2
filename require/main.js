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
		},
		'datatables.net': {
			deps: [
				'jquery'
			]
		},
		datatable: {
			deps: [
				'datatables.net'
			]
		},
	},
	paths: {
		bootstrap: '../bower_components/bootstrap/dist/js/bootstrap.min',
		jquery: '../bower_components/jquery/dist/jquery.min',
		text: '../bower_components/text/text',
		i18n: '../bower_components/i18n/i18n',
		jstemplate: '../bower_components/jstemplate/dist/jstemplate.min',
		tplparse: '../bower_components/jstemplate/src/tplparse',
		underscore: '../bower_components/underscore/underscore-min',
		alertify: '../bower_components/AlertifyJS/build/alertify.min',
		'datatables.net': '../bower_components/datatables.net/js/jquery.dataTables.min',
		datatable: '../bower_components/datatables.net-bs/js/dataTables.bootstrap.min'
	}
});

require(['alertify', 'i18n!nls/app', 'jquery'], function(alertify, lang, $) {
	alertify.defaults.glossary = {
		title: lang.app.title,
		ok: lang.generic.confirm,
		cancel: lang.generic.cancel
	};
	alertify.set('notifier','position', 'top-right');
	
	$.ajaxSetup({
		error: function(jqXHR) {
			if (jqXHR.responseJSON && jqXHR.responseJSON.msg) {
				var msg = jqXHR.responseJSON.msg;
				alertify.error(msg);
			}
		}
	});
	
	$.getJSON('vendor/datatable_langs/es.json', function(data) {
		lang.datatable = data;
		define("lang", lang);
		
		require(['ready'], function() {

		});
	});
});