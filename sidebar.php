 <?php
require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/dbConnection.php';

$email = mysqli_real_escape_string($conn, $_SESSION['email']);
$sqlx = "SELECT name from user where email='$email'";
$rezx = mysqli_query($conn, $sqlx);
$row = $rezx->fetch_assoc();
	

	
?>




<div id="main">
        <div id="postsarea"></div>
        <div id="loader" class="loader">
            <!-- loading css animation -->
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>
    </div>
    <div id="mySidebar" class="sidebar">
    <div class="logo ">
        
    </div>
    <?php if($_SESSION["Designation"]=="student"){?>


    <a href="/Uni-Seva/user.php">Home</a>
    <a href="/Uni-Seva/lostandfound.php">Lost And Found</a>
    <a href="/Uni-Seva/lostfoundupload.php">Upload Found Property</a>
    <a href="/Uni-Seva/myFoundClaims.php">My Scantions</a>
    <a href="/Uni-Seva/clean.php">Report Cleanliness</a>
    <a href="/Uni-Seva/menu.php">Menu</a>
    <a href="/Uni-Seva/myOrder.php">My Order</a>
    

<?php } elseif ($_SESSION["Designation"]=="canteen") {?>
	
    <a href="/Uni-Seva/lostandfound.php">Lost And Found</a>
    <a href="/Uni-Seva/lostfoundupload.php">Upload Found Property</a>
    <a href="/Uni-Seva/myFoundClaims.php">My Scantions</a>
    <a href="/Uni-Seva/clean.php">Report Cleanliness</a>
    <a href="/Uni-Seva/menuCanteen.php">Menu</a>
    <a href="/Uni-Seva/canteen.php">View Order</a>
    
<?php } elseif($_SESSION["Designation"]=="employee"){ ?>

	
    <a href="/Uni-Seva/lostandfound.php">Lost And Found</a>
    <a href="/Uni-Seva/lostfoundupload.php">Upload Found Property</a>
    
    <a href="/Uni-Seva/clean.php">Report Cleanliness</a>
    <a href="/Uni-Seva/report.php">Check Reports</a>
    <a href="/Uni-Seva/menu.php">Menu</a>
    <a href="/Uni-Seva/myOrder.php">My Order</a>

<?php } elseif($_SESSION["Designation"]=="housekeeping"){?>

	
    <a href="/Uni-Seva/lostandfound.php">Lost And Found</a>
    <a href="/Uni-Seva/lostfoundupload.php">Upload Found Property</a>
    <a href="/Uni-Seva/myFoundClaims.php">My Scantions</a>
    <a href="/Uni-Seva/housekeeper.php">Clean Places</a>
    <a href="/Uni-Seva/menu.php">Menu</a>
    <a href="/Uni-Seva/myOrder.php">My Order</a>

<?php } ?>
</div>