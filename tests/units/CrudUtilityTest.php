<?php

use PHPUnit\Framework\TestCase;
use ShinePHP\Crud\CrudUtility;

final class CrudUtilityTest extends TestCase {

	public function testDoesSanitizeRawString(): void {
		$this->assertEquals(CrudUtility::sanitizeName('user_id'), '`user_id`');
		$this->assertEquals(CrudUtility::sanitizeName('`user_id`'), '```user_id```');
	}

}