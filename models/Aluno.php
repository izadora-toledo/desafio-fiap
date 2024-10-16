<?php
require "../config/conexao.php"; 

class Aluno {
    private $nome;
    private $data_nascimento;
    private $usuario;
    private $email; 
    private $telefone; 

    public function __construct($nome, $data_nascimento, $usuario, $email = null, $telefone = null) {
        $this->nome = $nome;
        $this->data_nascimento = $data_nascimento;
        $this->usuario = $usuario;
        $this->email = $email; 
        $this->telefone = $telefone; 
    }

    public function inserirAluno() {        
        global $conn; 

        // Valida se o nome do aluno possui 3 caracteres.
        if (strlen($this->nome) < 3) {
            throw new Exception("O nome do aluno deve ter pelo menos 3 caracteres.");
        }

        // Valida se todos os campos obrigatórios foram preenchidos.
        if (empty($this->nome) || empty($this->data_nascimento) || empty($this->usuario) || empty($this->email) || empty($this->telefone)) {
            throw new Exception("Todos os campos são obrigatórios.");
        }       

        try {          
            $sql = "INSERT INTO alunos (nome, data_nascimento, usuario, email, telefone) VALUES (:nome, :data_nascimento, :usuario, :email, :telefone)";
            $stmt = $conn->prepare($sql);
          
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':data_nascimento', $this->data_nascimento);
            $stmt->bindParam(':usuario', $this->usuario);           
            $stmt->bindParam(':email', $this->email);           
            $stmt->bindParam(':telefone', $this->telefone);           
            $stmt->execute();            

            return true; 
        } catch (PDOException $e) {           
            throw new Exception("Erro ao inserir aluno: " . $e->getMessage());
        }
    }
}
?>
