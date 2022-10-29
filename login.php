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
    echo "Login Here <br>";
  ?>
  <form method="POST" action="home.php">
    Username<input type="text" name="username"><br>
    Password<input type="password" name="password"><br>
    <input type="submit" name="submit" value="SUBMIT VALUES">
  </form>

</body>

</html>