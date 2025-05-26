<?php
session_start();

require_once 'models/database.php';
require_once 'controllers/integrity_controller.php';

use Controllers\IntegrityController;

if (!isset($_SESSION['user']) || empty($_SESSION['user']['is_admin'])) {
    die("Acesso negado.");
}

$reparados = IntegrityController::repararHashes();

header("Location: views/painel_integridade.php?reparados=$reparados");
exit();
