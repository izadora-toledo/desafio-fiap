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

        if (strlen($this->usuario_cpf) < 14) {
            throw new Exception("O CPF do aluno deve ter pelo menos 14 caracteres.");
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
            $sql = "SELECT * FROM alunos ORDER BY nome ASC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $alunos;
        } catch (PDOException $e) {
            return false;
        }
    }   

    // Método para atualizar os dados do aluno
    public function atualizarAluno() {
        global $conn;      
        
        // Verifica se o nome do aluno possui 3 caracteres.
        if (strlen($this->nome) < 3) {
            throw new Exception("O nome do aluno deve ter pelo menos 3 caracteres.");
        }

        if (strlen($this->usuario_cpf) < 14) {
            throw new Exception("O CPF do aluno deve ter pelo menos 14 caracteres.");
        }
    
        // Verifica se todos os campos obrigatórios foram preenchidos.
        if (empty($this->nome) || empty($this->data_nascimento) || empty($this->usuario_cpf) || empty($this->email) || empty($this->telefone)) {
            throw new Exception("Todos os campos são obrigatórios.");
        }
    
        try {
            // Busca os dados atuais do aluno no banco de dados
            $sql = "SELECT nome, data_nascimento, usuario_cpf, email, telefone FROM alunos WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $dadosAtuais = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$dadosAtuais) {
                throw new Exception("Aluno não encontrado.");
            }
    
            // Verifica se houve alteração nos dados
            if (
                $dadosAtuais['nome'] === $this->nome &&
                $dadosAtuais['data_nascimento'] === $this->data_nascimento &&
                $dadosAtuais['usuario_cpf'] === $this->usuario_cpf &&
                $dadosAtuais['email'] === $this->email &&
                $dadosAtuais['telefone'] === $this->telefone
            ) {
                // Se nenhum dado foi alterado
                return 'Nenhum dado alterado';
            }
    
            // Se houve alteração, prosseguir com a atualização
            $sql = "UPDATE alunos SET nome = :nome, data_nascimento = :data_nascimento, usuario_cpf = :usuario_cpf, email = :email, telefone = :telefone WHERE id = :id";
            $stmt = $conn->prepare($sql);
    
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':data_nascimento', $this->data_nascimento);
            $stmt->bindParam(':usuario_cpf', $this->usuario_cpf);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':telefone', $this->telefone);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Método para excluir um aluno
    public function excluirAluno() {
        global $conn;
    
        try {           
            $sql = "SELECT COUNT(*) FROM alunos WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $alunoExists = $stmt->fetchColumn();
    
            if ($alunoExists == 0) {
                throw new Exception("Aluno não encontrado.");
            }    
         
            $sql = "DELETE FROM alunos WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
}
?>
