<?php

namespace ShinePHP\DataObjects;

use ShinePHP\DataObjects\BaseDataObject;

class DatabaseConnectionDetailsDataObject extends BaseDataObject {
	/**
	 * @var string $dsn data source name (ie -> database collection details)
	 */
	public $dsn;
	/**
	 * @var string $username database username
	 */
	public $username;
	/**
	 * @var string $password database password
	 */
	public $password;
}