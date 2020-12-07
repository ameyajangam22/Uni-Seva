<?php
if (!(isset($_POST["email"]) && isset($_POST["password"]))) {
    header("Location: login.php");
    exit();
}
// I've used session variables to store the username on success and error message on failure
session_start();
echo "Checking...";
require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/dbConnection.php';
// The user might've entered the username or email so check both
$stmt = $conn->prepare("select password,designation from user where email=?");
$stmt->bind_param("s", $email);
$email = $_POST["email"];
$stmt->execute();
$result = $stmt->get_result();
// If the username/email exists
if (mysqli_num_rows($result)) {
    $row = $result->fetch_assoc();

    if (password_verify($_POST["password"], $row["password"])) {
        $_SESSION["email"] = $email;
        $_SESSION["Designation"]=$row["designation"];
        if($_SESSION["Designation"]=="student"){
            header("Location: user.php");
        }
        elseif ($_SESSION["Designation"]=="canteen") {
           header("Location: menuCanteen.php");
        }
        elseif ($_SESSION["Designation"]=="employee") {
           header("Location: report.php");
        }
        elseif ($_SESSION["Designation"]=="housekeeping") {
           header("Location: housekeeper.php");
        }
       
        exit();
        // Redirect to the landing page
    } else {
        // Setting the error
        $_SESSION["mismatch"] = "The username/email and password you entered don't match!";
    }
} else {
    // Setting the error
    $_SESSION["non-existant"] = "The username or email you entered doesn't exist!";
}
// Redirect
header("Location: login.php");
mysqli_close($conn);
