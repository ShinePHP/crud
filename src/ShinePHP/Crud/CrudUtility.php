<?php

namespace ShinePHP\Crud;

class CrudUtility {

	static function sanitize_name(string $raw_name, array $allow_list = []): string {
		$searched_for_key = \array_search($raw_name, $allow_list);
		if (!empty($allow_list) && $searched_for_key === false) {
			throw new UnexpectedValueException('Value ' . $raw_name . ' does not exist in the value whitelist');
		} else if (!empty($allow_list) && $searched_for_key !== false) {
			return $allow_list[$searched_for_key];
		} else {
			return '`' . \str_replace('`', '``', $raw_name) . '`';
		}
	}

}