<?php
require_once __DIR__ . '/../models/Matricula.php';

class MatriculaController {

    public function cadastraMatricula($aluno_id, $turma_id) {
        try {
            $matricula = new Matricula($aluno_id, $turma_id);
            return $matricula->inserirMatricula();
        } catch (Exception $e) {
            return $e->getMessage(); 
        }
    }

    public function listaMatriculas() {
        try {
            return Matricula::listarMatriculas();
        } catch (Exception $e) {
            return false;
        }
    }

    public function excluiMatricula($id) {
        try {
            $matricula = new Matricula(0, 0, null, null, $id);
            return $matricula->excluirMatricula();
        } catch (Exception $e) {
            return false;
        }
    }
  
    public function buscaAlunosPorTurma($turma_id) {
        try {
            return Matricula::buscarAlunosPorTurma($turma_id);
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
