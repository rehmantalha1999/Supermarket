<?php
require "queries.php";
function getTotalPrice($cart)
{
    $total = 0;
    foreach ($cart as $item) {
        $total += $item["quantity"] * $item["product"]["discounted_price"];
    }
    return $total;
}

function getTotalQuantity($cart)
{
    $total = 0;
    foreach ($cart as $item) {
        $total += $item["quantity"];
    }
    return $total;
}

function getQuantityById($id)
{
    $cart = $_SESSION["cart"] ?? [];
    foreach ($cart as $item) {
        if ($item["product"]["id"] == $id) {
            return $item["quantity"];
        }
    }
    return 0;
}

function removeFromCart($cart, $id)
{
    foreach ($cart as $key => $item) {
        if ($item["product"]["id"] == $id) {
            if ($item["quantity"] > 1) {
                $item["quantity"]--;
                $cart[$key] = $item;
            } else {
                unset($cart[$key]);
            }
        }
    }
    return $cart;
}

function addToCart($cart, $id)
{
    foreach ($cart as $key => $item) {
        if ($item["product"]["id"] == $id) {
            $item["quantity"] = $item["quantity"] + 1;
            $cart[$key] = $item;
            return $cart;
        }
    }
    $product = getProduct($id);
    $cart[] = [
        "product" => $product,
        "quantity" => 1
    ];
    return $cart;
}

function productExistsInCart($cart, $id)
{
    foreach ($cart as $item) {
        if ($item["product"]["id"] == $id) {
            return true;
        }
    }
    return false;
}

function getProductInCart($cart, $id)
{
    foreach ($cart as $item) {
        if ($item["product"]["id"] == $id) {
            return $item;
        }
    }
    return null;
}

function getTotalPriceOfProductInCart($cart, $id)
{
    foreach ($cart as $item) {
        if ($item["product"]["id"] == $id) {
            return $item["quantity"] * $item["product"]["discounted_price"];
        }
    }
    return 0;
}
