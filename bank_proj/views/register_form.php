<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form register</title>
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/style.css">
</head>
<body>
<form action="/banco_digital/bank_proj/controllers/register_controller.php" method="post" class="form-container">
    <h2>register bank</h2>
<!-- recebe id do user conectado-->
    <div>
        <input
        type="text"
        name="nome_user"
        placeholder="your name"
        required
        >
    <!--exibe o saldo-->
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
    <!-- recebe o valor da transfer-->
    <!-- <input
    type="number"
    step="0.01"
    name="valor"
    placeholder="value transfer"
    required
    > -->

    <!-- confirmar transfer-->
    <button type="submit">register</button>
</form>
</body>
</html>