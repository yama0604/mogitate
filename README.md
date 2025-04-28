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

- MySQL で DB 作成
- ログイン：ID
- mysql -u root -p
- ログイン：PW：
- スペース
- DB 作成
- CREATE DATABASE laravel_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

- マイグレーション実行
- php artisan migrate

- シーダー作成
- php artisan db:seed

## 使用技術(実行環境)

- PHP 8.3.20
- Laravel 8.83.29
- MySQL 9.2.0

## ER 図

- ![Image](https://github.com/user-attachments/assets/9dbd05a9-2cd0-4c02-849a-b322ee34325d)

## URL

- 商品登録ページ: http://localhost/products/register
- 商品一覧ページ: http://localhost/products
