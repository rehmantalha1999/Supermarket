<?php
require "queries.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../");
}

$user = $_SESSION["user"];
if (!$user["isVerified"]) {
    header("Location: ../verify-email.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Dashboard | LAMDAS</title>
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <main>
        <nav id="nav">
            <div id="title">LAMDA<span>λ</span></div>
            <div>
                <a href="add-product.php">Add Product</a>
                <a href="profile.php">My Profile</a>
                <a href="logout.php" class="logout-link">Logout</a>
            </div>
        </nav>

        <h1 class="section-title">Expired Products</h1>
        <div class="product-blocks">
            <?php
            $products = getExpiredProductsByMarketId($user["id"]);
            if (!$products) {
                echo "<h2>You have no expired products</h2>";
            } else {
                foreach ($products as $product) {
                    echo '<div class="product">';
                    echo '<img class="product-image" src="../../product_images/' . $product["image_path"] . '" />';
                    echo '<h4 class="product-title">' . $product["title"] . '</h4>';
                    echo '<div class="product-detail">';
                    echo "<p><span>Actual Price:</span> " . $product["normal_price"] . " TL</p>";
                    echo "<p><span>Discounted Price:</span> " . $product["discounted_price"] . " TL</p>";
                    echo "<p><span>Expiry Date:</span> " . $product["expiration_date"] . " </p>";
                    echo "<p><span>Stock: </span>" . $product["stock"] . " </p>";
                    echo "</div>";
                    echo "<div class='buttons'>";
                    echo "<a href='delete-product?id=" . $product["id"] . "' class='delete-btn'>Delete</a>";
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>

        <h1 class="section-title">Fresh Products</h1>
        <div class="product-blocks">
            <?php
            $products = getProductsByMarketId($user["id"]);
            if (!$products) {
                echo "<h2>You have no fresh products</h2>";
            } else {
                foreach ($products as $product) {
                    echo '<div class="product">';
                    echo '<img class="product-image" src="../../product_images/' . $product["image_path"] . '" />';
                    echo '<h4 class="product-title">' . $product["title"] . '</h4>';
                    echo '<div class="product-detail">';
                    echo "<p><span>Actual Price:</span> " . $product["normal_price"] . " TL</p>";
                    echo "<p><span>Discounted Price:</span> " . $product["discounted_price"] . " TL</p>";
                    echo "<p><span>Expiry Date:</span> " . $product["expiration_date"] . " </p>";
                    echo "<p><span>Stock: </span>" . $product["stock"] . " </p>";
                    echo "</div>";
                    echo "<div class='buttons'>";
                    echo "<a href='edit-product?id=" . $product["id"] . "'>Edit</a>";
                    echo "<a href='delete-product?id=" . $product["id"] . "' class='delete-btn'>Delete</a>";
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </main>
</body>

</html>