# Woxima


## Tentang Website

Website Gallery yang dibuat untuk project UKK

## Fitur

Untuk Fitur masih minim:
- register
- log in
- log out
- add poto
- add album
- preview album
- add comment
- like
- dll

## Tampilan Website
-Register
![Screenshot (125)](https://github.com/zillnotre/woximagallery_/assets/140696260/c26b3f3e-4171-4e7e-af84-3bfe2c43db44)

-Login
![Screenshot (123)](https://github.com/zillnotre/woximagallery_/assets/140696260/9fbb7a36-1532-4f0d-be06-398cdeb9e036)

-Dashboard
![Screenshot (124)](https://github.com/zillnotre/woximagallery_/assets/140696260/61bdcc70-1948-424e-a6dc-9018c2933035)


## ERD, Relasi dan UML Use Case

- ERD
- 
![woxima](https://github.com/zillnotre/woximagallery_/assets/140696260/210b96da-7f63-42e2-b554-4519d759d072)

- Relasi

![Screenshot (127)](https://github.com/zillnotre/woximagallery_/assets/140696260/be520529-23a6-47be-a32b-b6496a974a20)


- UML

![UML GALLERY drawio](https://github.com/Kuro192/UKK_Gallery/assets/105845443/871c2ea4-c579-42e9-944d-47cf0e83c5ff)


## Prasyaratan

- PHP 8.2.8 & Web Server (Apache, Lighttpd, atau Nginx)
- Database (MariaDB dengan v11.0.3 atau PostgreSQL)
- Web Browser (Firefox, Safari, Opera, dll)

## Instalasi
1. Clone Repository
```
[https://github.com/zillnotre/woximagallery_.git]
```

2. Install Composer
```
composer install
```
atau
```
composer update
```

3. Copy .Env
```
copy .env.example .env
```

4. Setting database di .env
```
DB_PORT=3306
DB_DATABASE=woxima
DB_USERNAME=root
DB_PASSWORD=
```

5. Generate key
```
php artisan key:generate
```

6. Jalankan migrate dan seeder
```
php artisan migrate --seed
```

7. Buat Storage Link
```
php artisan storage:link
```

8. jangan lupa menginstall NPM
```
npm install
```
lalu jalankan
```
npm run dev
```

8. Jalankan Serve
```
php artisan serve
```
