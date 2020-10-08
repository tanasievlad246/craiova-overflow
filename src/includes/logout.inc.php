<?php
include '../classes/User.class.php';

User::logOut();
header('Location: http://localhost/craiova-overflow/index.php?logout=success');
