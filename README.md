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
![Woxima ERD](https://github.com/zillnotre/woximagallery_/assets/140696260/1e72f850-4914-402b-8ef2-45074cbf95ca)

- Relasi

![Screenshot (129)](https://github.com/zillnotre/woximagallery_/assets/140696260/a625861e-6332-41c5-8d52-ca4f55c60c6c)


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
