<?php
session_start();
require_once dirname(__DIR__) . '/vendor/autoload.php';
use App\Database\UserAccess;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $ua = new UserAccess();
  $user = $ua->authenticateUser($email, $password);

  if ($user) {
    // Start a session and store relevant user information
    $_SESSION["user"] = $user;

    // Redirect to index.php
    header('Location: index.php');
    exit();
  } else {
    echo "Authentication failed. Please check your email and password.";
  }
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
  <div class="bg-dark text-secondary text-center" style="height: 100vh">
    <form action="signin.php" method="post">
      <div class="form-group">
        <label for="emailField" class="form-label">Email address</label>
        <input type="email" class="form-control" id="emailField" placeholder="Enter email" name="email" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password"
          required>
      </div>
      <button type="submit" class="btn btn-primary">Sign in</button>
      <button type="button" class="btn btn-secondary" onClick="window.location = '/signup.php'">Sign up</button>
    </form>
  </div>
</body>

</html>