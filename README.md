# JWT Authentication in Laravel 11

This project demonstrates how to implement JWT (JSON Web Token) authentication in a Laravel 11 application using the `tymon/jwt-auth` package.

## Prerequisites

- PHP >= 8.2
- SQLite or any other supported database
- Laravel 11

**Clone the Repository**
   ```bash
   git clone https://github.com/shakhawatmollah/laravel-jwt-app.git
   cd laravel-jwt-app
   ```
### Running the Application

**Serve the Application**
   ```bash
   php artisan serve
   ```

Postman Collection: [laravel-jwt-app.postman_collection.json](laravel-jwt-app.postman_collection.json)

------------------------------------
## Installation

1. **Create a New Laravel Project**
   ```bash
   laravel new laravel-jwt-app
   cd laravel-jwt-app
   ```

2. **Install Required Packages and Set Up API**
    - Install base dependencies and set up API functionality:
      ```bash
      php artisan install:api
      ```

    - Add JWT support with `tymon/jwt-auth`:
      ```bash
      composer require tymon/jwt-auth
      ```

3. **Publish JWT Configuration**
   ```bash
   php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
   ```

   This command will publish the `jwt.php` configuration file to your `config` directory.

4. **Generate JWT Secret Key**
   ```bash
   php artisan jwt:secret
   ```

   This command will generate a secret key for signing tokens, adding it to your `.env` file as `JWT_SECRET`.

5. **Create the JWT Authentication Controller**
   ```bash
   php artisan make:controller JWTAuthController
   ```

## JWT Authentication Setup

To configure JWT authentication, update the `JWTAuthController` with the following methods:

- **Register**: Allows new users to sign up.
- **Login**: Generates a JWT for authenticated users.
- **Logout**: Invalidates the JWT, logging out the user.
- **Refresh**: Refreshes the token to extend the session.
- **Get User**: Gets the currently authenticated user.

Ensure routes for these methods are secured using middleware in `routes/api.php`.

### Example Routes

Define API routes for JWT actions in `routes/api.php`:

```php
use App\Http\Controllers\JWTAuthController;

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('register', [JWTAuthController::class, 'register']);
    Route::post('login', [JWTAuthController::class, 'login']);
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('me', [JWTAuthController::class, 'getUser']);
    Route::post('refresh', [JWTAuthController::class, 'refresh']);
    Route::post('logout', [JWTAuthController::class, 'logout']);
});
```

### Middleware Configuration

Ensure `auth:api` middleware is applied to routes requiring authentication. This middleware verifies the token for secured access.

## API Endpoints

- **Register a User**
    - `POST /api/auth/register`
    - Request Body: `{ "name": "username", "email": "user@example.com", "password": "yourpassword" }`

- **Login**
    - `POST /api/auth/login`
    - Request Body: `{ "email": "user@example.com", "password": "yourpassword" }`

- **Logout**
    - `POST /api/logout` – Requires Bearer Token in the Authorization header.

- **Refresh Token**
    - `POST /api/refresh` – Requires Bearer Token in the Authorization header.

- **Get User**
    - `GET /api/me` – Requires Bearer Token in the Authorization header.

## Testing the API

To test the API, use **Postman** or any other API client. Make sure to include the JWT token in the Authorization header as a Bearer token for routes that require authentication.

Postman Collection: [laravel-jwt-app.postman_collection.json](laravel-jwt-app.postman_collection.json)

### Example Header
```plaintext
Authorization: Bearer your_jwt_token
```

## Additional Configuration

You can adjust JWT expiration time, blacklist behavior, and other settings in `config/jwt.php`.

## Running the Application

1. **Serve the Application**
   ```bash
   php artisan serve
   ```

2. **Test Endpoints**

   Use the API endpoints to register, log in, and access secured routes with JWT.

## References
https://jwt-auth.readthedocs.io/en/develop/quick-start/

## Author

Shakhawat Mollah
