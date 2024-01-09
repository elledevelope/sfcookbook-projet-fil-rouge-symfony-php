
- `cd /c/xampp/htdocs/`
- `symfony.exe new sfbookmark --webapp` install symfony complet 
- `git rm --cached .env.test`
- `git rm --cached .env`
- add .env.test and .env in .gitignore
- commit
- create .env.local, inside:
DATABASE_URL="mysql://root:@127.0.0.1:3306/sfcookbook?serverVersion=10.4.28-MariaDB&charset=utf8mb4"
- `php bin/console make:entity` command to create table in DBs and fields
- `php bin/console make:migration`
- `php bin/console doctrine:migrations:migrate`
- `symfony.exe console doctrine:migrations:diff` 
- `symfony.exe console make:crud` created CRUD for table 
- `symfony.exe console debug:router` to check all existing routes

`symfony.exe server:start`

TO INTAGRATE EXISTING DB INTO YOUR NEW SYMFONY PROJECT:
- DATABASE_URL="mysql://root:@127.0.0.1:3306/cookbook?serverVersion=10.4.28-MariaDB&charset=utf8mb4"
- `php bin/console doctrine:mapping:import --force App\\Entity annotation --path=src/Entity` This command will generate entity classes in the `src/Entity` directory based on your existing database tables.
- php bin/console make:entity --regenerate App
- php bin/console doctrine:schema:update --force



- `php bin/console cache:clear` clear syfmony cache
- `composer req twig symfony/asset`