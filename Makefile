COMPOSE=docker-compose -f ./docker-compose.yml

up:
	$(COMPOSE) up -d --build

down:
	$(COMPOSE) down