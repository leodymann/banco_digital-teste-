<?php 
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: login_form.php');
    exit();
}

$userName = $_SESSION['user_name'];
$userId = $_SESSION['user_id'];
//futuramente puxarei o saldo tb

require_once '../models/database.php';
require_once '../models/user.php';

use Models\User;

//quebrei a cabeça com essa merda de post e get junto do $_SESSION - vai se fuder crl
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userId = $_POST['user_id'];

    //busca o id do user no banco de dados
    $user = User::findById($userId);

    //verifica se existe e se foi recuperado corretamente
    if($user){
        $saldo = $user['saldo']; //obtem o saldo
        $userName = isset($user['nome']) ? $user['nome'] : "user not found"; //obtem o nome

        //exibo as info do user no front
        $userInfo = [
            'nome' => $userName,
            'saldo' => "your balance $" . number_format($saldo, 2, ',', '.')
        ];
    } else {
        //user nao encontrado
        $userInfo = [
            'nome' => "user not found",
            'saldo' => "not balance"
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>your balance</title>
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/style.css">
    <div class="container-link">
        <a href="/banco_digital/bank_proj/views/dashboard.php">dash</a>
        <a href="/banco_digital/bank_proj/views/transfer_form.php">transfers</a>
        <a href="/banco_digital/bank_proj/controllers/logout.php">logout</a>
    </div>
</head>
<body>
    
    <!-- caminho absoluto pra evitar o envio do get ao inves do post quebrei a cabeça com essa porcaria de erro -->
    <form action="/banco_digital/bank_proj/views/balance_view.php" method="post" class="form-container">
        <h2>search your balance</h2>
        <input
        type="number"
        name="user_id"
        placeholder="enter your id"
        required
        >

        <!--view info + saldo-->
        <div>
            <input
            type="text"
            id="user_name"
            value="<?php echo isset($userInfo) ? $userInfo['nome'] : ''; ?>"
            readonly
            placeholder="Nome do usuário"
            >
        </div>

        <div>
            <input
            type="text"
            id="user_balance"
            value="<?php echo isset($userInfo) ? $userInfo['saldo'] : ''; ?>"
            readonly
            placeholder="Saldo"
            >
        </div>

        <button
        type="submit"
        name="action"
        value="ver_saldo"
        >
        view your balance
        </button>
    </form>
</body>
</html>
