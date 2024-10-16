<?php
require_once __DIR__ . '/../models/Aluno.php';

class AlunoController {
    
    public function cadastrarAluno($nome, $data_nascimento, $usuario_cpf, $email, $telefone) {
        
        try {
            $aluno = new Aluno($nome, $data_nascimento, $usuario_cpf, $email, $telefone);
            $aluno->inserirAluno();
            return "Aluno cadastrado com sucesso!";
        } catch (Exception $e) {
            return "Erro ao cadastrar aluno: " . $e->getMessage();
        }
    }
}
?>
