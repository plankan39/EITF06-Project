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
            <form action="process_payment.php" method="post">
                <div class="mb-3">
                    <label for="paymentInfo" class="form-label">Our public key: OsGUOWtF/E+1O3gwhOW70uDMzJAi0dAm4LWz9ZNHhBYu3t77w1izC0wS5w72IZ476/YiOmp49b+HYFI39c++eg==</label>
                    <input type="text" class="form-control" id="paymentInfo" name="paymentInfo" placeholder="Enter hash here">
                </div>
                <button type="submit" class="btn btn-primary">Confirm</button>
            </form>
        </div>
    </div>
</body>

</html>
