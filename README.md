Для запуска контейнеров использем команду
'''
docker-compose up -d
'''

Для создания проекта ларавел используем команду 
'''
docker-compose run --rm composer create-project laravel/laravel /*можно указать версию Ларавел*/
'''
для создания таблиц используем команду
'''
docker-compose run --rm artisan migrate
'''
🚀 Как использовать ваш новый Makefile
Базовые команды:
bash
make up          # Запустить все контейнеры
make down        # Остановить все контейнеры
make restart     # Перезапустить
make build       # Пересобрать образы
make ps          # Статус контейнеров
make shell       # Войти в PHP контейнер
Работа с Composer:
bash
make composer cmd=install              # composer install
make composer cmd="require laravel/tinker"  # установка пакета
make composer cmd=update               # composer update
make composer cmd=dump-autoload        # composer dump-autoload
Работа с Artisan:
bash
make artisan cmd=migrate               # запуск миграций
make artisan cmd="make:model Post -m"  # создать модель с миграцией
make artisan cmd=cache:clear           # очистить кеш
make artisan cmd=tinker                # войти в tinker
make artisan cmd="make:controller PostController --resource"  # создать ресурс-контроллер
Быстрые команды (сокращения):
bash
make migrate      # php artisan migrate
make rollback     # php artisan migrate:rollback
make seed         # php artisan db:seed
make test         # php artisan test
make clear        # очистка кеша
make fresh        # полная пересборка + миграции
make install      # установка проекта с нуля
Создание классов:
bash
make model name=Post              # создать модель
make controller name=PostController # создать контроллер
make middleware name=Auth         # создать middleware
make migration name=create_posts_table # создать миграцию
Логи:
bash
make logs         # логи всех контейнеров
make logs s=php   # логи PHP
make logs s=nginx # логи Nginx
make logs s=mysql # логи MySQL
Дополнительно:
bash
make db           # войти в MySQL через контейнер
make clean        # полная очистка (удаляет всё)
make help         # показать все команды
📝 Пример рабочего процесса
bash
# Первый запуск проекта
git clone https://github.com/ElGastar/laravelWithDocker.git
cd laravelWithDocker

make install      # Всё установится автоматически: сборка, composer install, миграции

# Обычная работа
make shell        # Войти в контейнер и работать внутри
make artisan cmd="make:model Post"
make migrate

# Если нужно сбросить всё
make fresh        # Пересборка + миграции с сидами
💡 Важные моменты
cmd= — пишите без пробелов: cmd=install, а не cmd = install

Команды с пробелами — используйте кавычки: cmd="require laravel/tinker"

Логи — используйте s=: make logs s=php

Создание классов — используйте name=: make model name=User

🔧 Проверьте, что всё работает
bash
# Проверка версии Make
make --version

# Проверка доступных команд
make help

# Запуск контейнеров
make up
Теперь у вас есть профессиональный Makefile для вашего проекта! 🎉 Он полностью совместим с вашим docker-compose.yaml и структурой проекта.

