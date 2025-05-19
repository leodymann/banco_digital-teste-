<?php 
session_start();
require_once '../models/user.php';
use Models\User;


//verifica se o form foi enviado corretamente
//checks if the form was submitted correctly
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "method is post.<br>";

    // verifica os valores recebidos
    // checks the received values
    if (isset($_POST['email_user']) && isset($_POST['pass_user'])) {
        $email = $_POST['email_user'];
        $senha = $_POST['pass_user'];

        echo "data received - Email: $email, Senha: [OCULTA].<br>";
    } else {
        echo "email or password fields were not filled in.<br>";
        $_SESSION['mensagem'] = 'Preencha todos os campos!';
        exit();
    }

    //verifica se o user existe
    //check if the user exists
    echo "looking for user in the bank...<br>";
    $user = User::findByEmail($email);

    //var_dump para verificar o conteúdo:
    //var_dump to check the contents:
    echo "search result: ";
    var_dump($user);
    echo "<br>";

    if ($user) {
        echo "user found: " . print_r($user, true) . "<br>";

        if (password_verify($senha, $user['senha'])) {
            echo "correct password, starting session.<br>";
            
            //Cria sessão e armazena esses parâmetros
            //Creates session and stores these parameters
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];
            $_SESSION['user_balance'] = $user['saldo'];

            echo "session created successfully!<br>";
            echo "redirection to dashboard would be here...<br>";
            header('Location: ../views/dashboard.php');
            exit();
        } else {
            echo "incorrect passw: $email<br>";
            $_SESSION['mensagem'] = 'Senha incorreta.';
            exit();
        }
    } else {
        echo "user not found for email: $email<br>";
        $_SESSION['mensagem'] = 'Usuário não encontrado.';
        exit();
    }
} else {
    echo "method not allowed: " . $_SERVER['REQUEST_METHOD'] . "<br>";
    exit();
}
?>
