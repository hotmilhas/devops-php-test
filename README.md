# Aplicação PHP
Simples aplicação feita utilizando PHP7 para listar e salvar dados no banco de dados.

 ## Pré-requisitos
 - Nginx
 - PHP 7.0+
 - PHPFPM
 - MySQL

## Instruções

 - Execute o comando `cp .env.example .env`
 - Altere as informações do arquivo `.env`
 - Rodar `composer install`

## Banco de dados

Crie um banco de dados no AWS RDS e execute o seguinte script:

    USE database_name;
    CREATE TABLE `cars` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `marca` VARCHAR(45) NULL,
        `modelo` VARCHAR(45) NULL,
        `fabricacao` VARCHAR(45) NULL,
        PRIMARY KEY (`id`)
    );
## Testes
 
 - Rodar o comando `php vendor/bin/phpunit tests`
