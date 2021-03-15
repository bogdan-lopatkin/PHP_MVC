start:
	@docker-compose -f docker-compose.yml up -d

stop:
	@docker-compose -f docker-compose.yml down

ssh:
	@docker-compose exec web bash
