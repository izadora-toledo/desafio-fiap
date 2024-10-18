<?php
require_once __DIR__ . '/../models/Turma.php';

class TurmaController {
    
    public function cadastraTurma($nome_turma, $data_inicio, $codigo_turma, $curso, $turno) {
        try {
            $turma = new Turma($nome_turma, $data_inicio, $codigo_turma, $curso, $turno);            
            return $turma->inserirTurma(); 
        } catch (Exception $e) {         
            return false;
        }
    }   
    
    public function listaTurmas() {
        try {
            $turmas = Turma::listarTurmas();
            return $turmas;
        } catch (Exception $e) {
            return false;
        }
    }  
    
    public function editaTurma($nome_turma, $data_inicio, $codigo_turma, $curso, $turno, $id) {
        try {
            $turma = new Turma($nome_turma, $data_inicio, $codigo_turma, $curso, $turno, $id);
            return $turma->atualizarTurma();
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function excluiTurma($id) {
        try {
            $turma = new Turma("", "", "", "", "", $id); 
            return $turma->excluirTurma();
        } catch (Exception $e) {
            return false;
        }
    }

    // Método para buscar turma por ID
    public function buscarTurmaPorId($id) {
        try {
            return Turma::buscarTurmaPorId($id);
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
