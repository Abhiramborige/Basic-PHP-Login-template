<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Password Reset</title>
</head>
<body>
  <?php
    include 'mysql_connect.php';
    function generate_password($length){
      $password='';
      $set_of_alpha="ABCDEFGHIJKLM";
      for ($i=0; $i<$length/2; $i++) { 
        $password.=rand(1,9);
      }
      for ($i=0; $i<$length/2; $i++) {
        $password.=$set_of_alpha[rand(0,strlen($set_of_alpha)-1)];
      }
      return $password;
    }
  ?>

  <form action="password_reset.php" method="POST">
    Username:<input type="text" name="username" /><br>
    Phonenumber:<input type="number" name="phone" /><br>
    <input type="submit" name="submit" value="Reset password" /><br>
  </form>

  <?php
    $user='';
    $password='';
    if (isset($_POST['submit'])) {
      $user.=$_POST['username'];
      $phone=$_POST['phone'];
      $sql = "SELECT * FROM reg_user WHERE username='$user'AND phone='$phone'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0){
        $password=generate_password(rand(10,20));
        echo "Your new generated password is: $password<br>Shall we modify or generate again?<br>";
        echo "
        <button onclick='window.location.reload();'>
          Generate again
        </button><br>
        <form action='password_reset.php' method='POST'>
          <button name='submit_password'>Submit</button><br>
          <input type='text'  name='username' value='$user'/>
          <input type='text'  name='password' value='$password'/>
        </form>";
      }
      else{
        echo "Not found, try again!<br>";
      }
    }
    elseif (isset($_POST['submit_password'])) {
      $password=sha1($_POST['password']);;
      $user=$_POST['username'];
      $sql = "UPDATE reg_user SET password_hash='$password' WHERE username='$user';";
      echo $sql;
      if (mysqli_query($conn, $sql)) {
        echo "<br>Record updated successfully";
      } else {
        echo "<br>Error updating record: " . mysqli_error($conn);
      }
    }
    mysqli_close($conn);
  ?>
</body>
</html>