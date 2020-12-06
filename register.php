<?php
$errors = array('email' => '');
if (isset($_POST['insert'])) {

  require $_SERVER['DOCUMENT_ROOT'] . '/Uni-Seva/dbConnection.php';


  // Check if the email is unique
  $email_entered = mysqli_real_escape_string($conn, $_POST['email']);
  $sql = "SELECT email from user where email='$email_entered'";
  $email = mysqli_query($conn, $sql);
  $email_from_db = mysqli_num_rows($email);
  if ($email_from_db) {
    $errors['email'] = "This email has already been registered with UNI-SEVA";
  }

  if (!array_filter($errors)) {
    $stmt = $conn->prepare("insert into user (NAME,PHONE_NO,DESIGNATION,PASSWORD,EMAIL) values
        (?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("sssss", $fullname, $phoneno, $designation, $password, $email);
    $fullname = $_POST['name'];
    $phoneno = $_POST['phoneno'];


    $privacy = $_POST['privacy'];
    $designation = $_POST['designation'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $stmt->execute();
    echo "Added details succesfully!";

    mysqli_stmt_close($stmt2);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location:login.php");
    exit();
  }
}
?>
<html>

<head>
  <meta charset="utf-8">
  <title>load data</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Open+Sans&family=Pacifico&family=Poppins&family=Sacramento&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="register.css">
</head>


<div class='top'>

  <h1 class='title'>UNI SEVA</h1>
  <h3>E-services for university students</h3>
  <h1 class='secondTitle'>Sign Up</h1>

</div>

<div class="mid">

  <!--I made labels simpler and concise-->

  <form action="register.php" method="post" , enctype="multipart/form-data" autocomplete="off">
    <label for="Name">Name</label>
    <input type="text" id="name" name="name" required <?php if (isset($_POST["name"])) {
                                                        echo "value=" . $_POST["name"];
                                                      } ?>>
    <hr>
    <label for="phoneno">Phone No.</label>
    <input type="text" id="phoneno" name="phoneno" required <?php if (isset($_POST["phoneno"])) {
                                                              echo "value=" . $_POST["phoneno"];
                                                            } ?>>
    <hr>
    <label for="designation">Designation</label>
    <br>
    <input type="radio" id="student" name="designation" value="student" checked>
    <label for="student">student</label><br>
    <input type="radio" id="employee" name="designation" value="employee">
    <label for="employee">employee</label><br>
    <input type="radio" id="canteen" name="designation" value="canteen">
    <label for="canteen">Canteen</label><br>
    <input type="radio" id="housekeeping" name="designation" value="housekeeping">
    <label for="housekeeping">housekeeping</label><br>
    <hr>

    <label for="email">Email Address</label>
    <input type="email" id="email" name="email" required <?php if (isset($_POST["email"])) {
                                                            echo "value=" . $_POST["email"];
                                                          } ?>>
    <div id='emailError' class='btn-danger' style='width:30%; margin:10px auto;border-radius:10px ;padding:10px'>Email already exists!</div>
    <div class=""><?php echo $errors['email']; ?></div>
    <!--Outputs error-->
    <hr>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" minlength="8" required>
    <hr>
    <hr class='end-hr'>
    <input class='submit_btn' type="submit" value="Insert Details" name="insert" id="insert">

</div>


</form>
</body>
<script>
  $("#usernameError").hide();
  $("#emailError").hide();
  $("#email").on("paste input", function() {
    // console.log($(this).val());
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "email.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    params = 'email=' + $(this).val();
    xhr.onload = function(event) {
      if (this.status == 200) {
        // console.log(this.responseText);
        if (this.responseText == 'exists') {
          $("#insert").prop('disabled', true);
          $('#emailError').show();
        } else {
          $("#insert").prop('disabled', false);
          $('#emailError').hide();
        }
      }
    }
    xhr.send(params);
  });
</script>

</html>