

<?php
    include("./config.php");
    session_start();

    if($_SESSION["Designation"]=="canteen"){



     $sql='SELECT * FROM menu';
     $result=mysqli_query($conn,$sql);
    $infos=mysqli_fetch_all($result,MYSQLI_ASSOC);
    
   //print_r($result);
    mysqli_free_result($result);
    mysqli_close($conn);
    //print_r($infos);
    } elseif($_SESSION["Designation"]=="student"){
        header("Location: user.php");
    } elseif ($_SESSION["Designation"]=="employee"){
        header("Location: report.php");
    } elseif ($_SESSION["Designation"]=="housekeeping") {
        header("Location: housekeeper.php");
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
    <div style="border-bottom: 2px solid black;width:700px;text-align:center;">
    <a href="/Uni-Seva/addItem.php"><button   id="logout" class="btn btn-primary" style="transform: translate(-270px,-7px);" onclick='addItem("<?php echo $infoDetail['DISH_NAME'];?>");'>ADD</button></a>
    <h2 style="color: black;">MENU</h2>
</div>
<div style="padding-bottom: 20px;width:700px"></div>
<div style="width:700px">
<div class="row" style="transform:translateX(50px);">
    
    <div class="col-lg-3"><strong><p>Dish-Name</p></strong></div>
    <div class="col-lg-3"><strong><p>Price</p></strong></div>
 
    
    
</div>
<div>
<?php foreach ($infos as $infoDetail): ?>
<div style="width:700px; border:2px solid black;padding:20px;background-color: orange;border-radius:10px">
<div class="row" style="transform:translateX(40px);">
    
    <div class="col-lg-3"><p><?php echo $infoDetail["DISH_NAME"];?></p></div>
    <div class="col-lg-2" id='<?php echo $infoDetail['DISH_NAME'].'-PriceDiv';?>'><p id='<?php echo $infoDetail['DISH_NAME'].'-Price';?>'><?php echo $infoDetail["PRICE"];?></p></div>
    <div class="col-lg-3" style="transform:translateY(-8px);" id='<?php echo $infoDetail['DISH_NAME'].'-Div1';?>'><button   id="logout" class="btn btn-primary" onclick='editItem("<?php echo $infoDetail['DISH_NAME'];?>")' >Update</button></div>
   
    <div class="col-lg-3" style="transform:translateY(-8px);" id='<?php echo $infoDetail['DISH_NAME'].'-Div2';?>'><button   id="logout" class="btn btn-primary" style="background-color:red;" onclick='deleteItem("<?php echo $infoDetail['DISH_NAME'];?>");'>Delete</button></div>
</div>

</div>
<div style="padding-bottom: 20px;width:700px"></div>
<?php endforeach;?>

    
    <?php include("./script.php") ?>

    <script >
        var deleteItem=function(test){

            console.log(test);

            let url="/Uni-Seva/deleteItem.php?DISH_NAME="+test;
            fetch(url).then(response=>response.json())
            .then(result=>{
                console.log(result);
                window.location.href="http://localhost/Uni-Seva/menuCanteen.php";
            })


        }

        var temp={};
        var editItem=function(test){

            console.log(test);
            let div1=test+"-Div1";
            let div2=test+"-Div2";
            let PriceDiv=test+"-PriceDiv";
            let price=test+"-Price";
            let valuePrice=eval(document.getElementById(price).innerHTML);
            temp[test]=document.getElementById(PriceDiv).innerHTML;

            document.getElementById(PriceDiv).innerHTML="<input style='width:80%' type='number' placeholder='"+valuePrice+"' id='"+test+"-newPrice'>";


            document.getElementById(div1).innerHTML="<button   id='logout' class='btn btn-primary' onclick='SaveItem("+'"'+test+'"'+");'>Save</button>";
            document.getElementById(div2).innerHTML="<button   id='logout' class='btn btn-primary'   onclick='CancelItem("+'"'+test+'"'+");'>Cancel</button>";




        }


        var SaveItem=function(test){


            console.log(test);
            let newPrice=test+"-newPrice";
            console.log(document.getElementById(newPrice).value);
            let newValue=document.getElementById(newPrice).value;



            let url="/Uni-Seva/updateItem.php?DISH_NAME="+test+"&&price="+newValue;
            fetch(url).then(response=>response.json())
            .then(result=>{
                console.log(result);
                window.location.href="http://localhost/Uni-Seva/menuCanteen.php";
            })





        }

        var CancelItem=function(test){

            console.log(test);
            let div1=test+"-Div1";
            let div2=test+"-Div2";
            let PriceDiv=test+"-PriceDiv"

            document.getElementById(div1).innerHTML="<button   id='logout' class='btn btn-primary' onclick='editItem("+'"'+test+'"'+");'>Update</button>";
            document.getElementById(div2).innerHTML="<button   id='logout' class='btn btn-primary' style='background-color:red;' onclick='deleteItem("+'"'+test+'"'+");'>Delete</button>";

            document.getElementById(PriceDiv).innerHTML=temp[test];

        }


    </script>





    
</body>

</html>