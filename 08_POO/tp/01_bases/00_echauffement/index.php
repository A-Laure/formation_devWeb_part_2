<?php 

require 'Product.php';


$product1 = new Product('Voiture', 1000.52);




echo 'Name: ' . $product1->getName() . '  ';
echo '</br>';
echo 'Price: ' . $product1->getPrice() . '  ';

