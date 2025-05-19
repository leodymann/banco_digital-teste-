<?php 
use Models\Database;
require_once '../models/database.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    echo "Usuário não autenticado.";
    exit();
}

$limit = 5; // Limite de transações por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

function getUserTransactions($userId, $limit, $offset){
    $transactions = [];

    try{
        $db = Database::getConnection();
        $query = $db->prepare('SELECT * FROM transacoes WHERE remetente_id = ? ORDER BY data_data DESC LIMIT ? OFFSET ?');
        $query->bindValue(1, $userId, PDO::PARAM_INT);
        $query->bindValue(2, $limit, PDO::PARAM_INT);
        $query->bindValue(3, $offset, PDO::PARAM_INT);
        $query->execute();
        $transactions = $query->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e){
        echo "error search transactions your id: " . $e->getMessage();
    }
    return $transactions;
}

function getTransactionCount($userId){
    try{
        $db = Database::getConnection();
        $query = $db->prepare('SELECT COUNT(*) FROM transacoes WHERE remetente_id = ?');
        $query->execute([$userId]);
        return $query->fetchColumn();
    }catch (PDOException $e){
        echo "error counting transactions: " . $e->getMessage();
        return 0;
    }
}

$userId = $_SESSION['user_id'];
$transactions = getUserTransactions($userId, $limit, $offset);
$totalTransactions = getTransactionCount($userId);
$totalPages = ceil($totalTransactions / $limit);
?>
