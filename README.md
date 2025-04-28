## アプリケーション名

- もぎたて

## 環境構築

- Docker ビルド
- docker-compose up -d --build

- Docker イメージのビルドとコンテナの起動
- docker-compose exec php bash

- composer インストール有無確認
- composer -v
- composer install
- cp .env.example .env
- php artisan key:generate

- .envの設定を確認
- DB_CONNECTION=mysql
- DB_HOST=mysql
- DB_PORT=3306
- DB_DATABASE=laravel_db
- DB_USERNAME=laravel_user
- DB_PASSWORD=laravel_pass

- ※必要に応じて実行（マイグレーション実行）
- php artisan migrate

- ※必要に応じて実行（シーダー作成）
- php artisan db:seed

- シンボリックリンク実行
- php artisan storage:link

## 使用技術(実行環境)

- PHP 8.3.20
- Laravel 8.83.29
- MySQL 9.2.0

## ER 図
![ER図_もぎたて](https://github.com/user-attachments/assets/c145a4d4-f693-487e-b244-b9c33f39f452)


## URL

- 商品登録ページ: http://localhost/products/register
- 商品一覧ページ: http://localhost/products
