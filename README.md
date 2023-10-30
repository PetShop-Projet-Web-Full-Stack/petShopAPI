# Api v1 for  petShop project

## Author
- [@Narigane3](https://github.com/Narigane3)

## Description
This project is a back api for petShop project

# Documentation

## Table of Contents
- [Features](#features)
- [Env require](#env-require)
- [Getting Started](#getting-started)
    - [Create & set up .env file (obligatory for work)](#create--set-up-env-file-obligatory-for-work)
    - [Set up the db connection (don't use this config for production)](#set-up-the-db-connection-dont-use-this-config-for-production)
    - [Configure Sanctum (for auth)](#configure-sanctum-for-auth)
    - [Set up the mail server (for send email confirmation) actual disable](#set-up-the-mail-server-for-send-email-confirmation-actual-disable)
    - [Configure the url for redirect to the front app](#configure-the-url-for-redirect-to-the-front-app)
    - [If production deploy](#if-production-deploy)
- [Exemple of request with axios for auth whit Sanctum 3 & fortify](#exemple-of-request-with-axios-for-auth-whit-sanctum-3--fortify)
    - [Use axios with default config for request main api](#use-axios-with-default-config-for-request-main-api)
    - [Exemple function for register user](#exemple-function-for-register-user)
    - [Exemple function for login user](#exemple-function-for-login-user)
    - [Exemple function for logout user](#exemple-function-for-logout-user)
- [Use Postman for test api](#use-postman-for-test-api)
    - [Configure Postman for work with Sanctum](#configure-postman-for-work-with-sanctum)

## Features
- Laravel 10
- Sanctum 3
- Fortify

## Env require
- Docker (for dev fast start)
- PHP 8.2
- MySQL 8.0
- SMTP server (for send email confirmation)


## Getting Started
```shell
composer install

# Create a new Laravel container
php artisan sail:install

# Start the container
./vendor/bin/sail up

# Execute key generation (if necessary)
./vendor/bin/sail artisan key:generate

# Execute migration
./vendor/bin/sail artisan migrate

```
## Create & set up .env file (obligatory for work)
```shell
# Create .env file
cp .env.example .env
```
### Set up the db connection (don't use this config for production)
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=petshop
DB_USERNAME=petshop_user
DB_PASSWORD=petshop_password
```
### Configure Sanctum (for auth)
```dotenv
# set url of front app for auth with sanctum (full url with port)
# If you use subdomain for front app use .domain.com
SANCTUM_STATEFUL_DOMAINS=localhost,localhost:5173,localhost:3000,127.0.0.1,127.0.0.1:8000,::1
# if you use subdomain for front app use .domain.com
SESSION_DOMAIN=localhost
```

### Set up the mail server (for send email confirmation) actual disable
```dotenv
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=your_email_
MAIL_FROM_NAME="${APP_NAME}"
```
### Configure the url for redirect to the front app
###### If request does not expect a json response
```dotenv
FRONT_URL="http://localhost:3000"
```

### If production deploy
```dotenv
# Turn off debug mode
APP_DEBUG=false
```

## Exemple of request with axios for auth whit Sanctum 3 & fortify

### Use axios with default config for request main api
install axios
```shell
npm install axios
```

Instance of axios with default config for request main api
```javascript
import axios from 'axios';

// instace of axios with default config for request main api
const RequestApi = axios.create({
  baseURL: 'http://localhost/',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'Access-Control-Allow-Origin': 'localhost:5173', // value of dotenv variable SANCTUM_STATEFUL_DOMAINS
  },
  withCredentials: true, // for work with cross domain exemple : localhost
});
```

#### Exemple function for register user
```javascript
/**
 * Register User
 * @param object {name, email, password, password_confirmation} user info
 * @return {Promise<void>} user info
 */
async function register({name, email, password, password_confirmation}) {
  try {
    // Set CSRF cookie
    await RequestApi.get('sanctum/csrf-cookie');

    // register user
    await RequestApi.post('api/register', {
      name: name,
      email: email,
      password: password,
      password_confirmation: password_confirmation
    })

    const response = await RequestApi.post('api/user')

    return response.data

  } catch (error) {
    console.error(error);
  }
}
```

#### Exemple function for login user
```javascript
/**
 * login user with email and password
 * @param email
 * @param password
 * @return {Promise<any>} user info
 */
async function login(email, password) {
  try {
    // Set CSRF cookie
    await RequestApi.get('sanctum/csrf-cookie');

    // login user with email and password
    await RequestApi.post('api/login', {
      email: email,
      password: password
    })

    // get user info
    const response = await RequestApi.get('api/user');
    return response.data
  } catch (error) {
    console.error(error);
  }
}
```

#### Exemple function for logout user
```javascript
/**
 * logout user
 */
async function logout() {
  try {
    // logout user
    await RequestApi.post('api/logout');
  } catch (error) {
    console.error(error);
  }
}
```

For more information on how to use Sanctum, see the [official documentation](https://laravel.com/docs/10.x/sanctum).

## Use Postman for test api
[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/1a0b3b2b9b8b2b2b2b2b)

### Configure Postman for work with Sanctum

Read this [article](https://blog.codecourse.com/laravel-sanctum-airlock-with-postman) for more information

#### Configure Headers for work with Sanctum
1. Set Accept header to application/json
2. Set Referer header to http://localhost:3000
   - use the value of the SANCTUM_STATEFUL_DOMAINS dotenv variable (e.g. localhost:5173),<br> which is used to grant authorisation to use the authentication cookie 

