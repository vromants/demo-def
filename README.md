# Simple demo test assigment project 

Simple console app that uses Silly micro framework that allows to generate text file, and after allows finding all string values in double quotes 

## Requirements 

 Docker with docker compose installed

## How to run 

Go inside docker container bash

`docker-compose run app bash`

Install dependencies

`composer install`

Inside container, you can run: 

`php src/app.php file path/to/the/file` - this command will generate text file with lore ipsum text and 5 words in double quotes

`php src/app.php find path/to/the/file` - this command will find all values in file in double quotes and prints count and them to the console


## Commands parameters 

### `file` :  
`path` (required) - path to file that will be created should be passed without file extension. Absolute or relative 

`chars` (optional) - number of chars in generated file (400 by default)

`nbQuoted` (optional) - number of words quoted in double quotes (5 by default)

### `find` : 

`filePath` (required) - path to file with text to find needed values without file extension. Absolute or relative
