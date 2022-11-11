<?php
require "../../db.php";

function getProducts($name, $city)
{
    $city = strtoupper($city);
    global $db;
    if (isset($name) && !empty($name)) {
        $stmt = $db->prepare(
            "SELECT product.*, market.name AS market_name, market.city AS market_city, 
        market.district AS market_district, market.address AS market_address 
        FROM product
        JOIN market ON market.id = product.market_id AND UPPER(market.city) = '$city'
        WHERE LOWER(product.title) LIKE '%$name%' AND expiration_date > now() ORDER BY expiration_date ASC"
        );
        $stmt->execute();
    } else {
        $stmt = $db->prepare(
            "SELECT product.*, market.name AS market_name, market.city AS market_city, 
        market.district AS market_district, market.address AS market_address 
        FROM product
        JOIN market ON market.id = product.market_id AND UPPER(market.city) = '$city'
        WHERE expiration_date > now() ORDER BY expiration_date ASC"
        );
        $stmt->execute();
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProduct($id)
{
    global $db;
    $stmt = $db->prepare(
        "SELECT product.*, market.name AS market_name, market.city AS market_city, 
        market.district AS market_district, market.address AS market_address 
        FROM product
        JOIN market ON market.id = product.market_id
        WHERE product.id = $id"
    );
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editUser($id, $name, $city, $district, $address)
{
    global $db;
    $stmt = $db->prepare(
        "UPDATE consumer SET name = ?, city = ?, district = ?, address = ? WHERE id = ?"
    );
    $stmt->execute([$name, $city, $district, $address, $id]);
}

function getUser($id)
{
    global $db;
    $stmt = $db->prepare(
        "SELECT * FROM consumer WHERE id = ?"
    );
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
