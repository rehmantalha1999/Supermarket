<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../");
}

require "queries.php";
require "Upload.php";

$id = $_GET["id"] ?? "";
if (!$id) {
    header("Location: ../store");
}
$product = getProduct($id);
if (!$product) {
    header("Location: ../store");
}
$title = $product["title"];
$image_path = $product["image_path"];
$normal_price = $product["normal_price"];
$discounted_price = $product["discounted_price"];
$expiration_date = $product["expiration_date"];
$stock = $product["stock"];

if (!empty($_POST)) {
    extract($_POST);
    if (!$title || !$normal_price || !$discounted_price || !$expiration_date || !$stock) {
        $error = "Please fill all the fields";
    }
    if ($discounted_price >= $normal_price) {
        $error = "Discounted price must be less than normal price";
    }
    if ($_FILES["image"]["name"] != "") {
        $image = new Upload("image", "../../product_images");
        $filename = $image->file() ?? "image" . rand(100000, 999999) . ".jpg";
    } else {
        $filename = $image_path;
    }
    if (!isset($error)) {
        editProduct($id, $title, $normal_price, $discounted_price, $expiration_date, $stock, $filename);
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
    <title>Edit Product | LAMDAS</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="card-container">
        <form action="" method="POST" enctype="multipart/form-data">
            <h1>Edit Product</h1>
            <img src="../../product_images/<?= $image_path ?>" alt="" class="add-product-image">
            <div class="input-container">
                <label for="title-input">Title</label>
                <input type="text" name="title" id="title-input" value="<?php echo $title; ?>">
            </div>
            <div class="input-container">
                <label for="normal-price-input">Normal Price (TL)</label>
                <input type="number" name="normal_price" id="normal-price-input" value="<?php echo $normal_price; ?>">
            </div>
            <div class="input-container">
                <label for="discounted-price-input">Discounted Price (TL)</label>
                <input type="number" name="discounted_price" id="discounted-price-input" value="<?php echo $discounted_price; ?>">
            </div>
            <div class="input-container">
                <label for="expiration-date-input">Expiration Date</label>
                <input type="date" name="expiration_date" id="expiration-date-input" value="<?php echo $expiration_date; ?>">
            </div>
            <div class="input-container">
                <label for="stock-input">Stock</label>
                <input type="number" name="stock" id="stock-input" value="<?php echo $stock; ?>">
            </div>
            <div class="file-input-container">
                <label for="image-input">New Image</label>
                <input type="file" name="image" id="image-input">
            </div>
            <?php
            if (isset($error)) {
                echo "<div class='error-message'>$error</div>";
            }
            ?>
            <div class="buttons">
                <button type="submit" class="btn-submit">Edit</button>
                <a href="../store">Go Back</a>
            </div>
        </form>
    </div>
</body>

</html>