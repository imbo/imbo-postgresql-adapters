# PostgreSQL database adapters for Imbo

[![CI](https://github.com/imbo/imbo-postgresql-adapters/workflows/CI/badge.svg)](https://github.com/imbo/imbo-postgresql-adapters/actions?query=workflow%3ACI)

## Installation

    composer require imbo/imbo-postgresql-adapters

## Usage

This package provides [PostgreSQL](https://www.postgresql.org/) adapters for Imbo using [PDO](https://www.php.net/pdo).

```php
$database = new Imbo\Database\PostgreSQL($dsn, $username, $password, $options);
```

## Running integration tests

If you want to run the integration tests you will need a running PostgreSQL service. The repo contains a simple configuration file for [Docker Compose](https://docs.docker.com/compose/) that you can use to quickly run a PostgreSQL instance along with [pgAdmin](https://www.pgadmin.org/).

If you wish to use this, run the following command to start up the service after you have cloned the repo:

```
docker compose up -d
```

After the service is running you can execute all tests by simply running PHPUnit:

```
composer run test # or ./vendor/bin/phpunit
```

## License

MIT, see [LICENSE](LICENSE).
