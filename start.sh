#!/bin/bash

echo " doker..."
docker-compose up --build -d

echo "composer..."
docker-compose exec app composer install

echo "✅ Projeto rodando em http://localhost:3002"