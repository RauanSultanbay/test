CP .env.example .env
composer install
docker-compose up -d
echo "Run migrations"
docker-compose exec app php artisan migrate
echo "Run testing"
docker-compose exec app php artisan test
