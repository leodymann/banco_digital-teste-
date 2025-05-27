<?php 
namespace Conect;

use PDO;
use PDOException;

class Conexao{
    //atributos privados para armazenar a conexão
    private static $host = 'localhost';
    private static $db = 'banco_digital';
    private static $user = 'root';
    private static $pass = 'leody2005';
    private static $connection = null;

    /** 
    * 
    * metodo estatico para conexão com o banco de dados
    * @return PDO/null
    */
    public static function getConnection(){
        //verifica se a conexão ta ok
        if(!self::$connection){
            try{
                //cria uma instancia em pdo para conexao com o banco
                self::$connection = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$db,
                    self::$user,
                    self::$pass
                );
                //define o erro do pdo para algumas exceções
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch (PDOException $e){
                //para caso ocorra algum erro, exibe e finaliza o script
                die("error conect" . $e->getMessage());
            }
        }
        //retorna a conexão ativa
        return self::$connection;
    }
}
?>
