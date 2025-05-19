<?php 
namespace Models;

use Models\Database;
use PDO;

class Transaction {
    // Conta transações de um usuário
    // Counts transactions for a user
    public static function countByUser($userId) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM transacoes WHERE remetente = :userId OR destinatario = :userId");
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchColumn();
    }

    // Busca transações paginadas de um usuário
    // Fetch paged transactions for a user
    public static function getByUserPaginated($userId, $limit, $offset) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare(
            "SELECT t.*, r.nome AS remetente_nome, d.nome AS destinatario_nome
            FROM transacoes t
            JOIN users r ON t.remetente = r.id
            JOIN users d ON t.destinatario = d.id
            WHERE t.remetente = :userId OR t.destinatario = :userId
            ORDER BY t.data_data DESC
            LIMIT :limit OFFSET :offset"
        );
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cria nova transação com hash e prev_hash
    // Create new transaction with hash and prev_hash
    public static function create($remetente, $destinatario, $valor) {
        $pdo = Database::getConnection();

        // Buscar último hash
        // Fetch last hash
        $prevHashStmt = $pdo->query("SELECT hash FROM transacoes ORDER BY id DESC LIMIT 1");
        $prevHash = $prevHashStmt->fetchColumn() ?: '';

        // Gerar novo hash
        // Generate new hash
        $data = date('Y-m-d H:i:s');
        $conteudo = $remetente . $destinatario . $valor . $data . $prevHash;
        $hash = hash('sha256', $conteudo);

        // Inserir transação
        // Insert transaction
        $stmt = $pdo->prepare("INSERT INTO transacoes (remetente_id, destinatario_id, valor, data_data, hash, prev_hash)
                               VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$remetente, $destinatario, $valor, $data, $hash, $prevHash]);
    }
}
?>
