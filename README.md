# Blog API

A RESTful API built with Lumen framework for managing blog posts with JWT authentication.

## Features

- JWT Authentication
- RESTful API endpoints for posts management
- OpenAPI/Swagger documentation
- Standardized API responses using ApiResponseTrait
- Formatted validation error messages
- Repository pattern for data access

## Installation

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env` and configure your database
4. Run migrations: `php artisan migrate`
5. Generate JWT secret: `php artisan jwt:secret`

## API Documentation

### Accessing Swagger UI

The API documentation is available via Swagger UI at:

```
http://your-domain/api/documentation
```

### API Endpoints

#### Authentication
- `POST /auth/login` - Login user
- `POST /auth/logout` - Logout user (requires authentication)
- `POST /auth/refresh` - Refresh JWT token (requires authentication)
- `GET /auth/me` - Get authenticated user (requires authentication)

#### Posts
- `GET /posts` - Get all posts
- `POST /posts` - Create a new post (requires authentication)
- `GET /posts/{id}` - Get a specific post
- `PUT /posts/{id}` - Update a post (requires authentication)
- `DELETE /posts/{id}` - Delete a post (requires authentication)

### API Response Format

All API responses follow a standardized format:

#### Success Response
```json
{
    "message": "Success message",
    "statusCode": 200,
    "status": "OK",
    "data": {}
}
```

#### Error Response
```json
{
    "message": "Error message",
    "statusCode": 400,
    "status": "Bad Request",
    "errors": {}
}
```

#### Validation Error Response
```json
{
    "message": "The email field is required. (and 2 more errors)",
    "statusCode": 422,
    "status": "Unprocessable Entity",
    "errors": {
        "email": ["The email field is required."],
        "password": ["The password field is required."]
    }
}
```

## Configuration

### Dynamic API Server URL

The Swagger documentation uses the `L5_SWAGGER_CONST_HOST` constant which can be configured in your `.env` file:

```env
APP_URL=http://localhost:8000
L5_SWAGGER_CONST_HOST=http://localhost:8000
```

### Generating Documentation

To regenerate the Swagger documentation after making changes to annotations:

```bash
php artisan swagger-lume:generate
```

## ApiResponseTrait

The `ApiResponseTrait` provides standardized response methods:

- `success($data, $message, $statusCode)` - Return success response
- `error($message, $data, $statusCode)` - Return error response

Both methods automatically handle:
- JsonResource responses
- Paginated responses
- Standard array/object responses

## Lumen Framework

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax.

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
