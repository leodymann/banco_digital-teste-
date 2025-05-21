<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login_form.php');
    exit();
}
require_once '../models/database.php';
require_once '../models/user.php';
use Models\User;

// obtem o id e o name do user
$userName = $_SESSION['user_name'];
$userId = $_SESSION['user_id'];
$user = User::findById($userId); // função pra buscar id do user no banco

// busca para obter info do user {saldo, nome e email} 
if ($user) { //verifica se as info sao existentes
    $saldo = $user['saldo'];
    $userName = $user['nome'] ?? 'User not found';
    $userEmail = $user['email'] ?? 'Email not found';
} else { //user not found
    $saldo = '0.00';
    $userName = 'User not found';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance View</title>
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/balance_view.css">
</head>
<body>

<header class="dashboard-header">
    <div class="header-content">
        <h1>your balance</h1>
        <nav>
            <a href="/banco_digital/bank_proj/views/dashboard.php">home</a>
            <a href="/banco_digital/bank_proj/views/painel_integridade.php">integrity</a>
            <a href="/banco_digital/bank_proj/views/blockchain_view.php">block</a>
            <a href="/banco_digital/bank_proj/views/deposit_form.php">deposit</a>
            <a href="/banco_digital/bank_proj/views/transfer_form.php">transfer</a>
            <a href="/banco_digital/bank_proj/views/statement_view.php">statement</a>
            <a href="/banco_digital/bank_proj/controllers/logout.php">logout</a>
        </nav>
    </div>
</header>

<main class="balance-main">
    <div class="balance-card">
        <h2>Account Balance</h2>
        <p>$<?php echo number_format($saldo, 2, ',', '.'); ?></p>
        <div class="button-group">
            <button onclick="window.location.href='/banco_digital/bank_proj/views/deposit_form.php'">
                Deposit
            </button>
            <button onclick="window.location.href='/banco_digital/bank_proj/views/transfer_form.php'">
                Transfer
            </button>
        </div>
    </div>
</main>

<footer>
    &copy; <?= date('Y') ?> Banco Digital - Todos os direitos reservados.
</footer>

</body>
</html>