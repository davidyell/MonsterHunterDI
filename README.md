# Monster Hunter

A quick basic project to try out a practical implementation of a Dependency Injection container.

For more information watch [Kai Sassnowski talk about Dependancy Injection Containers at Laracon on YouTube (26 mins)](https://www.youtube.com/watch?v=y7EbrV4ChJs&amp;ab_channel=LaraconEU)

## Requirements
* PHP 7.4
* SQLite 3

Further requirements can be found in the `composer.json`

## Running the project
* Checkout the code
* `composer install`
* `composer server`
* Visit `localhost:1234`

## What's in the box?
A basic database using some data from the [Monster Hunter game franchise](http://www.capcom-europe.com/). An index 
view and single monster view.

There is also a basic JSON api if you access the urls using a `Content-Type: application/json` header in your 
request. I'd recommend using [Postman](https://www.postman.com/downloads/).

### Coding standard
This project uses the PSR2 coding standard. There are shortcuts in Composer.

* `composer cs-check`
* `composer cs-fix`

## TODO
 - [ ] Add tests
 - [ ] Add a Logger from the container
 - [ ] Add more data to the database
 - [ ] Create a React front-end based on the JSON API

## Disclaimer
This project is not associated with Capcom or any Monster Hunter game. It was just example data as I have been 
playing Monster Hunter recently.
