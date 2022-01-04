# videoClubNet

--------- Pasos para instalar ----------

composer update

php bin/console doctrine:database:create
php bin/console doctrine:schema:create
bin/console doctrine:fixture:load

----------------Levantar ---------------

php -S localhost:8000 -t public

----------------- Info -----------------

BD MYSQL 127.0.0.1 videoclub  User: root  Pass: root
Usuarios logueados:
admin@prueba.com  -> pass: 123
admin@prueba.com  -> pass: 123
