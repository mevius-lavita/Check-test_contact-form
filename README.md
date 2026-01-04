#アプリケーション名
Check-test_contact-form

#環境構築
git clone [git@github.com](mailto:git@github.com):mevius-lavita/Check-test_contact-form.git
docker-compose up -d --build
docker compose exec php bash
cd /var/www
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
chmod -R 777 storage bootstrap/cache（Windowsの場合必要に応じて）
#開発環境
・お問い合わせ画面　http://localhost/
・ユーザー登録　http://localhost/register
・phpMyAdmin　http://localhost:8080/

#使用技術（実行環境）
nginx:1.21.1
mysql:8.0.26
php:8.1
laravel Framework:8.83.29

#URL
http://localhost/ Contact form
http://localhost/confirm Confirm


