<?php
session_start();
if (!(isset($_SESSION["email"]))) {
    header("Location:login.php");
    exit();
}
if (isset($_POST['complaint_id'])) {
    $_SESSION['complaint_id'] = $_POST['complaint_id'];
} else {
    echo "error";
}
