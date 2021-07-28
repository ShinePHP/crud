#!/bin/bash

# vars needed
ERROR_STRING="Errors parsing"
# view PHP files
for f in `find src/ -name '*.php'`
do
	PHP_RETURN=`php -l $f`
	if [[ "$PHP_RETURN" == *"$ERROR_STRING"* ]]; then
		printf "\033[0;31m$PHP_RETURN\033[0m"
		exit 1
	else
		echo $PHP_RETURN
	fi
	FIRST_LINE_PHP=`head -n 1 $f`
	if [[ "$FIRST_LINE_PHP" != "<?php" ]]; then
		printf "\033[0;31mThe first line of $f needs to be \"<?php\"\033[0m"
		exit 1
	fi
done