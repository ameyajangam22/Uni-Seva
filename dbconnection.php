<?php
$host = "localhost";
$user = 'pparam2610';
$password = 'php@123';
$database = 'uni';

$conn = mysqli_connect($host, $user, $password, $database);
if ($conn->connect_error)
    die("connection failed: " . $conn->connect_error);
