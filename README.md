

### Установка

Для разворачивания проекта создать в docker valume с именем genomed_db_mysql и запустить следующие команды:

~~~
docker-compose up -d --build
composer install
php yii migrate
~~~

Главная страница:

~~~
http://localhost:8000
~~~


