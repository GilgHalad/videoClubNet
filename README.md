# videoClubNet

Pasos para instalar

composer update

php bin/console doctrine:database:create
php bin/console doctrine:schema:create
bin/console doctrine:fixture:load

php -S localhost:8000 -t public

Usuarios logueados:
admin@prueba.com  -> pass: 123
admin@prueba.com  -> pass: 123
