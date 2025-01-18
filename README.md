# Senior PHP Laravel Developer Task
The Ecommerce basic API.


## Installation

Clone the repo `git clone https://github.com/Moemen-Gaballah/ecommerce-api.git` and `cd` into it

`composer install`

Rename or copy `.env.example` file to `.env`

Set your database credentials in your `.env` file or create the same

`composer install`

`php artisan migrate:fresh --seed`

`php artisan serve`

`http://127.0.0.1:8000/`

Email/Password: Exist in postman collection

Email: `moemengaballa@gmail.com`
Password: `password`


For run test 
`php artisan test
`

### Done

- [x] Login using sanctum
- [x] Seeder for Users
- [x] Seeder for Products
- [x] Api login
- [x] Api fetch products.
- [x] Api store order
- [x] Api show order
- [x] Cache and test.
- [x] Postman collection with examples (in root project).
- [x] Added docker file && docker compose file (`docker-compose up -d`) and update env file

### TODO
- [] Seperate logic from controller to service or action or repo.
- [] add (softDeleted && created_by && slug && ...etc) for product.
- [] add (price && discount or coupon if had) for order_product.
- [] Use Elastic search or scout for search products
- [] update cache after store any order
- [] set database for test
- [] Update Cache to redis
- [] refactor many topic in my code write in code TODO (like filter)
- etc...
