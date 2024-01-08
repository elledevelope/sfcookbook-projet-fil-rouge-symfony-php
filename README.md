
- `cd /c/xampp/htdocs/`
- `symfony.exe new sfbookmark --webapp` install symfony complet 
- `git rm --cached .env.test`
- `git rm --cached .env`
- add .env.test and .env in .gitignore
- commit
- create .env.local, inside:

TO INTAGRATE EXISTING DB INTO YOUR NEW SYMFONY PROJECT:
- DATABASE_URL="mysql://root:@127.0.0.1:3306/cookbook?serverVersion=10.4.28-MariaDB&charset=utf8mb4"
- `php bin/console doctrine:mapping:import --force App\\Entity annotation --path=src/Entity` This command will generate entity classes in the `src/Entity` directory based on your existing database tables.
- php bin/console make:entity --regenerate App
- php bin/console doctrine:schema:update --force



- `php bin/console cache:clear` clear syfmony cache