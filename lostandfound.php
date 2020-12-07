<?php
session_start();
if (!(isset($_SESSION["email"]))) {
    header("Location: login.php");
    exit();
}

require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/dbConnection.php';

    

     $sql="SELECT * FROM user where email='".$_SESSION["email"]."'";
     $result=mysqli_query($conn,$sql);
     $infos=mysqli_fetch_all($result,MYSQLI_ASSOC);
     // print_r($infos);
     $number=$infos[0]["PHONE_NO"];

     // echo $number;

         

   


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

    <title>Lost And Found</title>

</head>

<body>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/navbar.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/sidebar.php';
    
    ?>

    <div id="main">

        <div id="postsarea"></div>
        <div id="loader" class="loader">
            <!-- loading css animation -->
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>
        <style>
            .filters {
                background-color: wheat;
                text-align: center;
                margin-bottom: 40px;
            }

            .fil {
                margin: 20px 30px;
            }
        </style>
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
    <script>
        function reportt(event) {
            var complaint_id = event.currentTarget.name;
            var start = event.currentTarget.value;
            console.log(complaint_id);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "postfocussession.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "complaint_id=" + complaint_id;
            console.log(params);
            xhr.onload = function(event) {
                if (this.status == 200) {
                    console.log(this.responseText);
                    window.location = "reportfalse.php";
                }
            }
            xhr.send(params);

        }

       function focuss(event){
        console.log('<?php echo $number ?>');
        alert("Contact"+ '<?php echo $number ?>');


       }
 
    </script>
    <script src="lostandfound.js"></script>
</body>

</html>