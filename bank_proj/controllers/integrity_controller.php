<?php 
namespace Controllers;
use Models\Database;
use PDO;

class IntegrityController{

    // verificação e correção dos blocos
    // recalcula os hashes do bloco,
    // verifica se estão corretos,
    // atualiza se estiverem incorretos,
    // corrige os hashes antetriores dos blocos seguintes e
    // registra um log com o núm. de correções feitas.
    public static function repararHashes(){
        //conexão com o database(banco de dados)
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM blocos ORDER BY id ASC");
        $stmt->execute();
        $blocos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //inicia um contador para os blocos que foram reparados
        $reparados = 0;
        //percorre todos os blocos retornados
        for ($i = 0; $i < count($blocos); $i++){
            //obtem o bloco atual da iteração
            $bloco = $blocos[$i];

            // recalcular o hash do bloco atual
            $stmt = $pdo->prepare("SELECT hash FROM transacoes WHERE bloco_id = ? ORDER BY id");
            $stmt->execute([$bloco['id']]);
            $hashes = $stmt->fetchAll(PDO::FETCH_COLUMN);
            $conteudo = implode('', $hashes);
            $hashRecalculado = hash('sha256', $conteudo);

            //verifica e atualiza o hash do bloco
            if($bloco['hash'] !== $hashRecalculado){
                // atualiza apenas se o hash estiver errado
                $update = $pdo->prepare("UPDATE blocos SET hash = ? WHERE id = ?");
                $update->execute([$hashRecalculado, $bloco['id']]);
                $reparados++;
            }
            //verifica e atualiza o hash prévio do próximo bloco
            if($i < count($blocos) - 1){
                $prox = $blocos[$i + 1];
                if($prox['prev_hash'] !== $hashRecalculado){  // <-- usar hashRecalculado aqui!
                    $stmt = $pdo->prepare("UPDATE blocos SET prev_hash = ? WHERE id = ?");
                    $stmt->execute([$hashRecalculado, $prox['id']]);
                    $reparados++;
                }
            }
        }


        //registra o log
        self::logReparo($reparados);
        return $reparados;
    }
    //metodo de reparo para registrar logs
    private static function logReparo($quantidade){
        $log = "[" . date('Y-m-d H:i:s') . "] Blocos reparados: $quantidade\n";
        file_put_contents(__DIR__ . '/../logs/reparos.log', $log, FILE_APPEND);
    }
}

?>