#!/bin/bash

if ! [ $(command -v "docker") ]; then
    echo "Install Docker first!"
    exit
else
    echo "Docker found"
    docker -v
fi

echo ".env.example -> .env"
cp .env.example .env

if [ -f .env ]; then
    echo ".env file found, loading env"
    export $(echo $(cat .env | sed 's/#.*//g' | xargs) | envsubst)
fi

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd)":/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs

echo "Starting container"
./vendor/bin/sail up -d
sleep 10

echo "Generating key"
./vendor/bin/sail artisan key:generate

echo "Applying migrations"
./vendor/bin/sail artisan migrate

echo "Seeding test data"
./vendor/bin/sail artisan db:seed

echo "Installing NPM dependencies"
./vendor/bin/sail npm install

echo "Building Vue App"
./vendor/bin/sail npm run dev
