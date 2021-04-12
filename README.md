# cs-addressbook
ChurchSuite Addressbook API frontend - allows you to search through contacts via the API, displayed in a paginated list with the ability to view some more details by clicking on each contact.

## Requirements
Uses Laravel 8, installed via composer, which doesn't have it's own requirements so assume Laravel 7 requirements [found here](https://laravel.com/docs/7.x/installation) 

Developed using the following package manager versions:

* Composer (PHP) - v2.0.9
* NPM (JavaScript) - v6.14.9

## Installing

1. Download this code
2. Copy the .env.example file to .env
3. Enter your ChurchSuite API details where noted (at the end of the .env file)
4. Enter an encryption key (APP_KEY) - alternatively, once setup, get Laravel to generate one first time around
5. Run `composer install` to install all PHP dependencies - may take a while
6. Run `npm install` to install all JavaScript dependencies - may take a while
7. If all has installed okay then you should be ready to go - see below to see how to run it locally.

## Developing with

Uses Laravel Mix via NPM watch to compile SASS and JS files (e.g. for Vue.js and Tailwind)

`npm run watch`

## Running

Simplest way is using Artisan's built in server

`php artisan serve`