## Server :
- `symfony.exe server:start` https://127.0.0.1:8000/liens/new
- `symfony.exe server:stop` stop server 
- `symfony open:local` open local server

## Create new symfony project : 
- `cd /c/xampp/htdocs/`
- `symfony.exe new sfbookmark --webapp` install symfony complet 
- `git rm --cached .env.test`
- `git rm --cached .env`
- add .env.test and .env in .gitignore
- commit
- create .env.local, inside:
DATABASE_URL="mysql://root:@127.0.0.1:3306/sfcookbook?serverVersion=10.4.28-MariaDB&charset=utf8mb4"

## ! TO INTAGRATE EXISTING DB INTO YOUR NEW SYMFONY PROJECT:
- DATABASE_URL="mysql://root:@127.0.0.1:3306/cookbook?serverVersion=10.4.28-MariaDB&charset=utf8mb4"
- `php bin/console doctrine:mapping:import --force App\\Entity annotation --path=src/Entity` This command will generate entity classes in the `src/Entity` directory based on your existing database tables.
- `php bin/console make:entity --regenerate App` 
- `php bin/console doctrine:schema:update --force` 

## Create Entity : 
- `php bin/console make:entity` command to create table in DBs and fields
- `php bin/console make:migration` !important: each time you make a change in table structure in php file, you have to run migrate command
- `php bin/console doctrine:migrations:migrate`
- `symfony.exe console doctrine:migrations:diff` 
- `php bin/console doctrine:migrations:status`

## Create CRUD :
- `symfony.exe console make:crud` created CRUD for table 
- `symfony.exe console debug:router` to check all existing routes

## Create assset (stylesheet, js, img) :
- `composer req twig symfony/asset`

## Make new Controller :
- `php bin/console make:controller HomeController` create new controller

## Add new column in existing db table :
`php bin/console make:entity` !important: in "Class name of the entity to create or update" you put existing entity name, and then you can add new property name

## Cache clear :
- `php bin/console cache:clear` clear syfmony cache
- `php bin/console doctrine:cache:clear-metadata` clear cache database

## Delete a table from database :
`php bin/console doctrine:query:sql "DROP TABLE your_table_name;"`