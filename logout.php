<?php
include "cookie.php";

$_SESSION = array();
session_destroy();
header("location: login.php");
exit;
?>
