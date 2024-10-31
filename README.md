## Project Laravel

##Requirements

Version PHP >= 8.

1. Clone project
``` bash
git 

cp .env.example .env
```

##Usage
- Config your database in file .env
``` bash
DB_CONNECTION=mysql
DB_HOST=database_server_ip
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=
DB_PASSWORD=
```

- And Change BROADCAST_DRIVER in file .env
``` bash
BROADCAST_DRIVER=pusher
```

2. Install Package
``` bash
composer install

php artisan key:generate

npm install

php artisan migrate

php artisan db:seed

php artisan storage:link

php artisan ser
```

3. Run
``` bash
Page client: localhost:8000
Page admin: localhost:8000/admin
```

