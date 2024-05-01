# GlobalyhubTask

## Overview

This project implements various features and integrations for improved functionality,Pagination,Backend,Frontend Validation and logging capabilities.

## Changes

- Implemented authentication using Sanctum for secure user authentication.
- Built APIs for authentication and client interaction, including Feature Test for robust testing.
- Integrated League/CSV library for enhanced handling of CSV data.
- Installed Logtail for cloud logging, ensuring efficient monitoring and management of logs.
 -created view details page for client
 -pagination
 -Backend and frontend Validation

## Getting Started

TTo get started with the project, follow these steps:
    Clone the repository.
    Copy the .env.example file to .env using the command: cp .env.example .env
    Generate a new application key using the command: docker compose run --rm artisan key:generate
    Install the frontend dependencies by running: docker compose run --rm -service-ports npm I
    Start the frontend development server by running: docker compose run –rm -service-ports npm run dev (This will start the frontend on port 3000)
    Start the backend services using the command: docker compose up



### Backend Environment Configuration

Before running the backend, make sure to set up the following environment variable:

- `LOGTAIL_API_KEY`: Your Logtail API key for cloud logging. Obtain it from Logtail and set it in your environment configuration file (e.g., `.env`).

Example `.env` file:

```plaintext
LOGTAIL_API_KEY=your_logtail_api_key_here

