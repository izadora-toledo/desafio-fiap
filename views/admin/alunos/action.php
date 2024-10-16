<?php
include "../../../controllers/AlunoController.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    
    $controller = new AlunoController();
    $resultado = $controller->cadastrarAluno($nome, $data_nascimento, $usuario, $email, $telefone);    

    echo $resultado;
} else {
    echo "Erro ao cadastrar aluno";
}
?>
