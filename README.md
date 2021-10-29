TransferGO
=========================

## How to run application

You can easly run docker application by running:
```bash
docker-compose up -d
```

If you are using MacOS you can use Mutagen:

```bash
mutagen project start
```

## How to remove application

On Linux use command: 

```bash
docker-compose down -v
```

On MacOs:

```bash
mutagen project terminate
```

### Database credentials

Credentials are saved in `.env` file. Postgres port `5432` is bind to your local machine, so host for database is `localhost`, if you want to connect eg. from PhpStorm. 

## Running tests

First you need to load test data for functional testing:

```bash
docker-compose exec php bin/database/load-test-data --env=test
```

Then you can run tests:

```bash
docker-compose exec php bin/phpunit --testdox
```

## Description

This is simple messaging microservice application. You can send messages by multiple technologies/services. If one options is not available, the other option is chosen.

## Technology stack

* PHP8
* Symfony 5
* Postgres 13
* Nginx

## Tradeoffs

* Postgres database chosen for quick development, I would use MongoDB instead if I had time. I think it suits the job better. I created repositories as interfaces, doctrine repositories are implementing the methods, so it could be easily switched to other DB.
* I didn't choose CQRS pattern to split read and writes in the system. This is something that I would concern if I would write "real world" application, but it mostly depends on the business needs.
* I omitted authentication and authorization processes, for rapid development purposes.
* User entity could be changed as the input data for the `send message` request, but for this project I chose that this data would be part of the microservice.
* I did not have enough time to create real message sender. So I created dummy implementation of it `LoggerSender`. It implements the interface of the sender.
* I created a draft of the Twilio sender class: `\App\Application\Service\TwilioMessageSender`
