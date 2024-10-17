<?php
require __DIR__ . '/../config/conexao.php';

class Aluno {
    private $id;
    private $nome;
    private $data_nascimento;
    private $usuario_cpf;
    private $email; 
    private $telefone; 

    public function __construct($nome, $data_nascimento, $usuario_cpf, $email = null, $telefone = null, $id = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->data_nascimento = $data_nascimento;
        $this->usuario_cpf = $usuario_cpf;
        $this->email = $email; 
        $this->telefone = $telefone; 
    }

    // Método para cadastrar um aluno
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
            // Verifica se o CPF já está cadastrado
            $sql = "SELECT COUNT(*) FROM alunos WHERE usuario_cpf = :usuario_cpf";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':usuario_cpf', $this->usuario_cpf);
            $stmt->execute();
            $cpfExists = $stmt->fetchColumn();
    
            if ($cpfExists > 0) {
                return false; 
            }
                
            $sql = "INSERT INTO alunos (nome, data_nascimento, usuario_cpf, email, telefone) 
                    VALUES (:nome, :data_nascimento, :usuario_cpf, :email, :telefone)";
            $stmt = $conn->prepare($sql);
          
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':data_nascimento', $this->data_nascimento);
            $stmt->bindParam(':usuario_cpf', $this->usuario_cpf);           
            $stmt->bindParam(':email', $this->email);           
            $stmt->bindParam(':telefone', $this->telefone);           
            $stmt->execute();            
    
            return true; 
        } catch (PDOException $e) {           
            return false; 
        }
    }   
    
    // Método para listar todos os alunos
    public static function listarAlunos() {
        global $conn;

        try {
            $sql = "SELECT * FROM alunos";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $alunos;

        } catch (PDOException $e) {
            throw new Exception("Erro ao listar alunos: " . $e->getMessage());
        }
    }

    // Método para editar um aluno 
    public function editarAluno() {
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
            // Verifica se o CPF pertence a outro aluno (exceto o atual).
            $sql = "SELECT COUNT(*) FROM alunos WHERE usuario_cpf = :usuario_cpf AND id != :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':usuario_cpf', $this->usuario_cpf);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $cpfExists = $stmt->fetchColumn();

            if ($cpfExists > 0) {
                throw new Exception("Esse CPF já está cadastrado para outro aluno.");
            }

            // Atualiza os dados do aluno.
            $sql = "UPDATE alunos SET nome = :nome, data_nascimento = :data_nascimento, usuario_cpf = :usuario_cpf, email = :email, telefone = :telefone WHERE id = :id";
            $stmt = $conn->prepare($sql);
            
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':data_nascimento', $this->data_nascimento);
            $stmt->bindParam(':usuario_cpf', $this->usuario_cpf);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':telefone', $this->telefone);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            throw new Exception("Erro ao editar aluno: " . $e->getMessage());
        }
    }    
    
    // Busca aluno por id
    public static function buscarAlunoPorId($id) {
        global $conn;

        try {
            $sql = "SELECT * FROM alunos WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
            return $aluno;

        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar aluno: " . $e->getMessage());
        }
    }
}
?>
