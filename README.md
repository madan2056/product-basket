# Basket
Basket Type Product Package for Neptrox Shopping App Writen in Laravel 5.1

## Packagist
Packagist name : neptrox/product-basket

## Installation

```
composer require neptrox/product-basket:dev-master
```

OR

Update your composer.json
```
"require": {
    "neptrox/product-basket": "dev-master"
}
```

Run the Composer update comand
```
composer update
```

## Register Service Provider

Register the provider in your config/app.php file :

```'
providers' => [
    Neptrox\ProductBasket\ProductBasketServiceProvider::class,
]
```

## Creating Seed

You will be able to create the seed file. Just call his command:
`php artisan neptrox-product-basket:migration`. This will call for create your seed file on *database/seeds/*, and runs the seed.


Publish configuration and resources to customize (optional):

```
php artisan vendor:publish --provider="Neptrox\ProductBasket\ProductBasketServiceProvider"
```

Customize your views in
```
resources/views/vendor/neptrox-product-basket
```

Customize your lang data in
```
resources/lang/vendor/neptrox-product-basket
```

### Some information
- This package is specific developed for Neptrox Shopping App
