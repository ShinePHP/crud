<?php

namespace ShinePHP\Crud;

class CrudUtility {

	static function sanitizeName(string $rawName, array $allowList = []): string {
		$searchedForKey = \array_search($rawName, $allowList);
		if (!empty($allowList) && $searchedForKey === false) {
			throw new UnexpectedValueException('Value ' . $rawName . ' does not exist in the value allow list');
		} else if (!empty($allowList) && $searchedForKey !== false) {
			return $allowList[$searchedForKey];
		} else {
			return '`' . \str_replace('`', '``', $rawName) . '`';
		}
	}

}