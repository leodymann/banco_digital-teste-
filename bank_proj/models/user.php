<?php 

namespace Models;

use Models\Database;
use \PDO; // <- Correção para usar o namespace global do PDO

class User {
    public static function findById($id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->execute(['id' => $id]);
        
        // Se encontrar o usuário, retorna os dados, caso contrário retorna null
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user : null;
    }

    public static function updateBalance($id, $value) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE usuarios SET saldo = saldo + :value WHERE id = :id");
        $stmt->execute(['value' => $value, 'id' => $id]);
    }
}
?>
