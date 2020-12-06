<?php
$email = mysqli_real_escape_string($conn, $_SESSION['email']);
$sqlx = "SELECT name from user where email='$email'";
$rezx = mysqli_query($conn, $sqlx);
$row = $rezx->fetch_assoc();
?>
<div id="mySidebar" class="sidebar">

    <a href="feed.php">Home</a>
    <a href="#">Find Other Users</a>
    <a href="#">Pending Requests</a>
    <a href="#">My Followers</a>
    <a href="#">Following</a>
    <a href="#">Upload a Post!</a>
    <a href="#">My Posts</a>
</div>