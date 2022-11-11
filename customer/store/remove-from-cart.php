<?php
require "cart_functions.php";
session_start();
$cart = $_SESSION["cart"] ?? [];
$id = $_GET["id"] ?? "";

if (isset($id) && !empty($id)) {
    $newCart = removeFromCart($cart, $id);
    $_SESSION["cart"] = $newCart;
    header("Location: ../");
}
