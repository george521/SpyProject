Setup Instructions

Prerequisites
PHP >= 8.1
Composer (for PHP dependency management)
MySQL

Step 1: Clone the Repository
bash
Αντιγραφή κώδικα
git clone https://github.com/george521/SpeProject.git
cd famous-spies-api
Step 2: Install PHP Dependencies
Run composer install to install the necessary PHP packages:

bash
composer install

Step 3: Set Up the Environment
Copy the .env.example file to .env and configure your database and other environment variables:

bash
cp .env.example .env

Then, update .env with your database credentials:

env
Αντιγραφή κώδικα
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mysql
DB_USERNAME=root
DB_PASSWORD=secret

Step 4: Generate Application Key
Laravel requires an application key for encryption. Generate this key with the following command:

bash
php artisan key:generate

Step 5: Run Migrations
Run the database migrations to set up the necessary tables:

bash
php artisan migrate
This will create the spies table and any other necessary tables for authentication and other features.

Step 6: Start the Development Server

php artisan serve


API Endpoints

1. Create Spy
POST /api/spies
Request:
json
{
  "username": "admin",
  "password": "admin",
  "name": "James",
  "surname": "Bond",
  "agency": "CIA",
  "country_of_operation": "United Kingdom",
  "date_of_birth": "1980-01-01",
  "date_of_death": null
}

Response:
json
{
  {
    "id": 1,
    "name": "James",
    "surname": "Bond",
    "agency": "CIA",
    "country_of_operation": "United Kingdom",
    "date_of_birth": "1980-01-01",
    "date_of_death": null
  }
}

2. List Random Spies
POST /api/spies/random
Rate-limited: 10 requests per minute

Response:
json
[
  {
    "name": "James",
    "surname": "Bond",
    "agency": "CIA",
  }
]

3. List Paginated Spies
POST /api/spies/list

Query Parameters:

fetch: Page number for pagination

sort: array of values (fullname, date_of_birth, date_of_death)

filters: array of values (name or surname, exact_age or range_age)

if filters array has name need to pass name

if filters array has surname need to pass surname

if filters array has exact_age need to pass age

if filters array has range_age need to pass from and to

Testing
This project follows Test-Driven Development (TDD). Unit and feature tests are written using PHPUnit.

To run the tests:

bash
php artisan test
Tests are located in the tests/ directory.
