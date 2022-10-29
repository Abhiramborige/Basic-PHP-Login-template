<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="style.css"></head>
<body>
  <?php
    include 'mysql_connect.php';
  ?>

  <?php
  if (isset($_POST['submit'])) {
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);
    $sql = "SELECT * FROM reg_user WHERE username='$username'AND password_hash='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
      echo "Home Page <br>";
  ?>

    <h3>Logged in successfully</h3>
    <h3>User details</h3>
    <table>
      <th>
        <tr>
          <td>Username</td>
          <td>Phone number</td>
        </tr>
      </th>

      <?php
      $sql = "SELECT username, phone FROM reg_user";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          echo "Username: " . $row["username"]. " - Phone number: " . $row["phone"]. "<br>"; 
      ?>
          <tr>
            <td><?php $row["username"]; ?></td>
            <td><?php $row["phone"]; ?></td>
          </tr>
      <?php
        }
      }
      ?>
    </table>
    <form action="./home.php" method="POST">
      <h4>Change password</h4>
      Username <input type="text" name="username"><br>
      Old password<input type="text" name="old"><br>
      New password<input type="password" name="new"><br>
      <input type="submit" name="change_pass" value="Change Password"><br>
    </form>

  <?php }
    else {
      include 'login.php';
  ?>
     <h3>Invalid credentials</h3>
  <?php
  }}

  elseif (isset($_POST['change_pass'])){
    $new=sha1($_POST['new']);
    $old=sha1($_POST['old']);
    $username = $_POST["username"];
    $sql = "SELECT * FROM reg_user WHERE username='$username'AND password_hash='$old'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
      $change_pass = "UPDATE reg_user SET password_hash='$new' WHERE username='$username'AND password_hash='$old'";
      if(mysqli_query($conn, $change_pass)){
        echo "Password updated successfully";
      }
      else{
        echo "Unable to update password";
      }
    }
    else{
      echo "No record found";
    }
    mysqli_close($conn);
  }
  ?>
  
</body>
</html>