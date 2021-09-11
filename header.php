<?php
include "config.php";
include "cookie.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
  <title>The Online Library</title>
</head>

<body>
  <header>
    <ul class="nav">
      <!-- Login -->
      <li class="<?php if ($current_page == 'login.php') {echo 'active';}?>">
        <a href="login.php">
          Login
        </a>
      </li>
      <!-- Home -->
      <li class="<?php if ($current_page == 'index.php') {echo 'active';}?>">
        <a href="index.php">
          Home
        </a>
      </li>
      <!-- About -->
      <li class="<?php if ($current_page == 'about.php') {echo 'active';}?>">
        <a href="about.php">
          About
        </a>
      </li>
      <!-- Browse -->
      <li class="<?php if ($current_page == 'browse.php') {echo 'active';}?>">
        <a href="browse.php">
          Browse
        </a>
      </li>
      <!-- My Books -->
      <li class="<?php if ($current_page == 'mybooks.php') {echo 'active';}?>">
        <a href="mybooks.php">
          My Books
        </a>
      </li>
      <!-- Gallery -->
      <li class="<?php if ($current_page == 'gallery.php') {echo 'active';}?>">
        <a href="gallery.php">
          Gallery
        </a>
      </li>
      <!-- Contact Us -->
      <li class="<?php if ($current_page == 'contact.php') {echo 'active';}?>">
        <a href="contact.php">
          Contact Us
        </a>
      </li>
    </ul>
    <div id="heroimage"> </div>
    <h1 class="title">The Online Library</h1>
