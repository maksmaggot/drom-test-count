run-tests:
	docker-compose -f docker-compose.tests.yml build -q \
	&& docker-compose -f docker-compose.tests.yml run -u 1000 app vendor/bin/phpunit tests

run-app:
	docker-compose build -q && docker-compose run app