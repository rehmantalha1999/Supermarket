<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../");
}
require "queries.php";

if (!empty($_POST)) {
    extract($_POST);

    $id = $_GET['id'] ?? "";

    if (isset($_POST["submit"]) && !empty($id)) {
        deleteProduct($id);
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
    <title>Delete Product | LAMDAS</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="card-container">
        <form action="" method="POST" enctype="multipart/form-data">
            <h1>Delete Product</h1>
            <p>Are you sure you want to delete the product? This action can not be reversed</p>
            <div class="buttons">
                <button type="submit" class="btn-submit" name="submit">Delete</button>
                <a href="../store">Go Back</a>
            </div>
        </form>
    </div>
</body>

</html>