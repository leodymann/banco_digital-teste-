<?php
namespace Conect;

use PDO;
use PDOException;

class Conexao {
    // Configurações da conexão PostgreSQL (substitua pelas suas)
    private static $host = 'dpg-d0qsgf95pdvs73atilm0-a';  // Hostname interno
    private static $port = '5432';                         // Porta padrão PostgreSQL
    private static $db = 'chinacoindatabase';              // Nome do banco de dados
    private static $user = 'chinacoindatabase_user';       // Usuário do banco
    private static $pass = 'ggeC9lg9dj35ikZS0s4EsOPu5aRNUyxj';                // Senha do banco
    private static $connection = null;

    /**
     * Método estático para obter a conexão PDO com PostgreSQL
     * @return PDO|null
     */
    public static function getConnection() {
        if (!self::$connection) {
            try {
                $dsn = "pgsql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$db;
                self::$connection = new PDO($dsn, self::$user, self::$pass);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
?>
