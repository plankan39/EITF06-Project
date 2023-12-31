<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
session_start();

$totalPrice = array_reduce(
  $_SESSION["cart"],
  function ($sum, $item) {
    return $sum + $item["item"]->getPrice() * $item["amount"];
  },
  0
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Confirm Payment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <div class="bg-dark text-secondary text-center" style="height: 100vh">
    <div class="container">
      <h1>Confirm Payment</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Item</th>
            <th scope="col">Amount</th>
            <th scope="col">Item Price</th>
            <th scope="col">Total Price</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($_SESSION["cart"] as $itemId => $cartItem): ?>
            <tr>
              <th scope="row">
                <?php echo $cartItem["item"]->getId(); ?>
              </th>
              <td>
                <?php echo $cartItem["item"]->getName(); ?>
              </td>
              <td>
                <?php echo $cartItem["amount"] ?>
              </td>
              <td>
                <?php echo $cartItem["item"]->getPrice(); ?>
              </td>
              <td>
                <?php echo $cartItem["amount"] * $cartItem["item"]->getPrice(); ?>
              </td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <th scope="row">Total </th>
            <td></td>
            <td></td>
            <td></td>
            <td>
              <?php echo $totalPrice; ?>
            </td>
          </tr>
          <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["paymentInfo"]) {
            echo '
            <tr>
              <th scope="row">Payment hash </th>
              <td>' .
              $_POST["paymentInfo"] .
              '</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>';
          }
          ?>
        </tbody>
      </table>
      <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["paymentInfo"]) {
        echo '<h2>Thank you for your purchase</h2>';
      } else {
        echo '
        
        <h2>Please submit a payment of ' . $totalPrice .
          ' SimpleCoin to the following address</h2>';
      }
      ?>
      <form action="confirmpayment.php" method="post">
        <div class="mb-3">
          <label for="paymentInfo" class="form-label">Our public key:
            OsGUOWtF/E+1O3gwhOW70uDMzJAi0dAm4LWz9ZNHhBYu3t77w1izC0wS5w72IZ476/YiOmp49b+HYFI39c++eg==</label>
          <input type="text" class="form-control" id="paymentInfo" name="paymentInfo" placeholder="Enter hash here">
        </div>
        <button type="submit" class="btn btn-primary">Confirm</button>
      </form>
    </div>
  </div>
</body>

</html>