# ============================================
# Makefile для Laravel + Docker проекта
# Репозиторий: https://github.com/ElGastar/laravelWithDocker
# ============================================

# Переменные
DOCKER_COMPOSE = docker-compose
EXEC = $(DOCKER_COMPOSE) exec
RUN = $(DOCKER_COMPOSE) run --rm

# Цвета для красивого вывода
GREEN = \033[0;32m
RED = \033[0;31m
YELLOW = \033[0;33m
BLUE = \033[0;34m
NC = \033[0m # No Color

# ============================================
# Основные команды
# ============================================

.PHONY: help
help: ## Показать все доступные команды
	@printf "$(GREEN)Доступные команды для Laravel + Docker:$(NC)\n"
	@echo ""
	@printf "$(YELLOW)Управление контейнерами:$(NC)\n"
	@echo "  make up           - Запустить все контейнеры"
	@echo "  make down         - Остановить все контейнеры"
	@echo "  make restart      - Перезапустить все контейнеры"
	@echo "  make build        - Пересобрать образы (без кеша)"
	@echo "  make ps           - Показать статус контейнеров"
	@echo "  make logs         - Показать логи (пример: make logs s=php)"
	@echo ""
	@printf "$(YELLOW)Работа с проектом:$(NC)\n"
	@echo "  make shell        - Войти в контейнер PHP (bash)"
	@echo "  make composer     - Запустить Composer (пример: make composer cmd=install)"
	@echo "  make artisan      - Запустить Artisan (пример: make artisan cmd=migrate)"
	@echo "  make test         - Запустить PHPUnit тесты"
	@echo "  make clear        - Очистить кеш Laravel"
	@echo ""
	@printf "$(YELLOW)Быстрые команды:$(NC)\n"
	@echo "  make fresh        - Полная пересборка + миграции"
	@echo "  make install      - Установка проекта с нуля"
	@echo "  make migrate      - Запустить миграции"
	@echo "  make rollback     - Откатить миграции"
	@echo "  make seed         - Заполнить БД тестовыми данными"
	@echo ""

# ============================================
# Управление контейнерами
# ============================================

up: ## Запустить все контейнеры
	@printf "$(GREEN)▶️  Запуск контейнеров...$(NC)\n"
	$(DOCKER_COMPOSE) up -d
	@printf "$(GREEN)✅ Контейнеры запущены!$(NC)\n"
	@make ps

down: ## Остановить все контейнеры
	@printf "$(RED)⏹  Остановка контейнеров...$(NC)\n"
	$(DOCKER_COMPOSE) down
	@printf "$(GREEN)✅ Контейнеры остановлены$(NC)\n"

restart: ## Перезапустить все контейнеры
	@printf "$(GREEN)🔄 Перезапуск контейнеров...$(NC)\n"
	$(DOCKER_COMPOSE) restart
	@printf "$(GREEN)✅ Контейнеры перезапущены$(NC)\n"

build: ## Пересобрать образы
	@printf "$(GREEN)🔨 Сборка образов...$(NC)\n"
	$(DOCKER_COMPOSE) build --no-cache
	@printf "$(GREEN)✅ Сборка завершена!$(NC)\n"

ps: ## Показать статус контейнеров
	@printf "$(BLUE)📊 Статус контейнеров:$(NC)\n"
	$(DOCKER_COMPOSE) ps

logs: ## Показать логи (make logs s=php)
	@if [ -z "$(s)" ]; then \
		$(DOCKER_COMPOSE) logs -f; \
	else \
		$(DOCKER_COMPOSE) logs -f $(s); \
	fi

# ============================================
# Работа с PHP контейнером
# ============================================

shell: ## Войти в контейнер PHP (bash)
	@printf "$(GREEN)🐚 Вход в контейнер PHP...$(NC)\n"
	$(EXEC) php sh

# ============================================
# Composer команды
# ============================================

composer: ## Запустить Composer (make composer cmd=install)
	@if [ -z "$(cmd)" ]; then \
		printf "$(RED)❌ Ошибка: укажите команду!$(NC)\n"; \
		printf "$(YELLOW)Пример: make composer cmd=install$(NC)\n"; \
		exit 1; \
	fi
	@printf "$(GREEN)📦 Запуск composer $(cmd)...$(NC)\n"
	$(RUN) composer $(cmd)

# ============================================
# Artisan команды
# ============================================

artisan: ## Запустить Artisan (make artisan cmd=migrate)
	@if [ -z "$(cmd)" ]; then \
		printf "$(RED)❌ Ошибка: укажите команду!$(NC)\n"; \
		printf "$(YELLOW)Пример: make artisan cmd=migrate$(NC)\n"; \
		exit 1; \
	fi
	@printf "$(GREEN)⚡ Запуск artisan $(cmd)...$(NC)\n"
	$(RUN) artisan $(cmd)

# ============================================
# Команды для миграций
# ============================================

migrate: ## Запустить миграции
	@printf "$(GREEN)📊 Запуск миграций...$(NC)\n"
	$(RUN) artisan migrate

rollback: ## Откатить миграции
	@printf "$(YELLOW)⏪ Откат миграций...$(NC)\n"
	$(RUN) artisan migrate:rollback

seed: ## Заполнить БД тестовыми данными
	@printf "$(GREEN)🌱 Заполнение БД данными...$(NC)\n"
	$(RUN) artisan db:seed

fresh: down build up migrate seed ## Полная пересборка + миграции с сидами
	@printf "$(GREEN)✅ Проект полностью обновлен!$(NC)\n"

# ============================================
# Дополнительные команды
# ============================================

test: ## Запустить тесты PHPUnit
	@printf "$(GREEN)🧪 Запуск тестов...$(NC)\n"
	$(RUN) artisan test

clear: ## Очистить весь кеш Laravel
	@printf "$(GREEN)🧹 Очистка кеша...$(NC)\n"
	$(RUN) artisan cache:clear
	$(RUN) artisan view:clear
	$(RUN) artisan route:clear
	$(RUN) artisan config:clear
	@printf "$(GREEN)✅ Кеш очищен$(NC)\n"

install: down build up ## Полная установка проекта с нуля
	@printf "$(GREEN)📦 Установка зависимостей...$(NC)\n"
	$(RUN) composer install
	@printf "$(GREEN)🔑 Генерация ключа...$(NC)\n"
	$(RUN) artisan key:generate
	@printf "$(GREEN)📊 Запуск миграций...$(NC)\n"
	$(RUN) artisan migrate --seed
	@printf "$(GREEN)✅ Проект успешно установлен!$(NC)\n"

# ============================================
# Создание классов Laravel (удобные алиасы)
# ============================================

model: ## Создать модель (make model name=Post)
	@if [ -z "$(name)" ]; then \
		printf "$(RED)❌ Укажите имя модели: make model name=Post$(NC)\n"; \
		exit 1; \
	fi
	$(RUN) artisan make:model $(name)

controller: ## Создать контроллер (make controller name=PostController)
	@if [ -z "$(name)" ]; then \
		printf "$(RED)❌ Укажите имя контроллера: make controller name=PostController$(NC)\n"; \
		exit 1; \
	fi
	$(RUN) artisan make:controller $(name)

middleware: ## Создать middleware (make middleware name=Auth)
	@if [ -z "$(name)" ]; then \
		printf "$(RED)❌ Укажите имя middleware: make middleware name=Auth$(NC)\n"; \
		exit 1; \
	fi
	$(RUN) artisan make:middleware $(name)

migration: ## Создать миграцию (make migration name=create_posts_table)
	@if [ -z "$(name)" ]; then \
		printf "$(RED)❌ Укажите имя миграции: make migration name=create_posts_table$(NC)\n"; \
		exit 1; \
	fi
	$(RUN) artisan make:migration $(name)

# ============================================
# Работа с БД напрямую
# ============================================

db: ## Войти в MySQL (через контейнер)
	@printf "$(GREEN)🐬 Вход в MySQL...$(NC)\n"
	$(EXEC) mysql mysql -u root -p

# ============================================
# Очистка системы (всех контейнеров и данных)
# ============================================

clean: ## Полная очистка (остановка + удаление volumes)
	@printf "$(RED)⚠️  Полная очистка системы...$(NC)\n"
	$(DOCKER_COMPOSE) down -v
	@printf "$(GREEN)✅ Все контейнеры и данные удалены$(NC)\n"