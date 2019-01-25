### TODO

- Use prooph too for command bus instead of only event bus
- 100% coverage for unit tests
- architecture review
## dependencies
Docker with docker compose

## Instructions
- git clone https://github.com/zimonbizkit/cqrs_biolerplate.git
- docker-compose -f docker-compose.yml up -d
- docker-compose run fpm composer.phar install

## Tests
 To execute the unit tests:
 - docker-compose run fpm vendor/phpunit/phpunit/phpunit
 
 And to run the only acceptance test
 - docker-compose run fpm vendor/behat/behat/bin/behat
 
 

