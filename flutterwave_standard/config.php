<?php 

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('FLUTTERWAVE_PUBLIC_KEY', $_ENV['FLUTTERWAVE_PUBLIC_KEY']);
define('FLUTTERWAVE_SECRET_KEY', $_ENV['FLUTTERWAVE_SECRET_KEY']);
define('FLUTTERWAVE_ENCRYPTION_KEY', $_ENV['FLUTTERWAVE_ENCRYPTION_KEY']);
define('FLUTTERWAVE_SECRET_HASH', $_ENV['FLUTTERWAVE_SECRET_HASH']);
define('REDIRECT_URL', $_ENV['REDIRECT_URL']);