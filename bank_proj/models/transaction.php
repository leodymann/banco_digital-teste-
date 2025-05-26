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

        try {
            $data = date('Y-m-d H:i:s');

            // Buscar último bloco
            $stmt = $pdo->query("SELECT * FROM blocos ORDER BY id DESC LIMIT 1");
            $bloco = $stmt->fetch(PDO::FETCH_ASSOC);

            $blocoComEspaco = false;
            $blocoId = null;
            $prevBlockHash = '';

            if ($bloco) {
                // Verifica quantas transações já estão no bloco
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM transacoes WHERE bloco_id = ?");
                $stmt->execute([$bloco['id']]);
                $qtd = $stmt->fetchColumn();

                if ($qtd < 5) {
                    $blocoComEspaco = true;
                    $blocoId = $bloco['id'];
                    $prevBlockHash = $bloco['prev_hash'] ?? '';
                } else {
                    $prevBlockHash = $bloco['hash'];
                }
            }

            // Se não houver bloco com espaço, criar novo bloco com hash temporário
            if (!$blocoComEspaco) {
                $criadoEm = $data;
                $hashTemporario = '';
                $stmt = $pdo->prepare("INSERT INTO blocos (hash, prev_hash, criado_em) VALUES (?, ?, ?)");
                $stmt->execute([$hashTemporario, $prevBlockHash, $criadoEm]);
                $blocoId = $pdo->lastInsertId();
            }

            // Buscar último hash de transação
            $prevHashStmt = $pdo->query("SELECT hash FROM transacoes ORDER BY id DESC LIMIT 1");
            $prevHash = $prevHashStmt->fetchColumn() ?: '';

            // Criar hash da transação
            $conteudo = $remetente . $destinatario . $valor . $data . $prevHash;
            $hash = hash('sha256', $conteudo);

            // Inserir a transação
            $stmt = $pdo->prepare("INSERT INTO transacoes (remetente_id, destinatario_id, valor, data_data, hash, prev_hash, bloco_id)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$remetente, $destinatario, $valor, $data, $hash, $prevHash, $blocoId]);

            // Recalcular hash do bloco
            $stmt = $pdo->prepare("SELECT hash FROM transacoes WHERE bloco_id = ? ORDER BY id");
            $stmt->execute([$blocoId]);
            $hashes = $stmt->fetchAll(PDO::FETCH_COLUMN);

            $conteudoDoBloco = implode('', $hashes);
            $novoHashDoBloco = hash('sha256', $conteudoDoBloco);

            // Atualizar hash do bloco
            $update = $pdo->prepare("UPDATE blocos SET hash = ? WHERE id = ?");
            $update->execute([$novoHashDoBloco, $blocoId]);

            return true;

        } catch (\Exception $e) {
            error_log("Erro ao criar transação e atualizar bloco: " . $e->getMessage());
            return false;
        }
    }




}
?>
