<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: /banco_digital/bank_proj/views/login_form.php');
    exit();
}

// obtem o id e o name do user
$userName = $_SESSION['user_name'];
$userId = $_SESSION['user_id'];
//echo pra saber o caminho absoluto, estava com bastante erros relacionado a caminhos
//echo "Caminho atual: " . __DIR__;
// exibe uma mensagem da sessão, caso exista
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']); // limpa a mensagem após exibir
} else {
    $mensagem = '';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/transfer_form.css">
    <title>Transfer Form</title>
</head>
<body>
    <header class="dashboard-header">
        <div class="header-content">
            <nav>
                <a href="/banco_digital/bank_proj/views/dashboard.php">home</a>
                <a href="/banco_digital/bank_proj/controllers/logout.php">logout</a>
            </nav>
        </div>
    </header>

<?php if ($mensagem): ?>
    <div class="notification"><?= htmlspecialchars($mensagem) ?></div>
<?php endif; ?>

<form action="/banco_digital/bank_proj/index.php" method="post" class="form-container">
    <h2>Transfer Bank</h2>

    <!--sender inputs-->
    <div>
        <input
        type="number"
        name="remetente_id"
        placeholder="Your ID"
        required
        oninput="fetchUserInfo(this.value, 'remetente')" 
        />
        <input
        type="text"
        id="remetente_name"
        placeholder="Sender name"
        readonly
        />
        <input
        type="text"
        id="remetente_saldo"
        placeholder="Sender balance"
        readonly
        />
    </div>

    <!--recipient inputs-->
    <div>
        <input
        type="number"
        name="destinatario_id"
        placeholder="Other ID"
        required
        oninput="fetchUserInfo(this.value, 'destinatario')"
        />
        <input
        type="text"
        id="destinatario_name"
        placeholder="Recipient name"
        readonly
        />
    </div>

    <!--transfer amount-->
    <input
    type="number"
    step="0.01"
    name="valor"
    placeholder="Value transfer"
    required
    />

    <button type="submit">Transfer</button>
</form>

<footer>
    &copy; <?= date('Y') ?> Banco Digital - Todos os direitos reservados.
</footer>
<!--script para autopreencher os campos no form-->
<script>
function fetchUserInfo(userId, type) {
    if (userId !== '') {
        fetch(`/banco_digital/bank_proj/views/fetch_user_info.php?user_id=${userId}`)
        .then(response => response.json())
        .then(data => {
            if (type === 'remetente') {
                document.getElementById('remetente_name').value = data.nome;
                document.getElementById('remetente_saldo').value = `R$ ${data.saldo}`;
            } else {
                document.getElementById('destinatario_name').value = data.nome;
            }
        }).catch(error => console.error('Usuário não encontrado:', error));
    }
}
</script>

</body>
</html>
