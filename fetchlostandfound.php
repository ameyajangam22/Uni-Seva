<?php
session_start();
if (!(isset($_SESSION["email"]) && isset($_POST['start']))) {
    header("Location:login.php");
    exit();
}
require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/dbConnection.php';


$start = mysqli_real_escape_string($conn, $_POST['start']);
$limit = mysqli_real_escape_string($conn, $_POST['limit']);
$sql = "SELECT COMPLAINT_ID,EMAIL,TIMESTAMP,CATEGORY,LOCATION from lost_and_found ORDER BY COMPLAINT_ID DESC LIMIT $limit OFFSET $start"; //We need to change this query since friends can see their friends posts only
$result = mysqli_query($conn, $sql);

$k = $start;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        echo
            "<div class='posts-style'>
            <div>
            <h5 class='post-username'>" . $row['EMAIL'] . "</h5>
            <p class='post-caption'>Date: " . $row['TIMESTAMP'] . "</p>
            <p class='post-caption'>Category: " . $row['CATEGORY'] . "</p>
            <p class='post-caption'>Location: " . $row['LOCATION'] . "</p>
            </div>
            <ul>
          " .
                "<li>";
        $sql2 = "SELECT IMAGE FROM lost_and_found WHERE COMPLAINT_ID=" . $row['COMPLAINT_ID'];
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
          <div><button onclick='focuss(event)' value=" . $start . " class=' report btn btn btn-danger'>Report</button></div>
          <div><button onclick='focuss(event)' value=" . $start . " class='comment btn btn-success'>Claim</button></div>
          </div>";
        $k += 1;
    }
} else {
    echo "Reached";
}
