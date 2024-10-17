<?php
require_once __DIR__ . '/../models/Aluno.php';

class AlunoController {
    
    public function cadastraAluno($nome, $data_nascimento, $usuario_cpf, $email, $telefone) {
        try {
            $aluno = new Aluno($nome, $data_nascimento, $usuario_cpf, $email, $telefone);            
            return $aluno->inserirAluno(); 
        } catch (Exception $e) {         
            return false;
        }
    }   
    
    public function listaAlunos() {
        try {
            $alunos = Aluno::listarAlunos();
            return $alunos;
        } catch (Exception $e) {
            return false;
        }
    }  
    
    public function editaAluno($nome, $data_nascimento, $usuario_cpf, $email, $telefone, $id) {
        try {
            $aluno = new Aluno($nome, $data_nascimento, $usuario_cpf, $email, $telefone, $id);
            return $aluno->atualizarAluno();
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function excluiAluno($id) {
        try {
            $aluno = new Aluno("", "", "", "", "", $id); // Apenas o ID é necessário
            return $aluno->excluirAluno();
        } catch (Exception $e) {
            return false;
        }
    }
      
}
?>
