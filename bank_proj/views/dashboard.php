<?php 
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: login_form.php');
    exit();
}

$userName = $_SESSION['user_name'];
$userId = $_SESSION['user_id'];
//futuramente puxarei o saldo tb
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/style.css">
</head>
<body>
    <div class="container-link">
        <a href="/banco_digital/bank_proj/index.php">home</a>
        <a href="/banco_digital/bank_proj/controllers/logout.php">logout</a>
    </div>
    <h1 class="h1_dash">welcome</h1>
    <p>user @<?php echo $userName; ?></p>
</body>
</html>