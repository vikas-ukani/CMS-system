
# CMS - System (Content management system).
- An Page Content Management System | Laravel with Vue.js


### All Pages and Listing...
<img src="https://i.imgur.com/W1K6u8f.png" />

### Create Page...
<img src="https://i.imgur.com/5PbJ67A.png" />

### Edit page...
<img src="https://i.imgur.com/s0DKtos.png" />

### Delete Confirmation...
<img src="https://i.imgur.com/7oqVwfd.png" />

### Show Page content...
<img src="https://i.imgur.com/7pKMrPw.png" />


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:


## Installation process

### Clone the repo.
```
git clone https://github.com/vikas-ukani/CMS-system.git
cd CMS-system/
```

### Create .env file
```
cp .env.example .env
```

### Install pacakges.
- Install php laravel pacakges
```
composer install 
```
- Install node module pacakges for vue js
```
npm install 
```

- Configure local database connection.
###  Generate key if it's required, Run the command 
```
php artisan key:generate
```

### Database setup
- Find the exported database backup on database directory and import on local system.
- Path `database/cms-system.sql`

- OR run the migrations, for fresh database setup.
`php artisan migrate`

### Seed the dummy data.
- After done setup with, Run the below command to insert dummy data to database
```
php artisan db:seed
```


### Run the PHP server
```
php artisan serve
```

### Run Vue server
```
npm run dev
```

### Run the test for routes.
```
php artisan test
```

### Visit the site.
```
http://localhost:8000/
```


