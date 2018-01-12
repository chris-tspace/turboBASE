# turboBASE

## Installation procedure

```bash
git clone git@github.com:chris-tspace/turboBASE.git

sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache

cp .env.example .env
```

update .env regarding the server configration

Spaces are not allowed. Use quotes for strings with spaces.

```bash
php artisan key:generate
php artisan migrate
```