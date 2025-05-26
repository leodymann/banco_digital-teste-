<?php
require_once '../models/Database.php';

$pdo = \Models\Database::getConnection();

// procura todos os blocos
$blocos = $pdo->query("SELECT * FROM blocos ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualização da Blockchain</title>
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/blockchain.css">
</head>
<body>
    <header>
        <h1>Visualização da Blockchain</h1>
        <a href="dashboard.php">dashboard</a>
    </header>
    <main class="blockchain-container">
        <?php foreach ($blocos as $bloco): ?>
            <div class="block">
                <h2>Bloco #<?= $bloco['id'] ?></h2>
                <p><strong>Hash:</strong> <?= htmlspecialchars($bloco['hash']) ?></p>
                <p><strong>Prev Hash:</strong> <?= htmlspecialchars($bloco['prev_hash']) ?></p>
                <h3>Transações:</h3>
                <ul>
                <?php
                    // procura todas transações desse bloco
                    $stmt = $pdo->prepare("SELECT * FROM transacoes WHERE bloco_id = ?");
                    $stmt->execute([$bloco['id']]);
                    $transacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($transacoes) === 0) {
                        echo "<li>Nenhuma transação neste bloco.</li>";
                    } else {
                        foreach ($transacoes as $tx) {
                            echo "<li>{$tx['remetente_id']} → {$tx['destinatario_id']} | R$ " . number_format($tx['valor'], 2, ',', '.') . " em {$tx['data_data']}</li>";
                        }
                    }
                ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>
