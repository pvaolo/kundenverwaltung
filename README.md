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

1. Navigate to the Quasar project directory:
    ```sh
    cd quasar-project
    ```

2. Install Quasar project dependencies:
    ```sh
    npm install
    ```

## Contact

For any inquiries or support, please contact Paul Linke at [zack.linke@gmail.com](mailto:zack.linke@gmail.com).