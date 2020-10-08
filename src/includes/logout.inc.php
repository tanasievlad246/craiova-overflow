<?php
include '../classes/User.class.php';

User::logOut();
header('Location: ../../index.php?logout=success');
