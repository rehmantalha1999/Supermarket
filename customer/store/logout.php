<?php
session_start();

session_destroy();  // delete session file
// delete cookie
setcookie(session_name(), "", 1, "/"); // delete memory cookie 
header("Location: ../");
