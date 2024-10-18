<?php
require __DIR__ . '/../config/conexao.php';

class Turma {
    private $id;
    private $nome_turma;
    private $data_inicio;
    private $codigo_turma;
    private $curso;
    private $turno;

    public function __construct($nome_turma, $data_inicio, $codigo_turma, $curso = null, $turno = null, $id = null) {
        $this->id = $id;
        $this->nome_turma = $nome_turma;
        $this->data_inicio = $data_inicio;
        $this->codigo_turma = $codigo_turma;
        $this->curso = $curso;
        $this->turno = $turno;
    }

    // Método para cadastrar uma turma
    public function inserirTurma() {        
        global $conn; 
    
        // Valida se o nome da turma possui 3 caracteres.
        if (strlen($this->nome_turma) < 3) {
            throw new Exception("O nome da turma deve ter pelo menos 3 caracteres.");
        }
    
        // Valida se todos os campos obrigatórios foram preenchidos.
        if (empty($this->nome_turma) || empty($this->data_inicio) || empty($this->codigo_turma) || empty($this->curso) || empty($this->turno)) {
            throw new Exception("Todos os campos são obrigatórios.");
        }       
    
        try {
            // Verifica se o código da turma já está cadastrado
            $sql = "SELECT COUNT(*) FROM turmas WHERE codigo_turma = :codigo_turma";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':codigo_turma', $this->codigo_turma);
            $stmt->execute();
            $codigoExists = $stmt->fetchColumn();
    
            if ($codigoExists > 0) {
                return false; 
            }
                
            $sql = "INSERT INTO turmas (nome_turma, data_inicio, codigo_turma, curso, turno) 
                    VALUES (:nome_turma, :data_inicio, :codigo_turma, :curso, :turno)";
            $stmt = $conn->prepare($sql);
          
            $stmt->bindParam(':nome_turma', $this->nome_turma);
            $stmt->bindParam(':data_inicio', $this->data_inicio);
            $stmt->bindParam(':codigo_turma', $this->codigo_turma);           
            $stmt->bindParam(':curso', $this->curso);           
            $stmt->bindParam(':turno', $this->turno);           
            $stmt->execute();            
    
            return true; 
        } catch (PDOException $e) {           
            return false; 
        } catch (Exception $e) {
            throw $e; 
        }
    }   
   
    // Método para listar todas as turmas
    public static function listarTurmas() {
        global $conn;

        try {
            $sql = "SELECT * FROM turmas ORDER BY nome_turma ASC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $turmas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $turmas;
        } catch (PDOException $e) {
            return false;
        }
    }   

    // Método para atualizar os dados da turma
    public function atualizarTurma() {
        global $conn;      
        
        // Verifica se o nome da turma possui 3 caracteres.
        if (strlen($this->nome_turma) < 3) {
            throw new Exception("O nome da turma deve ter pelo menos 3 caracteres.");
        }
    
        // Verifica se todos os campos obrigatórios foram preenchidos.
        if (empty($this->nome_turma) || empty($this->data_inicio) || empty($this->codigo_turma) || empty($this->curso) || empty($this->turno)) {
            throw new Exception("Todos os campos são obrigatórios.");
        }
    
        try {
            // Busca os dados atuais da turma no banco de dados
            $sql = "SELECT nome_turma, data_inicio, codigo_turma, curso, turno FROM turmas WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $dadosAtuais = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$dadosAtuais) {
                throw new Exception("Turma não encontrada.");
            }
    
            // Verifica se houve alteração nos dados
            if (
                $dadosAtuais['nome_turma'] === $this->nome_turma &&
                $dadosAtuais['data_inicio'] === $this->data_inicio &&
                $dadosAtuais['codigo_turma'] === $this->codigo_turma &&
                $dadosAtuais['curso'] === $this->curso &&
                $dadosAtuais['turno'] === $this->turno
            ) {
                // Se nenhum dado foi alterado
                return 'Nenhum dado alterado';
            }
    
            // Se houve alteração, prosseguir com a atualização
            $sql = "UPDATE turmas SET nome_turma = :nome_turma, data_inicio = :data_inicio, codigo_turma = :codigo_turma, curso = :curso, turno = :turno WHERE id = :id";
            $stmt = $conn->prepare($sql);
    
            $stmt->bindParam(':nome_turma', $this->nome_turma);
            $stmt->bindParam(':data_inicio', $this->data_inicio);
            $stmt->bindParam(':codigo_turma', $this->codigo_turma);
            $stmt->bindParam(':curso', $this->curso);
            $stmt->bindParam(':turno', $this->turno);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            return false;
        } catch (Exception $e) {
            throw $e; 
        }
    }

    // Método para excluir uma turma
    public function excluirTurma() {
        global $conn;
    
        try {           
            $sql = "SELECT COUNT(*) FROM turmas WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $turmaExists = $stmt->fetchColumn();
    
            if ($turmaExists == 0) {
                throw new Exception("Turma não encontrada.");
            }    
         
            $sql = "DELETE FROM turmas WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            return false;
        } 
    }

    // Método para buscar uma turma pelo ID
    public static function buscarTurmaPorId($id) {
        global $conn;

        try {
            $sql = "SELECT * FROM turmas WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $turma = $stmt->fetch(PDO::FETCH_ASSOC);
            return $turma;
        } catch (PDOException $e) {
            return false;
        }
    }    
}
?>
