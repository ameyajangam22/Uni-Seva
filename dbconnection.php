<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "UNI";
$conn = mysqli_connect($host, $user, $password, $database);
if ($conn->connect_error)
    die("connection failed: " . $conn->connect_error);
