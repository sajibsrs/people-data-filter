# # Commands

### # Configuration
Add line below to `.env` file.
```console
REDIS_CLIENT=predis
```

### # Install composer dependencies
```console
composer install
```
### # Install node.js dependencies
```console
npm install
```
### # Compile assets
```console
npm run dev
```
or
```console
npm run prod
```

### # Database migration and seeding
Create database and configure Laravel. Then run:

```console
php artisan migrate:fresh --seed
```
*Note: CSV data file located at `/public/seeders/test-data.csv'.*

### # Run the server
```console
php artisan serve
```
*Note: Navigate to `http://127.0.0.1:8000/dashboard`*
