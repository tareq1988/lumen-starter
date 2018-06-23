# Lumen Starter

A starter package to use it with [Vue Lumen Starter](https://github.com/tareq1988/vue-lumen-starter).

## Packages Added

* [laravel-cors](https://github.com/barryvdh/laravel-cors)
* [league/fractal](https://github.com/league/fractal)

## Installation

1. Clone the repository: `git clone https://github.com/tareq1988/lumen-starter.git`
1. Copy `.env.example` as `.env` file and set the Database credentials
1. Set approprite `APP_URL`. In case using with [Vue Lumen Starter](https://github.com/tareq1988/vue-lumen-starter), set it to the Vue App URL.
1. Install Dependencies: `composer install`
1. Run migration: `php artisan migrate`
1. Run Seeder: `php artisan db:seed`

Done!

## REST API

### Authentication

<details>
<summary>View contents</summary>
Send Authorization bearer token to send authenticated request

```http
Authorization: bearer <API_TOKEN>
```
</details>

### Register an User

<details>
<summary>View contents</summary>

`[POST /register]`

Params:

```
 - `first_name` (string) - Users first name
 - `last_name` (string) - The last name
 - `email` (string) - The user email
 - `password` (string) - The password
 - `password_confirmation` (string) - The confirmation password
```

Response Code:
 - ✅ 201: On registration success
 - ❌ 422: On validation failure

</details>

### Login

<details>
<summary>View contents</summary>

`[POST /login]`

Params:

```
 - `email` (string) - The user email
 - `password` (string) - The password
```

Response Code:
 - ✅ 200: On login success
 - ❌ 401: On failure

</details>

### Fetch current user profile

<details>
<summary>View contents</summary>

`[GET /me]`

Response Code:
 - ✅ 200: On success
 - ❌ 401: On failure

</details>

### Update the current user profile

<details>
<summary>View contents</summary>

`[POST /me]`

Params:

```
 - `first_name` (string) - Users first name
 - `last_name` (string) - The last name
```

Response Code:
 - ✅ 200: On login success
 - ❌ 422: On validation failure

</details>

### Change the password

<details>
<summary>View contents</summary>

`[POST /me/password]`

Params:

```
 - `current` (string) - The current password
 - `password` (string) - New password
 - `password_confirmation` (string) - The new confirmation password
```

Response Code:
 - ✅ 200: On success
 - ❌ 422: On validation failure

</details>

### Request Password Reset

<details>
<summary>View contents</summary>

`[POST /password/request]`

Params:

```
 - `email` (string) - The email
```

Response Code:
 - ✅ 200: On success
 - ❌ 422: On validation failure

</details>

### Reset Password

<details>
<summary>View contents</summary>

`[POST /password/reset]`

Params:

```
 - `email` (string) - The email
 - `token` (string) - The forgot password token
 - `password` (string) - New password
 - `password_confirmation` (string) - The new confirmation password
```

Response Code:
 - ✅ 200: On success
 - ❌ 422: On validation failure

</details>

## Credits

[Tareq Hasan](https://tareq.co)
