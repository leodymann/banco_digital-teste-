<?php 
namespace Conect;

use PDO;
use PDOException;

class Conexao{
    private static $host = 'ballast.proxy.rlwy.net';
    private static $port = '17221';
    private static $db = 'railway';
    private static $user = 'root';
    private static $pass = 'GcqVozQgFsGuqxiPTtMePENuiGdumHEv';
    private static $connection = null;

    public static function getConnection(){
        if(!self::$connection){
            try{
                self::$connection = new PDO(
                    "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$db,
                    self::$user,
                    self::$pass
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch (PDOException $e){
                die("Erro de conexão: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
?>
