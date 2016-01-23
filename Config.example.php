<?php

namespace dokify2;

use dokify2\includes\BaseConfig;

abstract class Config extends BaseConfig {
	const DB_SERVER = "127.0.0.1";
	const DB_USER = "root";
	const DB_PASSWORD = "root";
	const DB_NAME = "dokify2";
}