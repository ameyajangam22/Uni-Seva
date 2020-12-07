

<?php
    include("./config.php");
    session_start();

    if(isset($_GET["userInfo"])){


    $email=$_GET["userInfo"];
    
     $sql="SELECT * FROM user where email='".$email."'";
     $result=mysqli_query($conn,$sql);

      $infos=mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    
   //print_r($result);

    
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
    <?php include("./slidebar.php"); ?>
    <div style="border-bottom: 2px solid black;width:700px;text-align:center;">
    <!-- <a href="/uniSeva/menuCanteen.php"><button   id="logout" class="btn btn-primary" style="transform: translate(-270px,-7px);" onclick='addItem("<?php echo $infoDetail['DISH_NAME'];?>");'>BACK</button></a> -->
    <h2 style="color: black;">Contact</h2>
</div>
<div style="padding-bottom: 20px;width:700px"></div>
<div align="center" style="background-color: orange">
    <div style="border:2px solid grey;max-width: 800px;padding-bottom: 40px;padding-top: 40px;width:500px">
        
            <div >
            <label>E-mail :</label>
           <?php echo $infos[0]["EMAIL"]?>
            <div style="color:red;"> </div><br>
        </div>
            <div>
            <label>Name:</label>
            <?php echo $infos[0]["NAME"]?>

        </div>
        <div>
            <label>Designation:</label>
            <?php echo $infos[0]["DESIGNATION"]?>
            
        </div>
        <div>
            <label>Phone-No:</label>
            <?php echo $infos[0]["PHONE_NO"]?>
            
        </div>
            
        
    </div>
</div>


    
    <?php include("./script.php") 
    // value="<?php echo $email?>
   

   





    
</body>

</html>