<?php

use App\Database\TaskAccess;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$taskAccess = new TaskAccess();
$tasks = $taskAccess->findAll();

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
    
    <?php foreach ($tasks as $task): ?>
      <h2><?php echo $task->getTitle(); ?></h2>
      <p><?php echo $task->getDescription(); ?></p>
    <?php endforeach; ?>
  </div>

</body>

</html>
