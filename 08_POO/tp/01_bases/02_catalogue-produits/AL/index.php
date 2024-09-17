<?php 

require 'Product.php';
require 'Catalog.php';

$catalogue  = new Catalog();



$product1 = new Product('Peugeot', 10.2, 2);
$product2 = new Product('Renault', 20.2, 1);

// AVEC spread operator
$catalogue->addProduct($product1, $product2);

// SANS spread operator
// $catalogue->AddProduct($product1);
// $catalogue->AddProduct($product2);

$product1->detailsDisplay();

echo '</br>';
echo '</br>';

$product2->detailsDisplay();

echo '</br>';
echo '</br>';

echo '<hr>';
echo '<div class="container">';
echo '<pre>';
print_r($catalogue);
echo '</pre>';
echo '</div>';

$catalogue->deleteProduct('Renault');

echo '</br>';
echo '</br>';

echo '<hr>';
echo '<div class="container">';
echo '<pre>';
print_r($catalogue);
echo '</pre>';
echo '</div>';

$catalogue->searchName('Peugeot');