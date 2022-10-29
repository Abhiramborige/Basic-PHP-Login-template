<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main Page</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php
  echo "Hello world<br>";
  include 'mysql_connect.php';
  ?>
  <form method="POST" action="register.php">
    Username<input type="text" name="username"><br>
    Password<input type="password" name="password"><br>
    Phone no<input type="text" name="phone" pattern="[0-9]{10}"><br>
    <input type="submit" name="submit_user" value="SUBMIT VALUES">
  </form>
  <?php

  if (isset($_POST['submit_user'])) {
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);
    $phone = $_POST["phone"];
    $sql = "SELECT * FROM reg_user WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
      echo "Please use different Username as one already exists";
    }
    else{
      $sql = "INSERT INTO reg_user values ('$username', '$password', $phone)";
      if (mysqli_query($conn, $sql)) {
        echo "New user record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
    mysqli_close($conn);
  }

  ?>

</body>

</html>