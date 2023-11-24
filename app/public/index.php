<?php
session_start();

if (!isset($_SESSION["user"])) {
  header('Location: signin.php');
  exit();
}

use App\Database\ItemAccess;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$itemAccess = new ItemAccess();
$items = $itemAccess->findAll();

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
    <h1>Tasks</h1>
    
    <?php foreach ($items as $item): ?>
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="..." alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title"><?php echo $item->getName(); ?></h5>
          <p class="card-text"><?php echo $item->getDescription(); ?></p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
          <form action="index.php", method="post">
            <button class="btn btn-primary" type="submit" name="itemId" value=<?php echo $item->getId(); ?>>Add to cart</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["itemId"]) {
  if (!array_key_exists("cart", $_SESSION)) {
    $_SESSION["cart"] = array();
  }
  $itemId = $_POST["itemId"];

  if (!array_key_exists($itemId, $_SESSION["cart"])) {
    $_SESSION["cart"][$itemId] = 0;
  }

  $_SESSION["cart"][$itemId]++;

  foreach ($_SESSION["cart"] as $key => $value) {
    echo $key . ": " . $value . "<br>";
  }
}


?>

</body>

</html>
