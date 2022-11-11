<?php
require "queries.php";
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: ../market");
}
$user = $_SESSION["user"];

if (!empty($_POST)) {
    extract($_POST);

    if ($number == $user["verificationNumber"]) {
        verifyUser($user["email"]);
        $_SESSION["user"]["isVerified"] = true;
        header("Location: store");
    }
    $error = "Wrong verification number";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email | LAMDAS</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="verify-container">
        <form action="" method="POST">
            <h1>Email Verification</h1>
            <input type="number" placeholder="Enter the 6 digit code" name="number">
            <?php
            isset($error) ? print("<p class='error'>" . $error . "</p>") : print("");
            ?>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>