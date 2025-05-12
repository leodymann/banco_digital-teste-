<?php 
namespace Controllers;

//importei classes e conexao
use Models\User;
use Exception;

class BalanceController{
    public function showBalance($id){
        try{
            $saldo = User::getBalance($id);
            if($saldo === false){
                echo "user not found";
            }

            //armazena a mensagem em sessão para ser exibida no view
            $_SESSION['saldo'] = "your balance is $" . number_format($saldo, 2, ',', '.');

        }catch (Exception $e){
            $_SESSION['saldo'] = "error search your balance" . $e->getMessage();
        }

        //redireciona para a pag do saldo do user
        header("Location: /banco_digital/bank_proj/views/balance_view");
        exit();
    }
}

?>