# Hogwarts University Course Registration System

## Description
This is a web-based University Course Registration System for "Hogwarts University". It allows students to sign up, log in, view courses, and register for courses. Administrators can log in, add, edit, and delete courses, departments, instructors, and students, as well as manage course registrations.

## Prerequisites
- XAMPP or similar local web server stack (Apache, MySQL, PHP 8.x).

## CI/CD Pipeline
This project includes a GitHub Actions workflow (`.github/workflows/php.yml`) that automatically lints all PHP files (`php -l`) on pushes and pull requests to ensure there are no syntax errors introduced.

## Installation
1. Start Apache and MySQL services in your XAMPP Control Panel.
2. Open phpMyAdmin (`http://localhost/phpmyadmin`).
3. Create a new database named `db`.
4. Import the `UNIVERSITY_COURSE_REGISTRATION_Group_5.sql` file into the `db` database.
5. Clone or copy this repository into the `xampp/htdocs/` directory (e.g., `xampp/htdocs/hogwarts`).
6. Access the application in your browser at `http://localhost/hogwarts/home.php`.

## Default Credentials

### Admin Login
- **Username:** `arigato`
- **Password:** `1234`

### Student Login
- **Email:** `zidneyartist@gmail.com`
- **Password:** `1234`
