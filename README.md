# Questionary Game

This application is a trivia game built with **Laravel 11.37.0** and **MySQL**, using **Docker** for containerization. It is inspired by the popular game "Preguntados," where players answer multiple-choice questions across different categories to test their knowledge.

## Features

- **Laravel 11.37.0**: The latest version of Laravel, a powerful PHP framework, is used for building the backend and handling the game logic.
- **MySQL**: A relational database system to store game data, user profiles, questions, and answers.
- **Docker**: Docker is used to containerize the application, ensuring an isolated and consistent development environment across all machines.
- **Question System**: The game allows users to answer questions from various categories, with multiple-choice options.
- **User Authentication**: Players can sign up, log in, and track their scores and progress.

## Requirements

Before running the application locally, ensure you have the following installed:

- Docker
- PHP 8.4.2 or higher
- MySQL (inside Docker container)

## Installation

### 1. Clone the repository
First, clone the repository to your local machine:

```bash
git clone https://github.com/leandro16197/questionary.git
cd questionary
```
### 2. Set up Docker containers
    docker compose up -d

### 3. Run database migrations
    docker-compose exec app php artisan migrate
### 4. Run database seeders 
    docker-compose exec app php artisan db:seed
### 5. Access the application
    http://localhost:8000
