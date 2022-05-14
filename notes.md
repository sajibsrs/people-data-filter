# # Project notes and information

## # CSV data file issues
1. CSV file Has two extra blank lines (new lines). That might cause problem when not careful.
2. IP addresses are not unique. Which should be unique field, most probably.

*Note: Import and seeding took approximately 5 minutes 20 seconds.*

## # Commands

### Install composer dependencies
```console
composer install
```
### Install node.js dependencies
```console
npm install
```
### Compile assets
```console
npm run dev
```
or
```console
npm run prod
```

### Database migration and seeding
```console
php artisan migrate:fresh --seed
```
*Note: CSV data file located at `/public/seeders/test-data.csv'.*

### Run the server
```console
php artisan serve
```
*Note: Navigate to `http://127.0.0.1:8000/dashboard`*

## # Benchmark

### Year and month query
Query time is approximately 32 milliseconds average.

### Year query
Query time is approximately 33 milliseconds average.

### Month query
Query time is approximately 45 milliseconds average.

### Hardware
* CPU - Ryzen 5 3600
* RAM - 16GB DDR4
* GPU - RX 5500XT

### Software
* OS - Pop_Os! (debian linux).
* PHP - 8.1.2
* Laravel - 9.12.2
* Posgresql - 14.2
* Redis - 6.0.16
* Redis PHP client - predis
* Code editor - Visual Studio Code

## # Additional information
*Note: Helper classes are located in `app/Helpers` directory (if you are interested).*
