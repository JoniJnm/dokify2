<?php

namespace dokify2\includes;

abstract class BaseConfig {
	const LOG_FILE = 'logs/app.log';
	const LOG_LEVEL = 2; //0:verbose, 1:debug, 2:warning, 3:error, 4:none
	const PHP_LOG_FILE = 'logs/php_errors.log';
	const DB_PREFIX = '';
}
