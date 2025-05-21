<?php 
require_once '../controllers/statement_controller.php';

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

// parâmetros da paginação
// pagination parameters
$limit = 5; // number of transactions per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// retorna o id do user conectado e alguns dados do banco de dados
// returns the id of the connected user and some database data
$userId = $_SESSION['user_id'];
$transaction = getUserTransactions($userId, $limit, $offset);

// total transaction count for paging
$totalTransactions = getTransactionCount($userId);
$totalPages = ceil($totalTransactions / $limit);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statemente View</title>
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/statement.css">
</head>
<body>
    <header class="dashboard-header">
        <div class="header-content">
            <h1>transaction statement</h1>
            <nav>
                <a href="dashboard.php">dashboard</a>
                <a href="painel_integridade.php">integrity</a>
                <a href="blockchain_view.php">block</a>
                <a href="balance_view.php">balance</a>
                <a href="deposit_form.php">deposit</a>
                <a href="transfer_form.php">transfer</a>
                <a href="/banco_digital/bank_proj/controllers/logout.php">logout</a>
            </nav>
        </div>
    </header>
    <main class="dashboard-container">
        <?php if (count($transaction) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>date</th>
                        <th>id</th>
                        <th>value</th>
                        <th>hash</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  foreach ($transaction as $transaction): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($transaction['data_data']))?></td>
                            <td><?= htmlspecialchars($transaction['destinatario_id']) ?></td>
                            <td><?= number_format($transaction['valor'], 2, ',', '.')?></td>
                            <td><?= htmlspecialchars($transaction['hash'])?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Paginação -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>">Anterior</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>" <?= $i === $page ? 'class="active"' : '' ?>><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>">Próxima</a>
                <?php endif; ?>
            </div>

        <?php else: ?>
            <p>no transaction found.</p>
       <?php endif?>
    </main>
    <footer class="dashboard-footer">
        <p>© 2025 Digital Bank. All rights reserved.</p>
    </footer>
</body>
</html>
