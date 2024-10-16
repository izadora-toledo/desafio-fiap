<?php
require __DIR__ . '/../config/conexao.php';

class Aluno {
    private $nome;
    private $data_nascimento;
    private $usuario_cpf;
    private $email; 
    private $telefone; 

    public function __construct($nome, $data_nascimento, $usuario_cpf, $email = null, $telefone = null) {
        $this->nome = $nome;
        $this->data_nascimento = $data_nascimento;
        $this->usuario_cpf = $usuario_cpf;
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
        if (empty($this->nome) || empty($this->data_nascimento) || empty($this->usuario_cpf) || empty($this->email) || empty($this->telefone)) {
            throw new Exception("Todos os campos são obrigatórios.");
        }       

        try {          
            $sql = "INSERT INTO alunos (nome, data_nascimento, usuario_cpf, email, telefone) VALUES (:nome, :data_nascimento, :usuario_cpf, :email, :telefone)";
            $stmt = $conn->prepare($sql);
          
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':data_nascimento', $this->data_nascimento);
            $stmt->bindParam(':usuario_cpf', $this->usuario_cpf);           
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
