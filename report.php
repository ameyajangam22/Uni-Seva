
<?php
session_start();
if (!(isset($_SESSION["email"]))) {
    header("Location: login.php");
    exit();
}
require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/dbConnection.php';
if($_SESSION["email"]=="employee"){
    if(isset($_POST["Done"]))
        {
            $sql= $conn -> prepare("UPDATE REPORTS SET STATUS='Done' WHERE COMPLAINT_ID= ?;");
            //echo $sql."     ".$_POST['email'];
            $sql->bind_param("s",$ema);
            $ema=$_POST['cid'];
            $sql->execute();

        }

}
 elseif($_SESSION["Designation"]=="student"){
    header("Location: user.php");
} elseif ($_SESSION["Designation"]=="housekeeping"){
    header("Location: housekeeper.php");
} elseif ($_SESSION["Designation"]=="canteen") {
    header("Location: menuCanteen.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="feed.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>Housekeeping Requests</title>

</head>

<body>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/navbar.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/sidebar.php';
    
    ?>
    <div class='filters' style='background-color: seagreen'>
        <button class='btn btn-primary'></button>
    </div>
    <div id="main">
        <div id="postsarea"></div>
        <div id="loader" class="loader">
            <!-- loading css animation -->
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>
    </div>
    <script>
        var visible = false;

        function toggleNav() {
            if (!visible) {
                document.getElementById("mySidebar").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
            } else {
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("main").style.marginLeft = "0";
            }
            visible = !visible;
        }
    </script>
    <script>
        var state = true;
        var likes = 0;
    </script>
    <script src="reporting.js"></script>
</body>

</html>