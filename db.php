<?php

$dsn = "mysql:host=sql7.freemysqlhosting.net;port=3306;dbname=sql7561674;charset=utf8mb4";
$user = "sql7561674";
$pass = "MjKcLctxbZ";

try {
    $db = new PDO($dsn, $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    gotoErrorPage();
}

function gotoErrorPage()
{
    header("Location: error.php");
    exit;
}
