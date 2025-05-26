<?php 

namespace Controllers;
use Models\User;
use Models\Transaction;
use Models\Database;
use Exception;

class TransferController{
    public function transfer($remetente, $destinatario, $valor){
    echo "Transferindo: $remetente -> $destinatario, valor: $valor<br>";
    //obtem a conexão com o Database e starta uma transação
    //gets the connection to the database and starts a transaction
    $pdo = Database::getConnection();
    $pdo->beginTransaction();
    echo "Transaction started<br>";

    try {
        //busca dados do user incial e final no database
        //search for initial and final user data in the database
        $remetenteData = User::findById($remetente);
        $destinatarioData = User::findById($destinatario);
        echo "Remetente encontrado: " . ($remetenteData ? "sim" : "não") . "<br>";
        echo "Destinatario encontrado: " . ($destinatarioData ? "sim" : "não") . "<br>";

        //verifica se o user incial e final existem
        //check if the initial and final user exist
        if (!$remetenteData || !$destinatarioData) {
            echo "Usuário remetente ou destinatário não encontrado!<br>";
            exit;
        }
        //obtem o saldo do user conectado
        //get the initial user connected
        $saldo = $remetenteData['saldo'];
        echo "Saldo atual do remetente: $saldo<br>";
        //verifica se o saldo é suficiente
        //check if the balance is sufficient
        if ($saldo >= $valor) {
            //atualiza o saldo do user inicial (debita da conta)
            //updates the initial users balance (debits from the account)
            User::updateBalance($remetente, -$valor);
            echo "Saldo do remetente atualizado<br>";
            //atualiza o saldo do user final
            //updates the end users balance
            User::updateBalance($destinatario, $valor);
            echo "Saldo do destinatário atualizado<br>";

            //registra a transação no Database
            //record the transaction in the database
            $created = Transaction::create($remetente, $destinatario, $valor);
            echo "Transaction::create retornou: " . ($created ? "sucesso" : "falha") . "<br>";

            //verifica se a transação foi registrada corretamente
            //checks if the transaction was recorded correctly
            if (!$created) {
                throw new Exception("Falha ao criar a transação");
            }

            //confirma a transação
            //commit the transaction
            $pdo->commit();
            echo "Transação confirmada<br>";
            //notificação de success
            $_SESSION['mensagem'] = "Transferência realizada com sucesso!";
        } else {
            echo "Saldo insuficiente!<br>"; //se o saldo for insuficiente
            exit;
        }

    } catch (Exception $e) {
        //em caso de erro, reverte as alterações feitas
        //in case of error, revert the changes made
        $pdo->rollBack();
        //mensagem de erro
        //error message
        echo "Erro: " . $e->getMessage();
        exit;
    }

    //removi o header para fins de debug
    //redireciona para a pag de transfers
    header("Location: /banco_digital/bank_proj/");
    exit(); //finaliza
    }
}
?>