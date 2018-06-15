# Lumen Starter

## Packages Added

* [lumen-generators](https://github.com/webNeat/lumen-generators)
* [laravel-cors](https://github.com/barryvdh/laravel-cors)
* [league/fractal](https://github.com/league/fractal)


### Authentication

Send Authorization bearer token to send authenticated request

```http
Authorization: bearer <API_TOKEN>
```

### Register an User

[POST /register]

Params:
 - `first_name` (string) - Users first name
 - `last_name` (string) - The last name
 - `email` (string) - The user email
 - `password` (string) - The password
 - `password_confirmation` (string) - The confirmation password

Response Code:
 - ✅ 201: On registration success
 - ❌ 422: On validation failure

### Login

[POST /login]

Params:
 - `email` (string) - The user email
 - `password` (string) - The password

Response Code:
 - ✅ 200: On login success
 - ❌ 401: On failure
