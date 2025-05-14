<?php 
session_start();
//chamei as instancias para conexao e funções.
require_once '../models/user.php';
require_once '../models/database.php';
use Models\User;
use Models\Database;

//verificação se o form foi enviado.
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome = $_POST['nome_user'];
    $email = $_POST['email_user'];
    $senha = $_POST['pass_user'];

    $user = new User();
    $resultado = $user->create($nome, $email, $senha);

    if($resultado){
        $_SESSION['mensagem'] = 'user registraded';
        header('Location: ../views/login_form.php');
        exit();
    }else{
        $_SESSION['mensagem'] = 'error, user not registred';
        header('Location: ../views/register_form.php');
        exit();
    }
}

?>