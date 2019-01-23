#!/bin/bash
docker-compose run fpm composer.phar install
docker-compose run fpm vendor/phpunit/phpunit/phpunit