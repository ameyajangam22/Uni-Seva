<?php
session_start();
if (!(isset($_SESSION["email"]))) {
    header("Location:login.php");
    exit();
}
require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/dbConnection.php';
if (isset($_POST['repsubmit'])) {
    $stmt = $conn->prepare("insert into reports(REPORT_ID,ACCUSER_EMAIL,COMPLAINT_ID,EXPLANATION) values( ?, ?, ?, ?)");
    $stmt->bind_param("ssss", $report_id, $email, $complaint_id, $explanation);
    $stmt2 = $conn->prepare("select count(REPORT_ID) from reports");
    $stmt2->execute();
    $result = $stmt2->get_result();
    $row = $result->fetch_assoc();
    $report_id = $row['count(REPORT_ID)'] + 1;
    $email = $_SESSION['email'];
    $complaint_id = $_SESSION['complaint_id'];
    $explanation = mysqli_real_escape_string($conn, $_POST['report']);
    $stmt->execute();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/spin/home/feed.css">
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/navbar.php';
require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/sidebar.php';

$complaint_id = $_SESSION['complaint_id'];
$sql = "SELECT EMAIL,TIMESTAMP,CATEGORY,LOCATION from lost_and_found where COMPLAINT_ID =$complaint_id";
$result = mysqli_query($conn, $sql);
$k = 0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        echo

            "<div id='reportarea'>
            <div  class='posts-style'>
            <div>
            <h5 class='post-username'>" . $row['EMAIL'] . "</h5>
            <p class='post-caption'>Date: " . $row['TIMESTAMP'] . "</p>
            <p class='post-caption'>Category: " . $row['CATEGORY'] . "</p>
            <p class='post-caption'>Location: " . $row['LOCATION'] . "</p>
            </div>
            <ul>
          " .
                "<li>";
        $sql2 = "SELECT IMAGE FROM lost_and_found WHERE COMPLAINT_ID=" . $complaint_id;
        $result2 = mysqli_query($conn, $sql2);

        echo
            '<div id="carousel' . $k . '" class="carousel slide" data-interval="false" data-wrap="false">
                <ol class="carousel-indicators">';
        if (mysqli_num_rows($result2) > 1) {
            for ($i = 0; $i < mysqli_num_rows($result2); $i++) {
                echo "<li data-target='#carousel$k' data-slide-to='" . ($i + 1) . "'";
                if ($i == 0) {
                    echo " class='active'";
                }
                echo "></li>";
            }
        }
        echo
            '</ol>
            <div class="carousel-inner">';
        $j = 0;
        while ($row2 = mysqli_fetch_assoc($result2)) {
            echo '<div class="carousel-item';
            if ($j == 0) {
                echo " active";
                $j += 1;
            }
            echo '">
                <img src="data:image/jpeg;charset=utf8;base64,' . base64_encode($row2['IMAGE']) . '" class="d-block" height=300 style="margin:auto;"/>
                </div>';
        }
        echo '</div>';

        echo '</div>';

        echo
            "</li>
          </ul>
          </div></div>";
        $k += 1;
    }
?>
    <link rel="stylesheet" href="feed.css">
    <form action="reportfalse.php" method='post' enctype="multipart/form-data">
        <textarea style='margin-top:20px;margin-bottom:20px;' name="report" id="report" cols="70" rows="10" placeholder="Write your report here (MAX 1000 CHARACTERS)" required></textarea>
        <input id='submit-report' type="submit" name="repsubmit" style='margin-bottom:20px;'>
    </form>


<?php
} else {
    echo "Reached";
}
?>
<script>
    var visible = false;

    function toggleNav() {
        if (!visible) {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("reportarea").style.marginLeft = "250px";
        } else {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("reportarea").style.marginLeft = "0";
        }
        visible = !visible;
    }
</script>
<script>
    var state = true;
    var likes = 0;
</script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>