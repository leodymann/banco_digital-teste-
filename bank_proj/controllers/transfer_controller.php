<?php 

namespace Controllers;
use Models\User;
use Models\Transaction;
use Models\Database;
use Exception;

class TransferController{
    public function transfer($remetente, $destinatario, $valor){
        //obtem a conexao com o banco de dados e starta uma trasação
        //gets the connection to the database and starts a transaction
        $pdo = Database::getConnection();
        $pdo->beginTransaction();

        try{
            //busca dados do user inicial e final no banco de dados
            //search for initial and final user data in the database
            $remetenteData = User::findById($remetente);
            $destinatarioData = User::findById($destinatario);

            //verifica se o user initial e final existem
            //check if the initial and final user exist
            if( !$remetenteData || !$destinatarioData){
                echo "user initial not found";
            }

            //obtem o saldo do user conectado
            //get the initial user connected
            $saldo = $remetenteData['saldo'];

            //verifica se o saldo é suficiente
            //check if the balance is sufficient
            if($saldo >= $valor){
                //atualiza o saldo do user initial (debita da conta)
                //updates the initial users balance (debits from the account)
                User::updateBalance($remetente, -$valor);

                //atualiza o saldo do user final
                //updates the end users balance
                User::updateBalance($destinatario, $valor);

                //registra a transação no banco
                //record the transaction in the bank
                Transaction::create($remetente, $destinatario, $valor);

                //confirma a transacão
                //commit the transaction
                $pdo->commit();

                //notificação de success
                $_SESSION['mesagem'] = "transfer success!";
            }else{
                //se o saldo for insuficiente
                echo "not balance enough";
            }

        }catch (Exception $e){
            //em caso de erro, volta as alterações feitas
            //in case of error, revert the changes made
            $pdo->rollBack();

            //messagem de erro
            //error message 
            $_SESSION['mensagem'] = "error transfer" . $e->getMessage();
        }

        //redireciona para a pag de transfers
        $_SESSION['mensagem'] = "Transferência realizada com sucesso!";
        header("Location: /banco_digital/bank_proj/");
        //finaliza
        exit();
    }
}
?>