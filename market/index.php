<?php
session_start();
require "queries.php";

if (!empty($_POST)) {
  extract($_POST);

  if (checkUser($email, $password)) {
    $user = getUser($email);
    $_SESSION["user"] = $user;
    if ($user["isVerified"]) {
      header("Location: store");
    } else {
      header("Location: verify-email");
    }
  }
  $error = "Wrong email or password";
}

if (validSession()) {
  header("Location: store");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Marketer Login | LAMDAS</title>
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
          <h1 class="qa">MARKETER LOGIN</h1>
          <div class="form">
            <form action="" method="POST" enctype="multipart/form-data">
              <label htmlFor="email" class="label"> Email </label>
              <br />
              <input class="inp-text" type="email" name="email" id="email" value="<?= isset($email) ? $email : '' ?>" />
              <br />
              <label htmlFor="password" class="label"> Password </label>
              <br />
              <input class="inp-text" type="password" name="password" id="password" />
              <br />
              <button class="btn">CONTINUE →</button>
              <?php
              if (isset($error)) {
                echo "<p class='error'>$error</p>";
              }
              ?>
            </form>
            <div class='dont'>
              <p>Don't have an account? <a href="./msignup.php">Sign Up here</a></p>
              <a href="../customer" class="a-btn">Customer Login</a>
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