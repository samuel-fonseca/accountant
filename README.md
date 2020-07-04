# Accountant

🧮 Accountant is a web app built with Laravel and VueJS which aims to make accounting for self-employed people easy to track expenses and income.

## Install

Clone the repository and install dependencies

```console
user@machine % git clone git@github.com:samuel-fonseca/accountant.git accountant && cd accountant
user@machine % composer install
user@machine % php artisan migrate
user@machine % php artisan passport:install --uuids
```

Once Passport is installed copy the `Client ID` and `Client Secret`. Add those to your `.env` file.

```console
Password grant client created successfully.
Client ID: 90f6920c-d516-4fcc-aa2d-f6a78579826e
Client secret: JozpRvsIKbRRozwrnQ5DiLnXwmXT8RS0SQlX9BAc
```

```.env
PASSPORT_LOGIN_ENDPOINT="http://accountant.test/oauth/token"
PASSPORT_CLIENT_ID="90f6920c-d516-4fcc-aa2d-f6a78579826e"
PASSPORT_CLIENT_SECRET="JozpRvsIKbRRozwrnQ5DiLnXwmXT8RS0SQlX9BAc"
```

Once all dependencies are installed you can serve the application using Laravel's test server or use the server you currently use.

```console
user@machine % php artisan serve
```

You can alternatively use your own server or [Valet](https://laravel.com/docs/7.x/valet)/[Homestead](https://laravel.com/docs/7.x/homestead). Deploy Laravel app as you [normally would](https://laravel.com/docs/7.x/deployment).

## Load dummy data

In an attempt to create some basic client/invoice data I am adding some seeders which automatically generate some random values for clients and invoice data.

### Before doing anything

**Register an account** - The first UUID from the users table to attach to clients & invoices - otherwise I generate a random UUID for user account.

### Once the account has been created

Seed the database:

```console
user@machine % php artisan db:seed
```

## To-do

- [x] Authentication
- [x] API OAuth Authentication
- [ ] API routes
- [x] Web routes - Laravel
- [ ] Web routes - Vue-Router
- [ ] Adding expenses & incomes
- [x] Invoicing ability
- [ ] Payments
- [ ] Improve frontend theme
- [ ] PWA Support
- [ ] Dark mode?
- [ ] Possibly connecting to banks to fetch data?

More detailed to-dos as I get into the project and its nitty-gritty needs.
