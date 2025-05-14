<?php 

use Controllers\DepositController;
use Models\User;

//verifica se o user esta logado na sessão
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /banco_digital/bank_proj/views/login_form.php");
    exit();
}
require_once '../models/database.php';
require_once '../models/user.php';
require_once '../controllers/deposit_controller.php';

$depositController = new DepositController();
$feedbackMessage = "";
$transactionHash = "";

//obtendo o id do user pela session
$userId = $_SESSION['user_id'];
//buscando o user no banco de dados
$user = User::findById($userId);


//parte de processar o deposit
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valor']) && is_numeric($_POST['valor'])){
    $valor = (float)$_POST['valor'];
    //realiza o deposit
    $transactionHash = $depositController->deposit($userId, $valor);
    //mensagem apos o success do deposit
    if($transactionHash){
        //salva o saldo na sessão
        $_SESSION['saldo'] = $user['saldo']; //aqui puxa o saldo atual
        //mensagem basica
        $_SESSION['feedbackMessage'] = "deposit successful. hash: $transactionHash";
        //redireciona para evitar reenvio do form
        header("Location: deposit_form.php");
        exit();
    }else{
        $_SESSION['feedbackMessage'] = "deposit failed";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/style.css">
    <div class="container-link">
        <a href="/banco_digital/bank_proj/views/dashboard.php">dashboard</a>
        <a href="/banco_digital/bank_proj/controllers/logout.php">logout</a>
    </div>
</head>
<body>
    <form action="deposit_form.php" method="post" class="form-container">
    <h2>inform the deposit amount</h2>
    <input
        type="number"
        step="0.01"
        name="valor"
        placeholder="enter your value deposit $"
        required
    >
    <input
    type="text"
    id="user_balance"
    value="<?php echo isset($_SESSION['saldo']) ? 'your balance $' . number_format($_SESSION['saldo'], 2, ',', ',') : 'balance not availabre'; ?>"
    readonly
    placeholder="your balance">
        <!--view info + saldo-->

    <button
        type="submit"
        name="action"
        value="make_deposit"
    >
            make your deposit
        </button>
    </form>
</body>
</html>