<?php
session_start();

require_once __DIR__ . '/../models/Database.php';
use Models\Database;

//calcula o hash de acordo com as transações existentes no bloco
function calcularHashDoBloco($blocoId, $pdo) {
    //procura todos os hashes das transações existentes no bloco
    $stmt = $pdo->prepare("SELECT hash FROM transacoes WHERE bloco_id = ? ORDER BY id");
    $stmt->execute([$blocoId]);
    // extrai apenas os valores de hash em um array
    $hashes = $stmt->fetchAll(PDO::FETCH_COLUMN);
    // junta todos os hashes das transações em uma única string
    $conteudo = implode('', $hashes);
    //calcula o hash da string anterior
    return hash('sha256', $conteudo);
}

$pdo = Database::getConnection();
$stmt = $pdo->prepare("SELECT * FROM blocos ORDER BY id ASC");
$stmt->execute();
$blocos = $stmt->fetchAll(PDO::FETCH_ASSOC); //armazena os blocos em um array associativo

$integridade_ok = true; // flag para saber se está tudo ok
$resultados = []; // armazena o result individuais de cada block

for ($i = 0; $i < count($blocos); $i++) {
    $bloco_atual = $blocos[$i]; // loop atual do bloco
    // recalcula o hash do bloco com base nas transações associadas
    $hash_recalculado = calcularHashDoBloco($bloco_atual['id'], $pdo);
    // verifica se o hash está realmente correto
    $hashOk = ($hash_recalculado === $bloco_atual['hash']);

    // verifica se o hash anterior está correto (exceto no primeiro bloco)
    $prevHashOk = true;
    if ($i > 0) {
        $bloco_anterior = $blocos[$i - 1];
        $prevHashOk = ($bloco_atual['prev_hash'] === $bloco_anterior['hash']);
    }
    // se algum teste falhou, marca a integridade geral como falsa
    if (!$hashOk || !$prevHashOk) {
        $integridade_ok = false;
    }
    // adiciona os dados do bloco e resultados da verificação no array final
    $resultados[] = [
        'id' => $bloco_atual['id'],
        'hash_ok' => $hashOk,
        'prev_hash_ok' => $prevHashOk,
        'hash' => $bloco_atual['hash'],
        'prev_hash' => $bloco_atual['prev_hash'] ?? '',
    ];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/integritypanel.css">
</head>
<body>
    <header class="dashboard-header">
        <div class="header-content">
            <h1>Integrity Panel Verify</h1>
            <nav>
                <a href="/banco_digital/bank_proj/views/dashboard.php">dashboard</a>
                <a href="statement_view.php">statement</a>
                <a href="deposit_form.php">deposit</a>
                <a href="transfer_form.php">transfer</a>
                <a href="/banco_digital/bank_proj/views/balance_view.php">balance</a>
                <a href="/banco_digital/bank_proj/controllers/logout.php">logout</a>
            </nav>
        </div>
    </header>

<?php if ($integridade_ok): ?>
    <p style="color: green; font-weight: bold;">All blocks are intact!</p>
<?php else: ?>
    <p style="color: red; font-weight: bold;">Integrity failures were found.</p>
<?php endif; ?>

<?php if (isset($_SESSION['user']) && $_SESSION['user']['is_admin']): ?>
    <?php if (isset($_GET['reparado'])): ?>
        <p style="color: blue; font-weight: bold;">
            Repaired successfully! Fixed blocks: <?= htmlspecialchars($_GET['reparado']) ?>
        </p>
    <?php endif; ?>

    <form action="/banco_digital/bank_proj/repair_hashes.php" method="post" onsubmit="return confirm('Tem certeza que deseja reparar os hashes dos blocos?');">
        <button type="submit" class="btn-reparar">Repair Hashes</button>
    </form>
<?php else: ?>
    <p style="color: red;">Restricted access: Only administrators can repair blocks.</p>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>block</th>
            <th>block hash</th>
            <th>correct?</th>
            <th>previous hash</th>
            <th>correct?</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($resultados as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r['id']) ?></td>
            <td><?= htmlspecialchars($r['hash']) ?></td>
            <td class="<?= $r['hash_ok'] ? 'ok' : 'fail' ?>">
                <?= $r['hash_ok'] ? '✔' : '✘' ?>
            </td>
            <td><?= htmlspecialchars($r['prev_hash']) ?></td>
            <td class="<?= $r['prev_hash_ok'] ? 'ok' : 'fail' ?>">
                <?= $r['prev_hash_ok'] ? '✔' : '✘' ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<footer>
    &copy; <?= date('Y') ?> Banco Digital - Todos os direitos reservados.
</footer>
</body>
</html>
