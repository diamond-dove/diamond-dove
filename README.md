[![Build Status](https://travis-ci.org/diamond-dove/diamond-dove.svg?branch=master)](https://travis-ci.org/github/diamond-dove/diamond-dove)
[![Software License](https://img.shields.io/badge/license-APACHE-brightgreen.svg?style=flat-square)](LICENSE.txt)

# Diamond-dove

About diamond dove pretame
is an Open Source Initiative for Loan system.

Following are the features provided:

- Customer CRUD.
- Loans
- Payment
- More 

# Installation

## Docker
1. Run `docker-compose build`
2. Run `docker-compose up`

## Basic docker commands
If you want to run the docker container in background.

- Start `docker-compose up -d`.
- Stop `docker-compose down`.
- Get into the container `docker exec -it prestame_app_1 /bin/bash`.

## Migrations
1. Run `./cb php artisan migration`

## Local
### requirements
- php 7.3
- composer
- mysql
- redis 5.0
### Setup
1. copy .env.example file to .env `cp .env.example .env`
2. Change .env setting
3. Run `php artisan genarate:key`
4. Run `php artisan run migration`
5. run `php artisan serve`
