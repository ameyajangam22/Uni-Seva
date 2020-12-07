<?php 
    session_start();
    if (!(isset($_SESSION["email"]))) {
        header("Location: login.php");
        exit();
    }
    require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/dbConnection.php';
    $errors= array ("Incomplete1" => "","Incomplete2" => "","size" => "","Extension" => "");
    if(isset($_POST['submit']))
    {
        $upload_correct = true;
        $imageextension = strtolower(pathinfo($_FILES["dimage"]["name"],PATHINFO_EXTENSION));
        
        if(empty($_POST['dlocation']))
        {
            $errors["Incomplete2"] = "Location missing." ;
        }

        else if(empty($_POST['dcomplaint']))
        {
            $errors["Incomplete1"] = "Complaint missing." ;
        }

        else if ($_FILES["dimage"]["size"] > 2000000) //Checks Image size
        {
            $errors["size"] = "Sorry, your file is too large(Max 2MB).";
            $upload_correct = false;
        } 
        else if($imageextension != "jpg" && $imageextension != "png" && $imageextension != "jpeg" && $_FILES["dimage"]["size"]!==0)// Checks Image Extension 
        {
            $errors["Extension"] = "Sorry, only JPG, JPEG and PNG files are allowed.";
            $upload_correct = false;
        } 
        else
        {
            
            // Check connection
            if (!$conn) 
            {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            
            $sql = $conn -> prepare("INSERT INTO CLEANLINESS (CAPTION,EMAIL, LOCATION , TIMESTAMP ,IMAGE) VALUES (?, ?, ?, ?, ?);");
            $sql->bind_param("sssss",$cap,$email,$loc,$tim,$photo);
            date_default_timezone_set("Asia/Calcutta");
            $current_time = date("Ymd") . date("His");
            $curr_date = substr($current_time, 0, 4) . '-' . substr($current_time, 4, 2) . '-' . substr($current_time, 6, 2);
            $curr_time = substr($current_time, 8, 2) . ':' . substr($current_time, 10, 2) . ':' . substr($current_time, 12, 2);
            $tim = $curr_date . ' ' . $curr_time;
            $cap=$_POST['dcomplaint'];
            $loc=$_POST['dlocation'];
            //$email=$_SESSION["email"];
            $email=$_SESSION["email"];
            //echo file_get_contents($_FILES['dimage']['tmp_name']);
            $photo=NULL;
            if($_FILES["dimage"]["size"]!==0)
            {
                $photo = file_get_contents($_FILES['dimage']['tmp_name']);
            }
            
            $sql->execute();

            mysqli_close($conn);
            // echo "Request Completed";          
            
        }
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="feed.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>S.P.I.N</title>
</head>
<body>
    
     <?php include("./navbar.php"); ?>
    <?php include("./sidebar.php"); ?>



    <div class="blomck">
    <div style="border-bottom: 2px solid black;width:700px;text-align:center;">
    <h2 style="color: black;">HouseKeeping Request</h2>
</div>
    <form action="clean.php" method="POST" enctype="multipart/form-data">
        <label for="location" class="inplabel">Location:</label>
        <div>
            <textarea name="dlocation" cols="70" rows="3" id="location" class="inp" required></textarea>
        </div>
        <?php echo $errors["Incomplete2"]?>
        <label for="complaint" class="inplabel">Complaint:</label>
        <div>
            <textarea name="dcomplaint" cols="70" rows="10" id="complaint" class="inp" required></textarea>
        </div>
        <?php echo $errors["Incomplete1"]?>
        <br>
        <div>
        <label for="image" class="imginplabel">Upload Image:</label>
        <br>
            <input type="file" name="dimage" class="nfc">
        </div>
        <?php echo $errors["size"]?>
        <?php echo $errors["Extension"]?>
        <br>
        <div>
            <input type="submit" class="button" name="submit" value="Register Complaint">
        </div>
        <br>
    </form>
    </div>
</body>
<?php include("./script.php") ?>
</html>