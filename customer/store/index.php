<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard | LAMDAS</title>
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    require "cart_functions.php";
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: ../../customer");
    }

    $user = $_SESSION["user"];
    if (!$user["isVerified"]) {
        header("Location: ../verify-email.php");
        exit;
    }

    $name = $_GET["name"] ?? "";

    ?>
    <main>
        <nav id="nav">
            <div id="title">LAMDA<span>λ</span></div>
            <form action="" method="GET">
                <input type="search" name="name" value="<?= isset($name) ? $name : '' ?>">
                <button type="submit">Search</button>
            </form>
            <div class="header-right">
                <a href="checkout.php" class="cart">
                    <img src="cart.jpg" class="cart_image">
                    <?php
                    if (getTotalQuantity($_SESSION["cart"]) > 0) {
                        echo '<span class="cart-count">' . getTotalQuantity($_SESSION["cart"]) . '</span>';
                    }
                    ?>
                </a>
                <a href="profile.php" class="link">My Profile</a>
                <a href="logout.php" class="link logout-link">Logout</a>
            </div>
        </nav>

        <div class="product-blocks">

            <?php
            $products = getProducts($name, $user["city"]);
            if (!$products) {
                echo "<h1>No products found</h1>";
            }
            foreach ($products as $product) {
                echo '<div class="product">';
                echo '<img class="product-image" src="../../product_images/' . $product["image_path"] . '" alt="" />';
                echo '<h4 class="product-title">' . $product["title"] . '</h4>';
                echo '<div class="product-detail">';
                echo "<p><span>Actual Price:</span> " . $product["normal_price"] . " TL</p>";
                echo "<p><span>Discounted Price:</span> " . $product["discounted_price"] . " TL</p>";
                echo "<p><span>Expiry Date:</span> " . $product["expiration_date"] . " </p>";
                echo "<p><span>Stock: </span>" . $product["stock"] . " </p>";
                echo "<p><span>Market Name: </span>" . $product["market_name"] . " </p>";
                echo "<p><span>District: </span>" . $product["market_district"] . " </p>";
                echo "<p><span>City: </span>" . $product["market_city"] . " </p>";
                echo "<p><span>Address: </span>" . $product["market_address"] . " </p>";
                echo "</div>";
                echo "<div class='buttons'>";
                if (productExistsInCart($_SESSION["cart"], $product["id"])) {
                    $product_in_cart = getProductInCart($_SESSION["cart"], $product["id"]);
                    echo "<div class='quantity-container'>";
                    if ($product_in_cart["quantity"] < $product["stock"]) {
                        echo "<a href='add-to-cart?id=" . $product["id"] . "'>+</a>";
                    } else {
                        echo "<a class='disabled'>+</a>";
                    }
                    echo "<p class='quantity-display'>" . $product_in_cart["quantity"] . "</p>";
                    echo "<a href='remove-from-cart?id=" . $product["id"] . "'>-</a>";
                    echo "</div>";
                } else {
                    echo "<a href='add-to-cart?id=" . $product["id"] . "'>Add To Cart</a>";
                }
                echo '</div>';
                echo '</div>';
            }
            ?>

        </div>
    </main>
</body>

</html>