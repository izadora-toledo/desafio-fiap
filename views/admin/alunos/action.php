<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
                    echo json_encode(['error' => "Esse CPF já está cadastrado."]);
                } else {                 
                    echo json_encode(['message' => "Aluno cadastrado com sucesso."]);
                }
                break;         

            default:
                echo '<div style="color:red;">Ação não reconhecida.</div>';
                break;
        }
    } else {
        echo '<div style="color:red;">Nenhuma ação especificada.</div>';
    }
} else {
    echo '<div style="color:red;">Erro em realizar a ação.</div>';
}
?>
