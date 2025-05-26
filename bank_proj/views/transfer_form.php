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
            <h1>transfer</h1>
            <nav>
                <a href="/banco_digital/bank_proj/views/dashboard.php">dashboard</a>
                <a href="/banco_digital/bank_proj/views/painel_integridade.php">integrity</a>
                <a href="/banco_digital/bank_proj/views/blockchain_view.php">block</a>
                <a href="/banco_digital/bank_proj/views/statement_view.php">statement</a>
                <a href="/banco_digital/bank_proj/views/balance_view.php">balance</a>
                <a href="/banco_digital/bank_proj/views/deposit_form.php">deposit</a>
                <a href="/banco_digital/bank_proj/controllers/logout.php">logout</a>
            </nav>
        </div>
    </header>

<?php if ($mensagem): ?>
    <div class="notification"><?= htmlspecialchars($mensagem) ?></div>
<?php endif; ?>

<form action="/banco_digital/bank_proj/index.php" method="post" class="form-container" id="transferForm">
    <h2>Transfer Bank</h2>

    <div>
        <input 
            type="number" 
            name="remetente_id" 
            value="<?= $userId ?>" 
            readonly 
        />
        <input 
            type="text" 
            id="remetente_name" 
            placeholder="Sender name" 
            value="<?= $userName ?>" 
            readonly 
        />
    </div>

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

    <input 
        type="number" 
        step="0.01" 
        name="valor" 
        placeholder="Value transfer" 
        required
    />

    <button 
        type="button" 
        onclick="confirmTransfer()">
        Confirmar Transferência
    </button>

    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <h3>Confirmar Transferência</h3>
            <p id="confirmText"></p>
            <button 
                onclick="submitForm()">
                Confirmar
            </button>
            <button 
                type="button" 
                onclick="closeModal()">
                Cancelar
            </button>
        </div>
    </div>
</form>
<footer>
    &copy; <?= date('Y') ?> Banco Digital - Todos os direitos reservados.
</footer>
<!-- Função para abrir pág. modal e confirmar/cancelar a transação -->
<script>
function fetchUserInfo(userId, type) {
    if (userId !== '') {
        fetch(`/banco_digital/bank_proj/views/fetch_user_info.php?user_id=${userId}`)
        .then(response => response.json())
        .then(data => {
            if (type === 'destinatario') {
                document.getElementById('destinatario_name').value = data.nome;
            }
        }).catch(error => console.error('Usuário não encontrado:', error));
    }
}
//confirma a transação pelo modal
function confirmTransfer() {
    const recipientName = document.getElementById('destinatario_name').value;
    const amount = document.querySelector('input[name="valor"]').value;
    if (recipientName && amount) {
        document.getElementById('confirmText').innerText = `Deseja transferir R$ ${amount} para ${recipientName}?`;
        document.getElementById('confirmModal').style.display = 'block';
    }
}

document.getElementById('confirmModal').style.display = 'none';
//cancela a transfer e fecha o modal
function closeModal() {
    document.getElementById('confirmModal').style.display = 'none';
}

function submitForm() {
    document.getElementById('confirmModal').style.display = 'none';
    document.getElementById('transferForm').submit();
}
//proibe o envio do form ao apertar enter
document.getElementById('transferForm').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // cancela o envio
    }
});
</script>
</body>
</html>
