
<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
use App\Database\UserAccess;


if($_SERVER["REQUEST_METHOD"] === "POST"){
  $email = $_POST["email"];
  $pw = $_POST["password"];

  $ua = new UserAccess();
  $ua -> addUser($email, $pw);
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Web shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <form action="signup.php" method="post">
    <label>email</label>
    <input type="text" name="email">
    <label>password</label>
    <input type="password" name="password">
    
    <input type="submit" value="Sign up">
  </form>
</body>

</html>
