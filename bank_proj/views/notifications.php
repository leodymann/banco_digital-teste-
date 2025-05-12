<?php 
if(isset($_SESSION['mensagem'])){ //verifica se existe alguma mensagem armazenada
    echo "<div class='notification'>" . $_SESSION['mensagem'] . "</div>"; //exibe a mensagem em uma div com classe notification
    unset($_SESSION['mensagem']); //remove a mensagem da sessão, evitando reexibição
}
?>