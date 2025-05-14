<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: /banco_digital/bank_proj/views/login_form.php');
    exit();
}

$userName = $_SESSION['user_name'];
$userId = $_SESSION['user_id'];
    //echo pra saber o caminho absoluto, estava com bastante erros relacionado a caminhos
    //echo "Caminho atual: " . __DIR__;
    if(isset($_SESSION['mensagem'])){
        echo "<div class='notification'>" . $_SESSION['mensagem'] . "</div>";
        unset($_SESSION['mensagem']); // limpa a mensagem apos exibir
    }
?>
<head>
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/style.css">
    <div class="container-link">
        <a href="/banco_digital/bank_proj/views/dashboard.php">dashboard</a>
        <a href="/banco_digital/bank_proj/controllers/logout.php">logout</a>
    </div>
</head>

<!-- inicio do form de transação-->

<form action="index.php" method="post" class="form-container">
    <h2>transfer bank</h2>
<!-- recebe id do user conectado-->
<div>
    <input
    type="number"
    name="remetente_id"
    placeholder="your id"
    required
    oninput="fetchUserInfo(this.value, 'remetente')"
    >
<!-- exibe nome do user conectado-->
    <input
    type="text"
    id="remetente_name"
    placeholder="sender name"
    readonly>

<!--exibe o saldo-->
    <input
    type="text"
    id="remetente_saldo"
    placeholder="sender balance"
    readonly>
 </div>
<!-- recebe id do user que irá receber-->
<div>
    <input
     type="number"
     name="destinatario_id"
     placeholder="other id"
     required
     oninput="fetchUserInfo(this.value, 'destinatario')"
     >
    <!--exibe name do user final-->
    <input
    type="text"
    id="destinatario_name"
    placeholder="recipient name"
    readonly>
    <!--exibe o saldo o user final kkkk fds a segurança vou mostrar o saldo dos outros-->
    <input
    type="text"
    id="destinatario_saldo"
    placeholder="recipient balance"
    readonly>
</div> 
<!-- recebe o valor da transfer-->
 <input
 type="number"
 step="0.01"
 name="valor"
 placeholder="value transfer"
 required
 >

<!-- confirmar transfer-->
 <button type="submit">transfer</button>
</form>
<script>
    function fetchUserInfo(userId, type) {
        if (userId !== '') {
            fetch(`/banco_digital/bank_proj/views/fetch_user_info.php?user_id=${userId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Erro ao buscar usuário.");
                }
                return response.json();
            })
            .then(data => {
                if (type === 'remetente') {
                    document.getElementById('remetente_name').value = data.nome;
                    document.getElementById('remetente_saldo').value = `R$ ${data.saldo}`;
                } else {
                    document.getElementById('destinatario_name').value = data.nome;
                    document.getElementById('destinatario_saldo').value = `R$ ${data.saldo}`;
                }
            })
            .catch(error => {
                console.error('Usuário não encontrado:', error);
            });
        } else {
            if (type === 'remetente') {
                document.getElementById('remetente_name').value = '';
                document.getElementById('remetente_saldo').value = '';
            } else {
                document.getElementById('destinatario_name').value = '';
                document.getElementById('destinatario_saldo').value = '';
            }
        }
    }
</script>
