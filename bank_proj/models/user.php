<?php 

namespace Models;
require_once 'database.php';

use Models\Database;
use \PDO; // <- Correção para usar o namespace global do PDO ocasionando alguns erros, ja corrigido

class User {

    //funcao pra cadastrar users
    private $db;
    public function __construct(){
        $this->db = Database::getConnection();
    }
    //funcao pra registrar pessoas
    public function create($nome, $email, $senha){
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT); //criptografa senha
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $nome, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $senhaHash, PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    //funcao para procurar email do user no banco
    public static function findByEmail($email){
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);

        //retorna o user ou null se nao achar
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user : null;
    }
    //funcao para procurar id do user no banco
    public static function findById($id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->execute(['id' => $id]);
        
        // Se encontrar o usuário, retorna os dados, caso contrário retorna null
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user : null;
    }
    //funcao para atualizar o saldo do user no banco
    public static function updateBalance($id, $value) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE usuarios SET saldo = saldo + :value WHERE id = :id");
        $stmt->execute(['value' => $value, 'id' => $id]);
    }

    //função para puxar o saldo do user
    public static function getBalance($id){
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT saldo FROM usuarios WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchColumn();
    }
}
?>
