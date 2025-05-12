<?php 
//arquivo principal

//iniciar sessão
session_start();

//importei as classes necessarias
use Controllers\TransferController;

//inclui os arquivos mvc
require_once 'models/database.php';
require_once 'models/user.php';
require_once 'models/transaction.php';
require_once 'controllers/transfer_controller.php';

//instanciei o controlador responsavel pelas transfers
$controller = new TransferController();

//verificar o metodo de requisição (get ou post)
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //caso seja post, chamarei o metodo 'transfer' do controlador passando os paramentros do formulario
    $controller->transfer($_POST['remetente_id'], $_POST['destinatario_id'], $_POST['valor']);
}else{
    //caso seja get, apenas renderizar o formulario de transferencia e a notificacao, caso exista
    require 'views/transfer_form.php';
    require 'views/notifications.php';
}
?>