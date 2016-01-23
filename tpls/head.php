<?php

use JNMFW\helpers\HLang;
use dokify2\langs\Lang;

?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?= HLang::get(Lang::app_title) ?></title>

	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="bower_components/AlertifyJS/build/css/alertify.min.css">
	<link rel="stylesheet" href="bower_components/AlertifyJS/build/css/themes/default.min.css">
	<link rel="stylesheet" href="css/app.css">

	<script data-main="require/main" src="bower_components/requirejs/require.js"></script>

</head>
