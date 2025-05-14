<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form register</title>
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/style.css">
</head>
<body>
    <div class="container">
        <form action="/banco_digital/bank_proj/controllers/register_controller.php" method="post" class="form-container">
            <h2>register bank</h2>
            <div>
                <input
                type="text"
                name="nome_user"
                placeholder="your name"
                required
                >
                <input
                type="email"
                name="email_user"
                id="email_user"
                placeholder="enter your email"
                required>
                <input
                type="password"
                name="pass_user"
                id="pass_user"
                placeholder="enter your password"
                required>
            </div>
            <!-- confirmar register-->
            <button type="submit">register</button>
            <div class="a-container">
                <a href="login_form.php">you have one account?</a>
            </div>
        </form>
    </div>
</body>
</html>