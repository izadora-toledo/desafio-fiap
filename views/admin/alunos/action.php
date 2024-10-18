<?php
include "../../../controllers/AlunoController.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AlunoController();

    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'cadastrar':    
                $nome = $_POST['nome'];
                $data_nascimento = $_POST['data_nascimento'];
                $usuario_cpf = $_POST['usuario_cpf'];
                $email = $_POST['email'];
                $telefone = $_POST['telefone'];                
              
                $resultado = $controller->cadastraAluno($nome, $data_nascimento, $usuario_cpf, $email, $telefone); 
                if ($resultado === false) {     
                    echo json_encode(['error' => '<div class="msg-erro">Esse CPF já está cadastrado.</div>']);
                } else {                 
                    echo json_encode(['message' => '<div class="msg-sucesso">Aluno cadastrado com sucesso.</div>']);
                }
                break;     
                
                case 'editar':                    
                    $id = $_POST['id'];
                    $nome = $_POST['nome_editar'];
                    $data_nascimento = $_POST['data_nascimento_editar'];
                    $usuario_cpf = $_POST['usuario_cpf_editar'];
                    $email = $_POST['email_editar'];
                    $telefone = $_POST['telefone_editar'];                    
                 
                    $resultado = $controller->editaAluno($nome, $data_nascimento, $usuario_cpf, $email, $telefone, $id);                    
                  
                    if ($resultado === false) {
                        echo json_encode(['error' => '<div class="msg-erro">Erro ao atualizar o aluno.</div>']);
                    }                     
                    elseif ($resultado === "Nenhum dado alterado") {
                        echo json_encode(['error' => '<div class="msg-sem-alteracao">Nenhum dado alterado.</div>']);
                    }                     
                    else {
                        echo json_encode(['message' => '<div class="msg-sucesso">Aluno atualizado com sucesso.</div>']);
                    }
                    break;

                case 'excluir':
                    $id = $_POST['id'];
                    $resultado = $controller->excluiAluno($id);
    
                    if ($resultado === false) {
                        echo json_encode(['error' => 'Erro ao excluir o aluno.']);
                    } else {
                        echo json_encode(['message' => 'Aluno excluído com sucesso.']);
                    }
                    break;
            default:
                echo '<div class="msg-erro">Ação não reconhecida.</div>';
                break;
        }
    } else {
        echo '<div class="msg-erro">Nenhuma ação especificada.</div>';
    }
} else {
    echo '<div class="msg-erro">Erro em realizar a ação.</div>';
}
?>
