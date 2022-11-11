<?php
require "queries.php";
session_start();

if (validSession()) {
  header("Location: store");
}

if (!empty($_POST)) {
  require "Mail.php";

  extract($_POST);

  if (empty($email)) {
    $error["email"] = "Email is required";
  }
  if (empty($password)) {
    $error["password"] = "Password is required";
  }
  if (!empty($password) && strlen($password) < 6) {
    $error["password"] = "Password must be at least 6 characters";
  }
  if (empty($name)) {
    $error["name"] = "Name is required";
  }
  if (empty($city)) {
    $error["city"] = "City is required";
  }
  if (empty($district)) {
    $error["district"] = "District is required";
  }
  if (empty($address)) {
    $error["address"] = "Address is required";
  }
  if (!empty($email) && getUser($email)) {
    $error["email"] = "Email already exists";
  }

  if (!isset($error)) {
    try {
      $hashPass = password_hash($password, PASSWORD_BCRYPT);
      $random_number = rand(100000, 999999);
      registerUser($email, $name, $hashPass, $city, $district, $address, $random_number);
      Mail::send($email, "Verification Code", "Your verification code is: " . $random_number, $name);
      header("Location: ../market");
    } catch (PDOException $ex) {
      echo "Error: " . $ex->getMessage();
      exit;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Marketer SignUp | LAMDAS</title>
  <link rel="stylesheet" href="index.css">
</head>

<body>
  <div id="root">
    <div class="background">
      <div class="navbar">
        <div class="navbar-login">
          <h1 class="vms">λ</h1>
          <h4 class="valvemgmt">LAMDAS</h4>
          <hr class="hr-one" />
          <h1 class="qa">MARKETER SIGN UP</h1>
          <div class="form">
            <form action="" method="POST" enctype="multipart/form-data">
              <label htmlFor="email" class="label"> Email </label>
              <input class="inp-text" type="email" name="email" id="email" value="<?= isset($email) ? $email : '' ?>" />
              <?php
              isset($error["email"]) ? print("<p class='error'>" . $error["email"] . "</p>") : print("");
              ?>
              <label htmlFor="name" class="label"> Name </label>
              <input class="inp-text" type="text" name="name" id="name" value="<?= isset($name) ? $name : '' ?>" />
              <?php
              isset($error["name"]) ? print("<p class='error'>" . $error["name"] . "</p>") : print("");
              ?>
              <label htmlFor="password" class="label"> Password </label>
              <input class="inp-text" type="password" name="password" id="password" value="<?= isset($password) ? $password : '' ?>" />
              <?php
              isset($error["password"]) ? print("<p class='error'>" . $error["password"] . "</p>") : print("");
              ?>
              <label htmlFor="city" class="label"> City </label>
              <input class="inp-text" type="text" name="city" id="city" value="<?= isset($city) ? $city : '' ?>" />
              <?php
              isset($error["city"]) ? print("<p class='error'>" . $error["city"] . "</p>") : print("");
              ?>
              <label htmlFor="district" class="label"> District </label>
              <input class="inp-text" type="text" name="district" id="district" value="<?= isset($district) ? $district : '' ?>" />
              <?php
              isset($error["district"]) ? print("<p class='error'>" . $error["district"] . "</p>") : print("");
              ?>
              <label htmlFor="address" class="label"> Address </label>
              <input class="inp-text" type="text" name="address" id="address" value="<?= isset($address) ? $address : '' ?>" />
              <?php
              isset($error["address"]) ? print("<p class='error'>" . $error["address"] . "</p>") : print("");
              ?>
              <button class="btn">CONTINUE →</button>
            </form>
            <div class='dont'>
              <p>Already a member? <a href="../market">Login here</a></p>
            </div>
          </div>
          <hr class="hr-two" />
          <div class="footer">
            <h2 class="meta">META</h2>
            <p class="note">QUEST</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>