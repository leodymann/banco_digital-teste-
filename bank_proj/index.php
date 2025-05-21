<?php 

use Controllers\BalanceController;
//arquivo principal

//iniciar sessão
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//importei as classes necessarias
use Controllers\TransferController;

//inclui os arquivos MVC
require_once 'models/database.php';
require_once 'models/user.php';
require_once 'models/transaction.php';
require_once 'controllers/transfer_controller.php';
require_once 'controllers/balance_controller.php';

//instanciei o controlador responsavel pelas transfers
$controller = new TransferController();
$balanceController = new BalanceController();

//verificar o metodo de requisição (get ou post)
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['action']) && $_POST['action'] === 'ver_saldo'){
        //caso seja post e o action seja para ver saldo, chamarei o metodo 'balance' do controlador passando os parametrs do form
        $balanceController->showBalance($_POST['id']);
    }else{
        //caso seja post e o action seja para transferencias, chamarei o metodo 'transfer' do controlador passando os parametros do form
        $controller->transfer($_POST['remetente_id'], $_POST['destinatario_id'], $_POST['valor']);
    }
}else{
    //caso seja get, apenas renderizar o formulario de transferencia e a notificacao, caso exista
    require 'views/transfer_form.php';
    require 'views/notifications.php';
}
?>