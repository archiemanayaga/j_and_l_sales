# J And L Flowershop Sales Management System

## Terminal Commands

1. Open iTerm
2. type: cd /Applications/MAMP/htdocs/sales

### To locate the tables script

Path: database/migration/

### To create new migration table
Note: model 'name' must be singular.

Type:
php artisan make:model [name] -m 

### To migrate or to make the table's available in the flowershop_sales db.

Type:
php artisan migrate

### To reset the migration

Type:
php artisan migrate:reset

## For table foreign keys
use the following:

$table->foreign('customer_id')->references('customer_id')->on('customers');

## For non foreign keys and its an id reference
use the following:

$table->integer('flower_id')->index()