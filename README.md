# Kundenverwaltung

This project is a customer management system built with Laravel for the backend and Quasar for the frontend.

## Getting Started

### Prerequisites

- PHP >= 8.0
- Composer
- Node.js & npm
- Docker & Docker Compose

### Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/yourusername/kundenverwaltung.git
    cd kundenverwaltung
    ```

2. Install dependencies:
    ```sh
    composer install
    npm install
    ```

3. Copy the `.env.example` file to `.env` and configure your environment variables:
    ```sh
    cp .env.example .env
    ```

4. Generate an application key:
    ```sh
    php artisan key:generate
    ```

5. Run the database migrations:
    ```sh
    php artisan migrate
    ```

6. Start the development server:
    ```sh
    php artisan serve
    ```

### Docker Setup

1. Build and start the Docker containers:
    ```sh
    docker-compose up --build
    ```

### Quasar Setup

1. Install Quasar CLI globally:
    ```sh
    npm install -g @quasar/cli
    ```

2. Navigate to the Quasar project directory:
    ```sh
    cd quasar-project
    ```

3. Install Quasar project dependencies:
    ```sh
    npm install
    ```

4. Start the Quasar development server:
    ```sh
    quasar dev
    ```

## Project Structure

### Backend (Laravel)

- **Models**: Located in `app/Models`, these represent the data structure of the application.
- **Controllers**: Located in `app/Http/Controllers`, these handle the business logic and HTTP requests.
- **Routes**: Defined in `routes/web.php` and `routes/api.php`, these map URLs to controllers.
- **Migrations**: Located in `database/migrations`, these handle database schema changes.
- **Factories**: Located in `database/factories`, these generate fake data for testing.

### Frontend (Quasar)

- **Components**: Located in `resources/js/components`, these are the building blocks of the UI.
- **Models**: Located in `resources/js/models`, these handle data fetching and manipulation.
- **Views**: Located in `resources/views`, these are the Blade templates for server-side rendering.

## Running Tests

### Feature Tests

Feature tests are located in `tests/Feature`. To run them, use:
```sh
php artisan test --testsuite=Feature
```

### Unit Tests

Unit tests are located in `tests/Unit`. To run them, use:
```sh
php artisan test --testsuite=Unit
```

## API Endpoints

### Customers

- **GET /api/customers**: Retrieve all customers.
- **GET /api/customers/{id}**: Retrieve a specific customer by ID.
- **POST /api/customers**: Create a new customer.
- **PUT /api/customers/{id}**: Update an existing customer.
- **DELETE /api/customers/{id}**: Delete a customer.

## Contact

For any inquiries or support, please contact Paul Linke at [zack.linke@gmail.com](mailto:zack.linke@gmail.com).