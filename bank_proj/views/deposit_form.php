<?php 

use Controllers\DepositController;
use Models\User;

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /banco_digital/bank_proj/views/login_form.php");
    exit();
}

require_once '../models/database.php';
require_once '../models/user.php';
require_once '../controllers/deposit_controller.php';

$depositController = new DepositController();
//obtem o id do user pela session
$userId = $_SESSION['user_id'];
//busca o user no banco para retornar email e saldo
$user = User::findById($userId);
// busca para obter info do user {saldo, email}
if ($user) { // verifica se as info estao corretas
    $userEmail = $user['email'] ?? "email not found";
    $saldo = $user['saldo'];
} else { // user not found
    $userEmail = "email not found";
    $saldo = 0.00;
}

//parte do processo do deposito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valor']) && is_numeric($_POST['valor'])) {
    $valor = (float)$_POST['valor'];

    //realiza o deposito, e retorna um hash
    $transactionHash = $depositController->deposit($userId, $valor);

    if ($transactionHash) {
        //update infos user {id, saldo, email & value_deposit}
        $user = User::findById($userId);
        $_SESSION['saldo'] = $user['saldo'];
        $_SESSION['user_email'] = $userEmail;
        $_SESSION['deposit_value'] = number_format($valor, 2, ',', '.'); // valor depositado formatado
        $_SESSION['feedbackMessage'] = "Deposit Successful!";

        //redirecionamento, evita envios duplos do form
        header("Location: deposit_form.php");
        exit();
    } else {
        $_SESSION['feedbackMessage'] = "Deposit Failed!";
        // redirecionamento, exibindo erros
        header("Location: deposit_form.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Deposit Form</title>
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/deposit_form.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header class="dashboard-header">
        <div class="header-content">
            <nav>
                <a href="/banco_digital/bank_proj/views/dashboard.php">home</a>
                <a href="/banco_digital/bank_proj/controllers/logout.php">logout</a>
            </nav>
        </div>
    </header>

    <form action="deposit_form.php" method="post" class="form-container" novalidate>
        <h2>Inform the deposit amount</h2>
        <input
            type="number"
            step="0.01"
            min="0.01"
            name="valor"
            placeholder="Enter your deposit amount $"
            required
        />
        <input
            type="text"
            id="user_balance"
            value="<?php echo isset($_SESSION['saldo']) ? 'Your balance $' . number_format($_SESSION['saldo'], 2, ',', '.') : 'Balance not available'; ?>"
            readonly
        />

        <button type="submit" name="action" value="make_deposit">
            Make your deposit
        </button>
    </form>

    <footer>
        <p>© 2025 Digital Bank. All rights reserved.</p>
    </footer>

    <script>
    <?php if (isset($_SESSION['feedbackMessage'])): ?>
        Swal.fire({
            title: '<?= $_SESSION['feedbackMessage'] ?>',
            <?php if ($_SESSION['feedbackMessage'] === "Deposit Successful!") : ?>
                html: `
                    <p><strong>Email:</strong> <?= htmlspecialchars($userEmail) ?></p>
                    <p><strong>Deposited amount:</strong> $<?= $_SESSION['deposit_value'] ?></p>
                `,
                icon: 'success',
            <?php else: ?>
                icon: 'error',
                text: 'Please try again.',
            <?php endif; ?>
            confirmButtonText: 'Ok'
        });
    <?php 
        unset($_SESSION['feedbackMessage']);
        unset($_SESSION['deposit_value']);
        unset($_SESSION['user_email']);
    ?>
    <?php endif; ?>
    </script>
</body>
</html>
