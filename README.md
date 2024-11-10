Setup Instructions

Prerequisites
PHP >= 8.1
Composer (for PHP dependency management)
MySQL

Step 1: Clone the Repository
bash
Αντιγραφή κώδικα
git clone https://github.com/george521/SpyProject.git
cd SpyProject
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

Future Improvements
While the system is functional and follows the basic principles of DDD and CQRS, there are several areas where improvements can be made to enhance its robustness, scalability, and maintainability. Below are some thoughts on how I would improve the system if given more time.

Certainly! Below is a version of the suggestions written in a way that sounds like it's coming from you:

Future Improvements
If given more time to improve the system, here are a few areas I’d focus on to make the application more robust, scalable, and maintainable:

1. Improve Authentication & Authorization
Multi-Tier Authorization: One area for improvement would be adding more granular user roles and permissions. For example, I’d implement roles such as “read-only” access for certain users who only need to view spy records, while others might have “admin” privileges to create, update, or delete records. This would require adding an authorization layer where each action is verified against the user’s role and permissions.

OAuth2 Integration: If the system is to be extended for use by third-party applications, I’d consider implementing OAuth2 for authentication or integrating with identity providers like Google or GitHub. This would simplify user management, improve security, and provide users with a seamless login experience.

Rate-Limiting for Sensitive Actions: While rate-limiting for random spy requests is already in place, I would extend this to cover other sensitive actions, such as creating or updating spy records. Adding rate-limiting or throttling to these operations would help prevent abuse and ensure that high-value actions are protected from excessive use.

2. CQRS Enhancements
Separate Read and Write Models: At the moment, the system could benefit from a clearer separation of command and query models. If the application experiences significant growth in the number of reads and writes, I would introduce separate read-optimized models, such as caching mechanisms or a read replica database. This would help to offload and optimize read-heavy queries without affecting write operations.

Command and Event Handlers: As the system scales, it may be beneficial to break down the action classes (e.g., CreateSpyAction) into command handlers and event listeners. This would increase the system’s extensibility, making it easier to add new features or change existing functionality while maintaining a clean separation of concerns. It would also improve testing by isolating each component's responsibilities.

3. Database and Query Optimization
Database Indexing: The current database structure could be optimized by adding indexes, especially for frequently queried fields such as name, surname, agency, and date_of_birth. Adding these indexes would help to improve the performance of queries, filters, and sorting, especially as the number of spy records grows over time.

5. API Versioning and Documentation
API Versioning: As the API evolves and new features are added, I would implement API versioning to ensure that existing clients continue to work with older versions of the API. Laravel provides a few ways to version the API, such as prefixing routes with version numbers (e.g., /api/v1/spies). This would maintain backward compatibility and help avoid breaking changes for existing users.

API Documentation: Generating comprehensive API documentation would be an important step forward. I would use tools like Postman or Swagger to create up-to-date documentation. This would not only help developers who are working on the project but also external consumers who need to interact with the API.

5. Monitoring, Logging, and Error Handling
Centralized Logging: I would implement a centralized logging solution to gather and analyze logs across the application. This could be something like Sentry, Loggly, or Elasticsearch with Kibana for real-time error monitoring and performance tracking. This would make it easier to identify issues in production and address them before they impact users.

Error Handling: While Laravel does provide basic error handling, I would enhance this by adding more detailed error messages and custom exceptions for specific cases, such as when a spy record already exists, or when the input data is invalid. In addition, I’d log out failed login attempts and any database errors to help improve security and troubleshooting. This will ensure that errors are caught early and are easy to trace back to their source.
