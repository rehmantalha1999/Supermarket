<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../");
}

require "queries.php";
require "Upload.php";

if (!empty($_POST)) {
    extract($_POST);
    if (empty($title) || empty($normal_price) || empty($discounted_price) || empty($expiration_date) || empty($stock)) {
        $error = "Please fill all the fields";
    }
    if ($discounted_price >= $normal_price) {
        $error = "Discounted price must be less than normal price";
    }
    if ($_FILES["image"]["name"] == "") {
        $error = "Please upload an image";
    }
    if (!isset($error)) {
        $image = new Upload("image", "../../product_images");
        $filename = $image->file() ?? "image" . rand(100000, 999999) . ".jpg";
        addProduct($title, $normal_price, $discounted_price, $expiration_date, $stock, $filename, $_SESSION["user"]["id"]);
        header("Location: ../store");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="card-container">
        <form action="" method="POST" enctype="multipart/form-data">
            <h1>Add Product</h1>
            <div class="input-container">
                <label for="title-input">Title</label>
                <input type="text" name="title" id="title-input" value="<?= isset($title) ? $title : '' ?>">
            </div>
            <div class="input-container">
                <label for="normal-price-input">Normal Price (TL)</label>
                <input type="number" name="normal_price" id="normal-price-input" value="<?= isset($normal_price) ? $normal_price : '' ?>">
            </div>
            <div class="input-container">
                <label for="discounted-price-input">Discounted Price (TL)</label>
                <input type="number" name="discounted_price" id="discounted-price-input" value="<?= isset($discounted_price) ? $discounted_price : '' ?>">
            </div>
            <div class="input-container">
                <label for="expiration-date-input">Expiration Date</label>
                <input type="date" name="expiration_date" id="expiration-date-input" value="<?= isset($expiration_date) ? $expiration_date : '' ?>">
            </div>
            <div class="input-container">
                <label for="stock-input">Stock</label>
                <input type="number" name="stock" id="stock-input" value="<?= isset($stock) ? $stock : '' ?>">
            </div>
            <div class="file-input-container">
                <label for="image-input">Image</label>
                <input type="file" name="image" id="image-input">
            </div>
            <?php
            if (isset($error)) {
                echo "<div class='error-message'>$error</div>";
            }
            ?>
            <div class="buttons">
                <button type="submit" class="btn-submit">Add</button>
                <a href="../store">Go Back</a>
            </div>
        </form>
    </div>
</body>

</html>