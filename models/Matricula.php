<?php
require __DIR__ . '/../config/conexao.php';

class Matricula {
    private $id;
    private $aluno_id;
    private $turma_id;
    private $data_matricula;
    private $status;

    public function __construct($aluno_id, $turma_id, $data_matricula = null, $status = 'ativa', $id = null) {
        $this->id = $id;
        $this->aluno_id = $aluno_id;
        $this->turma_id = $turma_id;
        $this->data_matricula = $data_matricula;
        $this->status = $status;
    }

    // Método para cadastrar uma matrícula
    public function inserirMatricula() {
        global $conn;

        // Verifica se a tabela de matrículas existe
        $tableExists = $conn->query("SHOW TABLES LIKE 'matriculas'")->rowCount();
        if (!$tableExists) {
            throw new Exception("Tabela de matrículas não existe.");
        }

        try {
            // Verifica se o aluno já está matriculado na turma
            $sql = "SELECT COUNT(*) FROM matriculas WHERE aluno_id = :aluno_id AND turma_id = :turma_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':aluno_id', $this->aluno_id);
            $stmt->bindParam(':turma_id', $this->turma_id);
            $stmt->execute();
            $matriculaExists = $stmt->fetchColumn();

            if ($matriculaExists > 0) {
                throw new Exception("O aluno já está matriculado nesta turma.");
            }

            $sql = "INSERT INTO matriculas (aluno_id, turma_id, data_matricula, status) 
                    VALUES (:aluno_id, :turma_id, :data_matricula, :status)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':aluno_id', $this->aluno_id);
            $stmt->bindParam(':turma_id', $this->turma_id);
            $stmt->bindParam(':data_matricula', $this->data_matricula);
            $stmt->bindParam(':status', $this->status);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        } catch (Exception $e) {
            throw $e; 
        }
    }

    // Método para listar todas as matrículas
    public static function listarMatriculas() {
        global $conn;

        try {
            $sql = "SELECT m.*, a.nome AS aluno_nome, t.nome_turma AS turma_nome 
                    FROM matriculas m 
                    JOIN alunos a ON m.aluno_id = a.id 
                    JOIN turmas t ON m.turma_id = t.id 
                    ORDER BY m.data_matricula DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }   

    // Método para buscar alunos por turma
    public static function buscarAlunosPorTurma($turma_id) {
        global $conn;

        try {
            $sql = "SELECT m.*, a.*
                    FROM matriculas m 
                    JOIN alunos a ON m.aluno_id = a.id 
                    WHERE m.turma_id = :turma_id 
                    ORDER BY m.data_matricula DESC";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':turma_id', $turma_id);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
