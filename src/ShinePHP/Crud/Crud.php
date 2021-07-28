<?php

namespace ShinePHP\Crud;

use ShinePHP\DataObjects\DatabaseConnectionDetailsDataObject;

class Crud {

	protected $pdo;

	public function __construct(DatabaseConnectionDetailsDataObject $dbConnectionDetails, bool $persistentConnections = true) {
		$this->pdo = new \PDO($dbConnectionDetails->dsn, $dbConnectionDetails->username, $dbConnectionDetails->password, [
	        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, 
	        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
	        \PDO::ATTR_PERSISTENT => $persistentConnections
		]);
	}

	public function read(): array {
		//
	}

	public function change(): SomethingDataObject {
		//
	}

	public function setPdoAttribute(int $attribute, $value): bool {
		return $this->pdo->setAttribute($attribute, $value);
	}

}