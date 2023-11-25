# Your Project Name

A brief description of your project.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [API Endpoints](#api-endpoints)

## Features

#### API Basics
- API Routes and Controllers
- API Eloquent Resources
- API Auth with Sanctum
- Override API Error Handling and Status Codes
- API Versioning

#### Debugging Errors
- Try-Catch and Laravel Exceptions

#### Database
- Eager Loading and N+1 Query Problem

#### Extra
- Events and Listeners

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/Htet-Lin-Aung/practical-test.git

   ```bash
   cd practical-test

   ```bash
   composer install

   ```bash
   cp .env.example .env

   ```bash
   php artisan key:generate
    
   ```bash
   php artisan migrate --seed
   
   ```bash
   php artisan serve


## API Endpoints

#### Authentication Endpoints

- POST /api/v1/register: Register a new user.
- POST /api/v1/login: Log in and get an access token.
- POST /api/v1/logout: Log out and revoke the access token.

#### Dynamic Field Endpoints

- GET /api/v1/dynamic-field/list: Get a list of dynamic fields.
- POST /api/v1/dynamic-field/create: Create a new dynamic field.

#### Dynamic Form Endpoints
- POST /api/v1/dynamic-form/create: Create a new dynamic form.