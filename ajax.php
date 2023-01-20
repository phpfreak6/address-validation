<?php
include('config.php'); // include database file.
include('validator.php');
$var = new Validator($servername, $username, $password, $dbName);
$var->uspsFunction();
?>