

<?php
    include("./config.php");
    session_start();
    $email=$_SESSION["email"];
     $sql="SELECT * FROM orders where email='".$email."' order by TIMESTAMP desc";
    $result=mysqli_query($conn,$sql);
    $infos=mysqli_fetch_all($result,MYSQLI_ASSOC);
    
   //print_r($result);
    mysqli_free_result($result);
    mysqli_close($conn);
    //print_r($infos);
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
    <div style="border-bottom: 2px solid black;width:700px;text-align:center;">
    <h2 style="color: black;">My Order</h2>
</div>
<div style="padding-bottom: 20px;width:700px"></div>
<div style="width:700px">
    <?php if(sizeof($infos)>0){?>
<div class="row" style="transform:translateX(50px);">
    
    <div class="col-lg-3"><strong><p>Dish-Name</p></strong></div>
    <div class="col-lg-3"><strong><p>Status</p></strong></div>
    <div class="col-lg-3" ><strong><p>QTY</p></strong></div>
    
    
    
</div>
<div>

<?php foreach ($infos as $infoDetail): ?>
<div style="width:700px; border:2px solid black;padding:20px;background-color: orange;border-radius:10px">
<div class="row" style="transform:translateX(40px);">
    
    <div class="col-lg-3"><p><?php echo $infoDetail["DISH_NAME"];?></p></div>
    <?php if($infoDetail["STATUS"]=="Pending"){?>
    <div class="col-lg-3"><p id='<?php echo $infoDetail['DISH_NAME'].'-Price';?>' style="color:red"><?php echo $infoDetail["STATUS"];?></p></div>
<?php } else{?>
     <div class="col-lg-3"><p id='<?php echo $infoDetail['DISH_NAME'].'-Price';?>' style="color:green"><?php echo $infoDetail["STATUS"];?></p></div>
<?php }?>
    <div class="col-lg-3" ><p><?php echo $infoDetail["QUANTITY"];?></p></div>
    
    
</div>
<div class="row">
<div class="col-lg-3" style="transform:translateX(35px);width:70px" id='<?php echo $infoDetail['DISH_NAME'].'-Cost';?>'>
        <strong >Total Cost: </strong><?php echo $infoDetail["PAYMENT_BALANCE"];?>
    </div>
<div class="col-lg-3" style="transform:translateX(45px);">
        <strong >DATE: </strong><?php echo $infoDetail["TIMESTAMP"];?>
    </div>
</div>
</div>
<div style="padding-bottom: 20px;width:700px"></div>
<?php endforeach;?>
<?php } else {?>
    <div align="center">
    <a href="/Uni-Seva/menu.php"><button id="logout" class="btn btn-primary">Place New Order</button></a>
</div>
    <?php } ?>

    
    <?php include("./script.php") ?>





    
</body>
<script >
    
    setTimeout(function(){ window.location.href="http://localhost/Uni-Seva/myOrder.php"; }, 60000);

</script>

</html>