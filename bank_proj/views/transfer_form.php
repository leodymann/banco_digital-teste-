<?php
    //echo "Caminho atual: " . __DIR__;
    if(isset($_SESSION['mensagem'])){
        echo "<div class='notification'>" . $_SESSION['mensagem'] . "</div>";
        unset($_SESSION['mensagem']); // limpa a mensagem apos exibir
    }
?>
<head>
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/style.css"> <!-- Caminho relativo ao arquivo CSS -->
</head>

<!-- inicio do form de transação-->

<form action="index.php" method="post">
    <h2>transfer bank</h2>
<!-- recebe id do user conectado-->
    <input
    type="number"
    name="remetente_id"
    placeholder="your id"
    required
    >
<!-- recebe id do user que irá receber-->
 <input
 type="number"
 name="destinatario_id"
 placeholder="other id"
 required
 >

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