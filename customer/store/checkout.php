<?php
require "cart_functions.php";
session_start();
$total = getTotalPrice($_SESSION["cart"]);
$total_quantity = getTotalQuantity($_SESSION["cart"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <main>
        <nav id="nav">
            <div id="title">LAMDA<span>λ</span></div>
            <div class="header-right">
                <a href="./" class="back-btn">Go Back</a>
                <a href="logout.php" class="logout-link">Logout</a>
            </div>
        </nav>

        <h1 class="section-title">Checkout</h1>

        <div class="checkout-details">
            <div class="checkout-table">
                <h3></h3>
                <h3>Name</h3>
                <h3>Quantity</h3>
                <h3>Price</h3>
                <h3>Total Price</h3>
                <?php
                foreach ($_SESSION["cart"] as $item) {
                    $product = $item["product"];
                    $quantity = $item["quantity"];
                    $price = $product["discounted_price"];
                ?>
                    <img class="checkout-product-image" src="../../product_images/<?= $product["image_path"] ?>" alt="" />
                    <p><?= $product["title"] ?></p>
                    <p><?= $quantity ?></p>
                    <p><?= $price ?> TL</p>
                    <p><?= $price * $quantity ?> TL</p>
                <?php } ?>
            </div>
            <div class="checkout-footer">
                <?php
                echo '<p>Total Cost: ' . getTotalPrice($_SESSION["cart"]) . ' TL</p>';
                ?>
            </div>
            <div class="complete-checkout">
                <a href="complete-checkout">Purchase</a>
            </div>
        </div>
    </main>
</body>

</html>