<?php
require "/xampp/htdocs/craiova-overflow/vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . "/craiova-overflow");
$dotenv->load();
