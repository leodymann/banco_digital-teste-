<?php 
require_once '../models/database.php';
require_once '../models/user.php';

use Models\User;

if(isset($_GET['user_id'])){
    $userId = $_GET['user_id'];
    $user = User::findById($userId);

    if($user){
        echo json_encode([
            'nome' => $user['nome'],
            'saldo' => number_format($user['saldo'], 2, ',', '.')
        ]);
    }else{
        echo json_encode([
            'nome' => 'user not found',
            'saldo' => '0,00'
        ]);
    }
}
?>