# codechallenge-moolahgo by Bayu Indrawan

## API Service Lumen PHP Framework

### Server Requirements

1. PHP >= 7.3
2. OpenSSL PHP Extension
3. PDO PHP Extension
4. Mbstring PHP Extension
5. Composer

### Service App SetUp
1. Open Terminal
2. Open `mysql` create new database `db_moolahgo` than exit from `mysql`
3. Clone this repo Go to `service` folder than composer install
4. Open `.env` edit database configuration ['DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']
5. Run `php artisan migrate`
6. Run `php artisan db:seed`
7. Run API `php -S [host]:[port] -t public` ex: `php -S localhost:8000 -t public`
8. The API Service is running.