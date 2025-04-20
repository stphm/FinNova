#!/bin/sh
set -e

echo "🐳 Lancement de FinNova..."

# Attente de PostgreSQL
until nc -z db 5432; do
  echo "⏳ En attente de PostgreSQL..."
  sleep 1
done

echo "✅ PostgreSQL est prêt, installation des dépendances..."
composer install --no-interaction

echo "🚀 Lancement du serveur Symfony..."
php -S 0.0.0.0:8000 -t public
