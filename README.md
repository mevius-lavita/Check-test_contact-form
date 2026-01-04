#アプリケーション名 
Check-test_contact-form

#環境構築
git clone git@github.com:mevius-lavita/Check-test_contact-form.git
docker-compose up -d --build
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed

#開発環境
・お問い合わせ画面　http://localhost/
・ユーザー登録　http://localhost/register
・phpMyAdmin　http://localhost:8080/

#使用技術（実行環境）
 nginx:1.21.1
 mysql:8.0.26
 php:8.1
 laravel Framework:8.83.29

#ER図

#URL
http://localhost/ Contact form
http://localhost/confirm Confirm
http://localhost/thanks Thanks
http://localhost/register Register
http://localhost/login Login
http://localhost/admin Admin


