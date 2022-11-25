#!/bin/bash
./vendor/bin/phpunit --colors
./vendor/bin/phpcbf
./vendor/bin/phpcs
