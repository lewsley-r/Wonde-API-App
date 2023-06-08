setup:
	npm install --prefix ./backend 
	cd backend && composer install 
	npm install --prefix ./frontend
	make db
	make seed
	@echo "Set-up is complete with default login;"
	@echo "*** User: teacher@wonde.com ***"
	@echo "*** Password: teacher1234 ***"
	make start

db:	
	sudo chmod 777 backend/dartisan
	cd backend && ./dartisan key:generate
	cd backend && ./dartisan migrate

start:
	cd backend && docker-compose up -d

stop:
	cd backend && docker-compose stop

seed:
	cd backend && ./dartisan db:seed

test: 
	make backend-test
	make frontend-test

backend-test: 
	cd backend && php artisan test

frontend-test:
	cd frontend && npx cypress run

