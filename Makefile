run-build:
	docker-compose build -q

run-tests:
	 docker-compose run -u 1000 app vendor/bin/phpunit tests

run-app:
	 docker-compose run app bin/cli -c sum -p "testdata/"