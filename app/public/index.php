<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use App\Database\ItemAccess;
session_start();

if (!isset($_SESSION["user"])) {
  header('Location: signin.php');
  exit();
}




$itemAccess = new ItemAccess();
$items = $itemAccess->findAll();

if (!isset($_SESSION["cart"])) {
  $_SESSION["cart"] = array();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["itemId"]) {
  $itemId = (int) $_POST["itemId"];

  $matches = array_filter($items, function($it) use($itemId) {
    return $it->getId() === $itemId;
  });
  $choosenItem = array_pop($matches);

  if (!array_key_exists($itemId, $_SESSION["cart"])) {
    $_SESSION["cart"][$itemId] = array("item"=>$choosenItem, "amount"=>0);
  }

  $_SESSION["cart"][$itemId]["amount"]++;

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
      <div class="row">
        <p>Welcome, <?php echo isset($_SESSION["user"])?$_SESSION["user"]->getEmail():"" ?>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <h1>Webshop</h1>
          <?php foreach ($items as $item): ?>
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="..." alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><?php echo $item->getName(); ?></h5>
                <p class="card-text"><?php echo $item->getDescription(); ?></p>
                <p class="card-text"><?php echo $item->getPrice(); ?></p>
                <form action="index.php", method="post">
                  <button class="btn btn-primary" type="submit" name="itemId" value=<?php echo $item->getId(); ?>>Add to cart</button>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="col-sm-4">
          <h2>Cart</h2>
          <ul class="list-group">

          <?php foreach ($_SESSION["cart"] as $itemId => $cartItem): ?>
          <li class='list-group-item'>
            <?php echo $cartItem["item"]->getName() . "(" . $cartItem["amount"] . "): " . $cartItem["amount"] * $cartItem["item"]->getPrice() . "kr"?>
          </li>
          <?php endforeach; ?>
          </ul>
        </div>
      </div>
  </div>


</body>

</html>
