<?php
session_start();
require "queries.php";
$cart = $_SESSION["cart"] ?? [];


foreach ($cart as $item) {
    $db_product = getProduct($item["product"]["id"]);
    $current_stock = $db_product["stock"];
    $new_stock = $current_stock - $item["quantity"];
    if ($new_stock <= 0) {
        $query = "DELETE FROM product WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$item["product"]["id"]]);
    } else {
        $query = "UPDATE product SET stock = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$new_stock, $item["product"]["id"]]);
    }
}

$_SESSION["cart"] = [];
header("Location: ../");
