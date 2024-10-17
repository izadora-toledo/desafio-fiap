<?php
include "../../../controllers/AlunoController.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $usuario_cpf = $_POST['usuario_cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    
    $controller = new AlunoController();
    $resultado = $controller->cadastrarAluno($nome, $data_nascimento, $usuario_cpf, $email, $telefone);    

    echo $resultado;
} else {
    echo '<div style="color:red;">Erro</div>';
}
?>
