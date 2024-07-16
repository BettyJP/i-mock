mkdir docker/nginx/logs

### コンテナ立ち上げ
docker compose up -d

### Laravel インストール
docker compose exec i-mock-app bash

cd /src
mkdir tmp
cd tmp
composer create-project "laravel/laravel=10.*" . --prefer-dist
cd /src
// vendorのマウントを外す（docker-compose.yml）
rm vendor -rf
mv tmp/* ./
mv tmp/.* ./
rm tmp -rf
// vendorをマウント

### 依存関連インストール
composer install
npm install

chmod -R guo+w storage

php artisan storage:link

### Lighthouseインストール
composer require nuwave/lighthouse
composer require mll-lab/laravel-graphql-playground

### 公開
php artisan vendor:publish --provider="Nuwave\Lighthouse\LighthouseServiceProvider" --tag=schema
php artisan vendor:publish --tag=lighthouse-config

### (memo) リゾルバ追加
php artisan lighthouse:query GetClients
php artisan lighthouse:mutation CreateEmployer
