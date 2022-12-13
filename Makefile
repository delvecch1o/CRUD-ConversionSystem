SAIL_PATH=./api/vendor/bin/sail

.PHONY: init
init:
	cp api/.env.example api/.env
	docker compose up -d
	docker exec -it crud-conversionsystem-back-1 php artisan migrate --seed

.PHONY: install
start:
	docker compose up -d