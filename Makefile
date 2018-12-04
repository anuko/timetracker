NAME=anuko-timetracker

.PHONY: default
default: start

.PHONY: lint
lint:
	@echo "Linting Dockerfile"
	@docker run --rm -i hadolint/hadolint < Dockerfile
	@echo "Successfully linted Dockerfile"

.PHONY: build
build:
	@echo "Building docker image"
	@docker-compose --project-name ${NAME} build

.PHONY: start
start:
	@echo "Starting dependencies"
	@docker-compose --project-name ${NAME} run --rm dependencies
	@echo "Starting up services"
	@docker-compose --project-name ${NAME} run --rm --service-ports --detach timetracker

.PHONY: stop
stop:
	@echo "Stopping services"
	@docker-compose --project-name ${NAME} down --remove-orphans

.PHONY: status
status:
	@echo "Service status"
	@docker-compose --project-name ${NAME} ps

.PHONY: clean
clean:
	@echo "Removing images and volumes"
	@docker-compose --project-name ${NAME} down --remove-orphans --volumes --rmi local
