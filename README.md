# Libri

Just clone the app to your working location 
1. Install it via Composer <br>
``` php composer install ``` <br>
2. Create the DB and load the fixtures <br>
``` php bin/console doctrine:database:create ``` <br>
``` php bin/console doctrine:fixtures:load ``` <br>
3. Update the schema <br>
``` php bin/console doctrine:schema:update --force ``` <br>
4. Run the server <br>
``` php bin/console server:run ```



