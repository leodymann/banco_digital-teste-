<?php 

namespace Controllers;
use Models\Database;
use Models\User;

class DepositController{
    //funcao para depositar
    public function deposit($userId, $amount){
        //obtem a conexao com o banco
        $db = new Database();
        $conn = $db->getConnection();

        //
        try{
            $conn->beginTransaction();

            //busca o saldo atual do user
            $stmt = $conn->prepare("SELECT saldo FROM usuarios WHERE id = :id");
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            //saldo atual variavel
            $currentBalance = $stmt->fetchColumn();

            if($currentBalance === false){
                echo "user not found";
            }

            //atualiza o saldo
            $newBalance = $currentBalance + $amount;
            $stmt = $conn->prepare("UPDATE usuarios SET saldo = :saldo WHERE id = :id");
            $stmt->bindParam(':saldo', $newBalance);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            
            //busca o ultimo deposito para obter o pre_hash do proprio
            $stmt = $conn->prepare("SELECT hash FROM deposits WHERE user_id = :id ORDER BY data DESC LIMIT 1");
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            $prevHash = $stmt->fetchColumn() ?: 'GENESIS';

            //gera o hash do deposito
            $dataString = $userId . $amount . time() . $prevHash;
            $hash = hash('sha256', $dataString);
            //insere o deposito no banco
            $stmt = $conn->prepare("INSERT INTO deposits (user_id, valor, hash, prev_hash) VALUES (:user_id, :valor, :hash, :prev_hash)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':valor', $amount);
            $stmt->bindParam(':hash',$hash);
            $stmt->bindParam(':prev_hash', $prevHash);
            $stmt->execute();

            $conn->commit();
            return $hash;
        }catch (\Exception $e){
            $conn->rollBack();
            echo 'error a make deposit' . $e->getMessage();
        }
    }
}
?>