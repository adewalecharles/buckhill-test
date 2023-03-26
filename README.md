## Requirements

The following tools are required in order to start the installation.
- PHP 8.2+
- [Docker](https://www.docker.com/)
- [Composer](https://getcomposer.org/download/)

> Please make sure you have docker running, you can verify using `docker ps`

> Please make sure `PORT 3306` is available else set `FORWARD_DB_PORT` in your $

## Installation
1. Clone this repository with `git clone git@github.com:adewalecharles/buckhill-test.git
2. In your terminal `cd ./buckhill-test`
3. Run `composer setup` to setup the application and move into docker container
4. Run `composer build` to build the application

## Note
Demo admin login credentials is
Email: admin@buckhill.co.uk
password: admin
