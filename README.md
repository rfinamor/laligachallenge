# laligachallenge
Challenge of laligatech
Install PHP 8.1 or higher

Clone the repository into project folder:
git clone https://github.com/rfinamor/laligachallenge

Install dependencies:
cd my-project/
composer install

Generate migration of Database:
php bin/console doctrine:migrations:migrate

Load test data on file dump, found in the repository main folder

Start server:
symfony server:start
