<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login_form.php');
    exit();
}
require_once '../models/database.php';
require_once '../models/user.php';
use Models\User;

// obtem id e o name do user
$userName = $_SESSION['user_name'];
$userId = $_SESSION['user_id'];
$user = User::findById($userId); // função para busca o id

// busca para obter info do user {saldo, nome e email} 
if ($user) {
    $saldo = $user['saldo'];
    $userName = $user['nome'] ?? 'User not found';
    $userEmail = $user['email'] ?? 'Email not found';
} else {
    $saldo = '0.00';
    $userName = 'User not found';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/dashboard.css">
</head>
<body>
    <header class="dashboard-header">
        <div class="header-content">
            <h1>welcome, @<?php echo htmlspecialchars($userName);
 ?>!</h1>
            <nav>
                <a href="statement_view.php">statement</a>
                <a href="deposit_form.php">deposit</a>
                <a href="transfer_form.php">transfer</a>
                <a href="/banco_digital/bank_proj/views/balance_view.php">balance</a>
                <a href="/banco_digital/bank_proj/controllers/logout.php">logout</a>
            </nav>
        </div>
    </header>

    <main class="dashboard-main">
        <div class="card balance-card">
            <h2>account balance</h2>
            <p>$<?php echo number_format($saldo, 2, ',', '.'); ?></p>
        </div>
        <div class="card info-card">
            <h2>user information</h2>
            <p><strong>name - </strong> <?php echo $userName; ?></p>
            <p><strong>email - </strong> <?php echo $userEmail; ?></p>
        </div>
    </main>

    <footer class="dashboard-footer">
        <p>© 2025 Digital Bank. All rights reserved.</p>
    </footer>

</body>
</html>
