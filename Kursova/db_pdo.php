<?php
$dbname='kursova';
$username='root';
$pass='root';
$dbh = new PDO('mysql:host=localhost;dbname='.$dbname, $username,$pass);
if (!$dbh) {
    echo "Mysql don't connect";
    die();
}


