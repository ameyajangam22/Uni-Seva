<?php
session_start();
if (!(isset($_SESSION["email"]))) {
    header("Location: login.php");
    exit();
}

require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/dbConnection.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['submit'])) {
    $stmt = $conn->prepare("insert into lost_and_found(COMPLAINT_ID,EMAIL,TIMESTAMP,STATUS,CATEGORY,LOCATION,IMAGE,RETREIVED_BY) values( ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $complaint_id, $email, $upload_date, $status, $category, $location, $image, $retrieved_by);
    date_default_timezone_set("Asia/Calcutta");
    $current_time = date("Ymd") . date("His");

    $retrieved_by = "None";
    $category = $_POST['category'];
    $stmt2 = $conn->prepare("select count(*) from lost_and_found where complaint_id like ?");
    $stmt2->bind_param("s", $current_time);
    $stmt2->execute();
    $result = $stmt2->get_result();
    $row = $result->fetch_assoc();
    $complaint_id = $current_time . str_pad(($row['count(*)'] + 1), 4, "0", STR_PAD_LEFT);
    $email = $_SESSION['email'];
    $curr_date = substr($current_time, 0, 4) . '-' . substr($current_time, 4, 2) . '-' . substr($current_time, 6, 2);
    $upload_date = $curr_date;
    $status = "lost";
    $location = $_POST['location'];
    $countfiles = count($_FILES['photos']['name']);
    $allowed_ext = array('jpg', 'png', 'jpeg', 'gif');
    $flag = true;
    for ($i = 0; $i < $countfiles; $i++) {
        $ext = strtolower(pathinfo($_FILES['photos']['name'][$i], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed_ext)) {   // if any other extensions is used then the post is not uploaded
            $flag = false;

            break;
        }
    }
    if ($flag) {

        for ($i = 0; $i < $countfiles; $i++) {
            $image = file_get_contents($_FILES['photos']['tmp_name'][$i]);
            // echo " $complaint_id" . " $upload_date";
            $stmt->execute();
            // echo "text";
        }
        header("Location: lostandfound.php");
        exit();
    } else {
        echo "One or more unsupported image type!";
        $type_error = true;
    }
    mysqli_close($conn);
    //for viewing images see load.php
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>load posts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Open+Sans&family=Pacifico&family=Poppins&family=Sacramento&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="feed.css">
    <link rel="stylesheet" href="upload.css">
</head>

<body>
   <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/navbar.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/sidebar.php';
    
    ?>
    <div id="main">
        <div class='top'>

            <!-- <h1 class='title'>S.P.I.N</h1> -->
            <h3>E-services for university students</h3>
            <h1>Report a Lost item</h1>

        </div>

        <div class='mid'>

            <form action="lostfoundupload.php" method="post" , enctype="multipart/form-data">
                <?php
                echo "Reported by " . $_SESSION['email'];
                ?>


        </div>

        <hr>
        <label for="photo">Select a photo (multiple photos allowed) : </label>
        <input type="file" name="photos[]" id="photo" multiple required>
        <hr>
        <br><label for="location">Location</label>
        <input type="text" id="location" style='width:20%;' name="location" required><br>
        <hr>
        <hr>
        <label for="category">Item Category</label>
        <br>
        <input type="radio" id="Electronics" name="category" value="electronics" checked>
        <label for="student">Electronic Item</label><br>
        <input type="radio" id="Personal" name="category" value="Personal">
        <label for="Personal">Personal Item(Wallet/Bottles/Glasses/Pens/etc)</label><br>
        <input type="radio" id="Others" name="category" value="Others">
        <label for="Others">Others</label><br>
        <hr>
        <button class='submit_btn' type='submit' name='submit'> Add Photos</button>
        </form>
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
</body>

</html>