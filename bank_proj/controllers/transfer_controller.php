<?php 

namespace Controllers;
use Models\User;
use Models\Transaction;
use Models\Database;
use Exception;

class TransferController{
    public function transfer($remetente, $destinatario, $valor){
        //obtem a conexao com o banco de dados e starta uma trasação
        $pdo = Database::getConnection();
        $pdo->beginTransaction();

        try{
            //busca dados do user inicial e final no banco de dados
            $remetenteData = User::findById($remetente);
            $destinatarioData = User::findById($destinatario);

            //verifica se o user initial existe
            if(!$destinatarioData){
                echo "user initial not found";
            }
            //verifica se o user final existe
            if(!$destinatarioData){
                echo "user final not found";
            }

            //obtem o saldo do user initial
            $saldo = $remetenteData['saldo'];

            //verifica se o saldo é suficiente
            if($saldo >= $valor){
                //atualiza o saldo do user initial (debita da conta)
                User::updateBalance($remetente, -$valor);

                //atualiza o saldo do user final
                User::updateBalance($destinatario, $valor);

                //registra a transação no banco
                Transaction::create($remetente, $destinatario, $valor);

                //confirma a transação
                $pdo->commit();

                //notificação de success
                $_SESSION['mesagem'] = "transfer success!";
            }else{
                //se o saldo for insuficiente
                echo "not balance enough";
            }

        }catch (Exception $e){
            //em caso de erro, volta as alterações feitas
            $pdo->rollBack();

            //messagem de erro
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