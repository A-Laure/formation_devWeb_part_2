<?php

require '../app/controllers/ProductController.php';
require '../app/models/Product.php';
require '../app/controllers/UserController.php';
require '../app/models/User.php';

use App\Controllers\ProductController;
use App\Models\Product;
use App\Controllers\UserController;
use App\Models\User;

$productCtrl = new ProductController();
$productCtrl->list();

$userCtrl = new UserController();
$userCtrl->profile();

$product = new Product();
$product->name = "stylo";
$product->price = 2.3;

echo $product->name;

$user = new User();
$user->username = "Toto";
$user->email = "toto@gmail.com";


