echo "======================================";
echo "============== Docker  ===============";
echo "======================================";
docker-compose up -d
echo "======================================";
echo "============== Composer  =============";
echo "======================================";
docker-compose exec webserver composer install
echo "======================================";
echo "============== Database  =============";
echo "======================================";
docker-compose exec webserver php artisan migrate
docker-compose exec webserver php artisan db:seed
echo "======================================";
echo "============== Tests  ================";
echo "======================================";
docker-compose exec webserver php artisan test
echo "======================================";
echo "===== Served to http://localhost =====";
echo "===== Also you can add to host file ==";
echo "===== 127.0.0.1 laravel.local ========";
echo "======================================";
sudo chmod 777 -R storage


