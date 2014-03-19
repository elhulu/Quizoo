<?php

try {

$dns = 'mysql:host=db515167178.db.1and1.com;dbname=db515167178';
$User = 'dbo515167178';
$password = 'orion22';
$bdd = new PDO( $dns, $User, $password );

    $bdd->query("SET NAMES utf8");

} catch ( Exception $e ) {
    echo "Connection à MySQL impossible : ", $e->getMessage();
    die();
}

?>