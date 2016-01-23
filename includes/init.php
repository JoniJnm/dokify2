<?php

namespace dokify2\includes;

use JNMFW\helpers\HLog;
use dokify2\Config;
use JNMFW\classes\cache\CacheXCache;
use JNMFW\classes\cache\CacheManager;
use JNMFW\classes\databases\DBFactory;
use JNMFW\classes\databases\mysqli\MySQLiDriver;

loadJNMFW();

require('jnmfw/AutoLoad.php');

\spl_autoload_register(function ($className) {
	\JNMFW\jnmfw_autoload($className, 'dokify2', dirname(__DIR__));
});

$logfile = Config::PHP_LOG_FILE;
if ($logfile) {
	if (substr($logfile, 0, 1) != '/') {
		$logfile = dirname(__DIR__).'/'.$logfile;
	}
	ini_set("error_log", $logfile);
}

$logfile = Config::LOG_FILE;
if ($logfile) {
	if (substr($logfile, 0, 1) != '/') {
		$logfile = dirname(__DIR__).'/'.$logfile;
	}
	HLog::setFile($logfile);
}

HLog::setLevel(Config::LOG_LEVEL);

\JNMFW\helpers\HLang::init('ES', 'ES', 'dokify2\langs');

$driver = new MySQLiDriver(Config::DB_SERVER, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
$driver->setPrefix(Config::DB_PREFIX);

DBFactory::registerDefaultInstance($driver);

if (CacheXCache::isEnabled()) {
	$cache = CacheManager::getInstance();
	$cache->setLocalCache(new CacheXCache());
}

function loadJNMFW() {
	// cargar librería JNMFW
	// puede estar en una subcarpeta,
	// en la superior o ya incluida en el php.ini
	
	if (stripos(get_include_path(), 'jnmfw')) {
		return;
	}

	$root_path = dirname(__DIR__);
	$jnmfw = $root_path.'/jnmfw';
	if (!is_dir($jnmfw)) {
		$jnmfw = dirname($root_path).'/jnmfw';
		if (!is_dir($jnmfw)) $jnmfw = null;
	}
	if ($jnmfw) {
		set_include_path(get_include_path() . PATH_SEPARATOR . $jnmfw);
	}
}