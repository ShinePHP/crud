<?php

namespace ShinePHP\Crud;

use ShinePHP\DataObjects\DatabaseConnectionDetailsDataObject;
use ShinePHP\DataObjects\DatabaseChangeDataObject;
use ShinePHP\Exceptions\CrudException;

class Crud {

	protected $pdo;

	public function __construct(DatabaseConnectionDetailsDataObject $dbConnectionDetails, bool $persistentConnections = true) {
		$this->pdo = new \PDO($dbConnectionDetails->dsn, $dbConnectionDetails->username, $dbConnectionDetails->password, [
	        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, 
	        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
	        \PDO::ATTR_PERSISTENT => $persistentConnections
		]);
	}

	public function read(string $sql, array $values = [], bool $returnSingleRow = false): array {
		$pdoStmt = $this->runQuery($sql, $values);
		$dataReturn = $pdoStmt->fetchAll();
		$pdoStmt->closeCursor();
		$pdoStmt = null;
		if (empty($dataReturn)) {
			return [];
		} else {
			return ($returnSingleRow ? $dataReturn[0] : $dataReturn);
		}
	}

	public function change(string $sql, array $values = []): DatabaseChangeDataObject {
		try {
			$this->pdo->beginTransaction();
			$stmt = $this->runQuery($sql, $values);
			$changeReturn = array(
				'lastInsertId' => $this->pdo->lastInsertId(),
				'rowCount' => $stmt->rowCount()
			);
			$this->pdo->commit();
		} catch (\Exception $ex) {
			$this->pdo->rollBack();
			throw new CrudException('There has been a problem with the database transaction. It has been rolled back. Here is the error message: '.$ex->getMessage());
		}
		$stmt->closeCursor();
		$stmt = null;
		return new DatabaseChangeDataObject($changeReturn);
	}

	public function setPdoAttribute(int $attribute, $value): bool {
		return $this->pdo->setAttribute($attribute, $value);
	}

	public function kill(): void {
		$this->pdo = null;
	}

	private function runQuery(string $sql, array $values): \PDOStatement {
		if (empty($values)) {
			$stmt = $this->pdo->query($sql);
		} else {
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute($values);
		}
		return $stmt;
	}

}