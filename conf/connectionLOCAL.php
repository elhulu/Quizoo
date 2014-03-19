<?php

try {

$dns = 'mysql:host=localhost;dbname=quizzooo_api';
$User = 'root';
$password = '';
$bdd = new PDO( $dns, $User, $password );

    $bdd->query("SET NAMES utf8");

} catch ( Exception $e ) {
    echo "Connection à MySQL impossible : ", $e->getMessage();
    die();
}

?>