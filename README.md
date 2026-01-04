#アプリケーション名 
Check-test_contact-form
#環境構築
git clone git@github.com:mevius-lavita/Check-test_contact-form.git
docker-compose up -d --build
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed

