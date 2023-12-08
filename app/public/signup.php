<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
use App\Database\UserAccess;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST["email"];
  $pw = $_POST["password"];
  $address = $_POST["post-address"];
  // Validate password strength
  $uppercase = preg_match('@[A-Z]@', $pw);
  $lowercase = preg_match('@[a-z]@', $pw);
  $number    = preg_match('@[0-9]@', $pw);
  $specialChars = preg_match('@[^\w]@', $pw);
  $codeInject = preg_match('@[<>";]@' ,$email);

  $ua = new UserAccess();
  if ($codeInject) {
    echo 'Invalid characters in email';
  }else if($uppercase && $lowercase && $number && $specialChars && strlen($pw) >= 8) {
      echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
  } else if (!$ua->checkPassword($pw)) {
    echo "password too insecure";
  } else{
    $ua = new UserAccess();
    $ua->addUser($email, $pw, $address);
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
  <div height: "100vh">
    <form action="signup.php" method="post">
      <div class="form-group">
        <label for="emailField" class="form-label">Email address</label>
        <input type="email" class="form-control" id="emailField" placeholder="Enter email" name="email" required>
        <div class="invalid-feedback">
          Please write your email.
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password"
          required>
      </div>
      <div class="form-group">
        <label for="post-address" class="form-label">Post Address</label>
        <input type="text" class="form-control" id="post-address" placeholder="Post Address" name="post-address"required>
        <div class="invalid-feedback">
          Please write your postal address.
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Sign up</button>
      <button type="button" class="btn btn-secondary" onClick="window.location = '/signin.php'">Sign in</button>
    </form>
  </div>
</body>

</html>
