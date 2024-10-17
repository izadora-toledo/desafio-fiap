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
            return '<div style="color:red;">Erro ao listar alunos: </div>' . $e->getMessage();
        }
    }

    public function editaAluno($id, $nome, $data_nascimento, $usuario_cpf, $email, $telefone) {
        try {
            $aluno = new Aluno($nome, $data_nascimento, $usuario_cpf, $email, $telefone, $id);
            $aluno->editarAluno();
            return '<div style="color:green;">Aluno atualizado com sucesso!</div>';
        } catch (Exception $e) {
            return '<div style="color:red;">Erro ao atualizar aluno: </div>' . $e->getMessage();
        }
    }
    
    public function buscaAlunoPorId($id) {
        try {
            return Aluno::buscarAlunoPorId($id);
        } catch (Exception $e) {
            return ["error" => "Erro ao buscar aluno: " . $e->getMessage()];
        }
    }
    
}
?>
