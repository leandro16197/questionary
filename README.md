# Quiz Game

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

### recovery lives 
    To manually recover lives for all users, you can execute the following command:
    
    php artisan lives:recover
    
    The system includes an automated process that recovers lives for users every minute, up to a maximum of 5 lives.
    Recovers one life per minute for users with fewer than 5 lives. The database will automatically update the last recovery timestamp (last_updated).

# Quiz Game
 
Esta aplicación es un juego de trivia desarrollado con **Laravel 11.37.0** y **MySQL**, utilizando **Docker** para la contenedorización. Está inspirado en el popular juego "Preguntados," donde los jugadores responden preguntas de opción múltiple en diferentes categorías para poner a prueba sus conocimientos.

---

## Características

- **Laravel 11.37.0**:  
  La última versión de Laravel, un poderoso framework PHP, se utiliza para construir el backend y gestionar la lógica del juego.
- **MySQL**: A relational database system to store game data, user profiles, questions, and answers.  
  Un sistema de base de datos relacional para almacenar datos del juego, perfiles de usuarios, preguntas y respuestas.
- **Docker**: Docker se utiliza para contenedorización, garantizando un entorno de desarrollo aislado y consistente en todas las máquinas.
- **Question System**: El juego permite a los usuarios responder preguntas de varias categorías, con opciones de respuesta múltiple.
- **User Authentication**:Los jugadores pueden registrarse, iniciar sesión y seguir su progreso y puntaje.

---

## Requirements / Requisitos

Antes de ejecutar la aplicación localmente, asegúrate de tener instalados los siguientes requisitos:

- Docker  
- PHP 8.4.2 or higher / PHP 8.4.2 o superior  
- MySQL (inside Docker container / dentro del contenedor Docker)

---

## Instalación

### 1. Clonar el repositorio  
Primero, clona el repositorio en tu máquina local:

```bash
git clone https://github.com/leandro16197/questionary.git
cd questionary
```
### 2. Set up Docker containers
    docker compose up -d

### 3. Correr Migraciones
    docker-compose exec app php artisan migrate
### 4. Correr Migraciones
    docker-compose exec app php artisan db:seed
### 5. Access the application
    http://localhost:8000

### Recuperacion de vidas
    Para recuperar vidas manualmente para todos los usuarios, puedes ejecutar el siguiente comando:
   
    php artisan lives:recover

    El sistema incluye un proceso automatizado que recupera vidas para los usuarios cada minuto, hasta un máximo de 5 vidas.
    Recupera una vida por minuto para usuarios con menos de 5 vidas. La base de datos actualizará automáticamente el último registro de recuperación (last_updated).