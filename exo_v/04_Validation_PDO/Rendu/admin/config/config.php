<?php

# APP TAG
// pour CREER $_SESSION['stock']
// 'define' crée une constante
define('APP_TAG', 'nain');


# DATABASE
	// CREATION DES CONSTANTES (A FAIRE)


define('DB_ENGINE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'gurdil');
define('DB_CHARSET', 'utf8mb4');
define('DB_USER', 'root');
// pwd = root sur mac et rien sur window
define('DB_PWD', '');


# $dsn (ou $pdo) = 'mysql:host=localhost;	dbname=gestionstockone;	charset=utf8'; 
	//EQUIVALENT MAIS AVEC DES CONSTANTES => 
define('DSN', DB_ENGINE . ':host=' . DB_HOST .';dbname=' . DB_NAME.';charset=' . DB_CHARSET);


