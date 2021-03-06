<?php

namespace ShinePHP\DataObjects;

use ShinePHP\DataObjects\BaseDataObject;

class DatabaseChangeDataObject extends BaseDataObject {
	/**
	 * @var int $rowCount The number of rows affected by the last DELETE, INSERT, or UPDATE statement executed by the corresponding PDOStatement object
	 */
	public $rowCount;
	/**
	 * @var string $lastInsertId The ID of the last inserted row, or the last value from a sequence object, depending on the underlying driver.
	 */
	public $lastInsertId;
}