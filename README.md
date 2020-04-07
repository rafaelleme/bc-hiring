# BoaCompra - Hiring

My first application developed in Symfony + DDD by Rafael Leme (rafaelleme_2@hotmail.com)

## Requirements

Docker-compose


## Usage

```python
To run container:
docker-compose up
```

## Composer
```python
composer install;
```

## Configure .env
```python
copy .env.example to .env with configurations of image in docker-compose.yaml
```

## Db commands
```python
To fill the db with data run command in php container:

## php bin/console doctrine:schema:create ## to create schema

## php bin/console doctrine:schema:update --force --dump-sql ## to update schema

## source aliases ## command to create aliases on container (only temporary session)

and

## run-dev ## Note: this command will drop schema.

Or run this command:
## comma-create ## to only populate db
```
```python
Maintainer: Rafael Leme (rafaelleme_2@hotmail.com)
```
