<?php 

namespace Models;
use PDO;
use PDOException;

class Database{
    //atributo privado para armazenar a conexão
    private static $connection;

    /**
     * metodo estatico para estabelecer a conexao com o banco
     * @return PDO|null
     */
    public static function getConnection(){
        if(!self::$connection){
            try{
                //cria uma nova instancia pdo para conexao com o banco de dados
                self::$connection = new PDO('mysql:host=localhost;dbname=banco_digital', 'root', 'leody2005');

                //define o erro pdo em alguma exceções
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch (PDOException $e){
                //para caso ocorra algum erro, exibe e finaliza o script
                die("error conect@" . $e->getMessage());
            }
        }
        //retorna a conexão ativa
        return self::$connection;
    }
}
?>