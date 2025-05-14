<?php 
namespace Models;
use Models\Database;

class Transaction{
    //metodo estatico para criar uma nova transacao no banco
    public static function create($remetente, $destinatario, $valor){
        //obtem a conexao com o banco
        $pdo = Database::getConnection();

        //busca o ultimo hash registrado
        $stmt = $pdo->query("SELECT hash FROM transacoes ORDER BY id DESC LIMIT 1");
        $prev_hash = $stmt->fetchColumn() ?: "0";

        //defini o fuso e captura a data atual
        date_default_timezone_set('America/Sao_Paulo');
        $data_atual = date('Y-m-d H:i:s');

        //concatena os dados da transação para gerar um hash
        $dadosTransacao = $remetente . $destinatario . number_format($valor, 2,'') . $data_atual;
        $hash = hash('sha256' , $dadosTransacao);

        //prepara a query para inserir a transação no banco
        $stmt = $pdo->prepare("INSERT INTO transacoes (remetente_id, destinatario_id, valor, data_data, hash, prev_hash)
        VALUES (:remetente, :destinatario, :valor, :data_data, :hash, :prev_hash)");

        //executa a query
        $stmt->execute([
            'remetente' => $remetente,
            'destinatario' => $destinatario,
            'valor' => $valor,
            'data_data' => $data_atual,
            'hash' => $hash,
            'prev_hash' => $prev_hash
        ]);
    }
}

?>