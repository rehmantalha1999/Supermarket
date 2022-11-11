<?php
require "../db.php";
function registerUser($email, $name, $password, $city, $district, $address, $verification_number)
{
    global $db;
    $stmt = $db->prepare("INSERT INTO market(email, name, password, city, district, address, verificationNumber) VALUES (?,?,?,?,?,?,?)");
    $stmt->execute([$email, $name, $password, $city, $district, $address, $verification_number]);
}

function checkUser($email, $pass)
{
    global $db;

    $stmt = $db->prepare("select * from market where email=?");
    $stmt->execute([$email]);
    if ($stmt->rowCount()) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return password_verify($pass, $user["password"]);
    }
    return false;
}

function validSession()
{
    return isset($_SESSION["user"]);
}

function getUser($email)
{
    global $db;
    $stmt = $db->prepare("select * from market where email=?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function verifyUser($email)
{
    global $db;
    $stmt = $db->prepare("update market set isVerified=1 where email=?");
    $stmt->execute([$email]);
}
