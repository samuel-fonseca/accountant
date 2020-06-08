# Accountant

Accountant is a web app built with Laravel and VueJS which aims to make accounting for self-employed people to track expenses and income.

## Install

Clone the repository and install dependencies

```console
user@machine % git clone git@github.com:samuel-fonseca/accountant.git
user@machine % cd accountant
user@machine % composer install
user@machine % php artisan migrate --seed
```

Once all dependencies are installed you can serve the application using Laravel's test server or use the server you currently use.

```console
user@machine % php artisan serve
```

## To-do

- [x] Authentication
- [ ] API routes
- [ ] Web routes
- [ ] Adding expenses & incomes
- [ ] Possibly connecting to banks to fetch data?

More detailed to-dos as I get into the project and its nitty-gritty needs.
