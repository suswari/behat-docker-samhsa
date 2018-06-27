debug-start:
	@docker-compose -f docker-compose.debug.yml up -d
	@docker-compose -f docker-compose.debug.yml exec behat cp ./project-yamls/*.yml /srv
debug-run:
	sh debug.sh ${features}
	# usage: make debug-run features=features/trunk
debug-stop:
	@docker-compose -f docker-compose.debug.yml down
test:
	sh test.sh ${features}