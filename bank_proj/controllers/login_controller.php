<?php 
session_start();
require_once '../models/user.php';
use Models\User;

// Verifica se o script está sendo executado.
echo "🔍 Script iniciado.<br>";

// Verifica se o form foi enviado corretamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "✅ Método POST detectado.<br>";

    // Verifica os valores recebidos
    if (isset($_POST['email_user']) && isset($_POST['pass_user'])) {
        $email = $_POST['email_user'];
        $senha = $_POST['pass_user'];

        echo "📩 Dados recebidos - Email: $email, Senha: [OCULTA].<br>";
    } else {
        echo "❌ Campos de email ou senha não foram preenchidos.<br>";
        $_SESSION['mensagem'] = 'Preencha todos os campos!';
        exit();
    }

    // Verifica se o usuário existe
    echo "🔎 Procurando usuário no banco...<br>";
    $user = User::findByEmail($email);

    // Adicionei um var_dump para verificar o conteúdo:
    echo "🔎 Resultado da busca: ";
    var_dump($user);
    echo "<br>";

    if ($user) {
        echo "✅ Usuário encontrado: " . print_r($user, true) . "<br>";

        if (password_verify($senha, $user['senha'])) {
            echo "🔓 Senha correta, iniciando sessão.<br>";
            
            // Cria sessão
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];

            echo "✅ Sessão criada com sucesso!<br>";
            echo "🟢 Redirecionamento para o dashboard estaria aqui...<br>";
            header('Location: ../views/dashboard.php');
            exit();
        } else {
            echo "❌ Senha incorreta para o usuário: $email<br>";
            $_SESSION['mensagem'] = 'Senha incorreta.';
            exit();
        }
    } else {
        echo "❌ Usuário não encontrado para o email: $email<br>";
        $_SESSION['mensagem'] = 'Usuário não encontrado.';
        exit();
    }
} else {
    echo "⚠️ Método não permitido: " . $_SERVER['REQUEST_METHOD'] . "<br>";
    exit();
}
?>
