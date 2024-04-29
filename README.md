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

To get started with the project, follow these steps:

1. Clone the repository.
2. Install dependencies for the backend by running `composer install`.
3. Install dependencies for the frontend by running `npm install` in the root folder.
4. Set up your environment configuration files for both the backend and frontend.
5. Run migrations for the backend to get response as autherozied user.
6. Start using the implemented features and integrations.

### Backend Environment Configuration

Before running the backend, make sure to set up the following environment variable:

- `LOGTAIL_API_KEY`: Your Logtail API key for cloud logging. Obtain it from Logtail and set it in your environment configuration file (e.g., `.env`).

Example `.env` file:

```plaintext
LOGTAIL_API_KEY=your_logtail_api_key_here



### Frontend Environment Configuration

Before running the React project, make sure to set up the following environment variable:

- `VITE_API_BASE_URL`: The base URL of the API used by the React application. Create a `.env` file in the root folder of the project(React) and set this variable to your API base URL. You can use the `.env.example` file as a template.

Example `.env.example` file:

```plaintext
VITE_API_BASE_URL=https://api.example.com