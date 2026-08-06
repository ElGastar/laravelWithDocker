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
