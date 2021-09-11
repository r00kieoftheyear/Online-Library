<?php
$URI = $_SERVER['REQUEST_URI'];

$strings = explode('/', $URI); //breaks string into array

$current_page = end($strings); //outputs last element in the array
?>
