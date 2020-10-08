<?php
require "/xampp/htdocs/go-ask/vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . "/go-ask");
$dotenv->load();
