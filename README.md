## Running the Project with Docker

This project includes Docker setup for a PHP 8.2 application running on Apache, with a MySQL database. The Docker configuration is tailored to the project's requirements and structure.

### Project-Specific Requirements
- **PHP Version:** 8.2 (see `FROM php:8.2-apache` in Dockerfile)
- **Installed PHP Extensions:** `gd`, `mysqli`, `pdo`, `pdo_mysql`, `zip`
- **Apache Module:** `mod_rewrite` enabled
- **System Dependencies:** `libpng-dev`, `libjpeg-dev`, `libfreetype6-dev`, `libzip-dev`, `zip`, `unzip`, `git`
- **Custom PHP Configuration:** Place your `php.ini` in `./application/php.ini` (copied during build)
- **Non-root User:** Application runs as `appuser` (for security)

### Required Environment Variables
- **MySQL Service:**
  - `MYSQL_ROOT_PASSWORD`: Root password for MySQL (default: `rootpassword` — change in production)
  - `MYSQL_DATABASE`: Database name (default: `appdb`)
  - `MYSQL_USER`: Database user (default: `appuser`)
  - `MYSQL_PASSWORD`: Database user password (default: `appuserpassword` — change in production)
- **Optional:** You may use an `.env` file in `./application` for additional environment variables (uncomment `env_file` in compose if needed).

### Build and Run Instructions
1. **Ensure your project structure matches the provided Docker setup.**
2. **Place your custom `php.ini` in `./application/php.ini` if needed.**
3. **(Optional) Create a `.env` file in `./application` for environment variables.**
4. **Build and start the services:**
   ```sh
   docker compose up --build
   ```
   This will build the PHP application image and start both the web and database containers.

### Special Configuration
- **.dockerignore:** Use a `.dockerignore` file to exclude `.git`, `.env`, lock files, and IDE configs from the build context.
- **Permissions:** The application files are owned by `www-data:appgroup` and have `755` permissions for compatibility with Apache.
- **Database Persistence:** To persist MySQL data, uncomment the `volumes` section in the compose file and create a `mysql-data` volume.
- **Networking:** Both services are connected via the `appnet` bridge network.

### Exposed Ports
- **PHP Application (Apache):** `80` (accessible at `http://localhost:80`)
- **MySQL Database:** `3306` (accessible at `localhost:3306` for development)

---
_Keep your database credentials secure and change default passwords before deploying to production._
