<?php
session_start();
require "queries.php";
if (!isset($_SESSION['user'])) {
    header("Location: ../");
}
$user = getUser($_SESSION['user']['id']);

if (!empty($_POST)) {
    extract($_POST);
    if (!$name || !$city || !$district || !$address) {
        $error = "Please fill all the fields";
    }
    if (!isset($error)) {
        editUser($user["id"], $name, $city, $district, $address);
        $_SESSION['user'] = getUser($user["id"]);
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
    <title>My Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="card-container">
        <form action="" method="POST" enctype="multipart/form-data">
            <h1>Edit Profile</h1>
            <div class="input-container">
                <label for="title-input">Name</label>
                <input type="text" name="name" id="name-input" value="<?php echo $user["name"]; ?>">
            </div>
            <div class="input-container">
                <label for="city-input">City</label>
                <input type="text" name="city" id="city-input" value="<?php echo $user["city"]; ?>">
            </div>
            <div class="input-container">
                <label for="district-input">District</label>
                <input type="text" name="district" id="district-input" value="<?php echo $user["district"]; ?>">
            </div>
            <div class="input-container">
                <label for="address-input">Address</label>
                <input type="text" name="address" id="address-input" value="<?php echo $user["address"]; ?>">
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