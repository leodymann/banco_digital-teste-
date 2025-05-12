<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/style.css">
</head>
<body>
    <div class="container">
        <?php 
            if (isset($_SESSION['mensagem'])) {
                echo "<div class='notification'>" . $_SESSION['mensagem'] . "</div>";
                unset($_SESSION['mensagem']); // Limpa após exibição
            }
        ?>

        <form action="../controllers/login_controller.php" method="post" class="form-container">
            <div>
                <input
                type="email"
                name="email_user"
                placeholder="enter your email"
                required>
            </div>
            <div>
                <input
                type="password"
                name="pass_user"
                placeholder="********"
                required>
            </div>
            <button type="submit">
                login
            </button>
        </form>
        <div>
            <a href="/banco_digital/bank_proj/views/register_form.php">i have one account?</a>
        </div>
    </div>
</body>
</html>
