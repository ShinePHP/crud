<?php

namespace ShinePHP\DataObjects;

use ShinePHP\DataObjects\BaseDataObject;

class DatabaseConnectionDetailsDataObject extends BaseDataObject {
	/**
	 * @var string $dsn data source name (ie -> database collection details)
	 */
	$dsn;
	/**
	 * @var string $username database username
	 */
	$username;
	/**
	 * @var string $password database password
	 */
	$password;
}