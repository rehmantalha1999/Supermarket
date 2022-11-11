<?php
require "../../db.php";

function getProductsByMarketId($id)
{
    global $db;
    $stmt = $db->prepare("select * from product WHERE market_id = ? AND expiration_date > NOW() ORDER BY expiration_date ASC");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getExpiredProductsByMarketId($id)
{
    global $db;
    $stmt = $db->prepare("select * from product WHERE market_id = ? AND expiration_date < NOW() ORDER BY expiration_date ASC");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProduct($id)
{
    global $db;
    $stmt = $db->prepare("select * from product where id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editProduct($id, $title, $normal_price, $discounted_price, $expiration_date, $stock, $imagePath)
{
    global $db;
    $stmt = $db->prepare("update product set title = ?, normal_price = ?, discounted_price = ?, expiration_date = ?, stock = ?, image_path = ? where id = ?");
    $stmt->execute([$title, $normal_price, $discounted_price, $expiration_date, $stock, $imagePath, $id]);
}

function addProduct($title, $normal_price, $discounted_price, $expiration_date, $stock, $imagePath, $marketId)
{
    global $db;
    $stmt = $db->prepare("insert into product (title, normal_price, discounted_price, expiration_date, stock, image_path, market_id) values (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $normal_price, $discounted_price, $expiration_date, $stock, $imagePath, $marketId]);
}

function deleteProduct($id)
{
    global $db;
    $stmt = $db->prepare("delete from product where id = ?");
    $stmt->execute([$id]);
}

function editUser($id, $name, $city, $district, $address)
{
    global $db;
    $stmt = $db->prepare(
        "UPDATE market SET name = ?, city = ?, district = ?, address = ? WHERE id = ?"
    );
    $stmt->execute([$name, $city, $district, $address, $id]);
}

function getUser($id)
{
    global $db;
    $stmt = $db->prepare(
        "SELECT * FROM market WHERE id = ?"
    );
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
