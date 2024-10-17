<?php 
header('Content-Type: application/json');
require "../../../config/conexao.php"; 

session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING); 
    $senha = $_POST['senha']; 

    // Busca o usuário
    $sql = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
    $sql->bindParam(':usuario', $usuario);
    $sql->execute();
    $dados_usuario = $sql->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e a senha está correta
    if ($dados_usuario && password_verify($senha, $dados_usuario['senha'])) {      
        $_SESSION['id_usuario'] = $dados_usuario['id'];
        $_SESSION['usuario'] = $dados_usuario['usuario'];        
    
        echo json_encode([
            'success' => true,
            'redirect' => '../dashboard/index.php'
        ]);
        exit();
    } else {   
        echo json_encode([
            'success' => false,
            'message' => 'Usuário ou senha incorretos.'
        ]);
        exit();
    }
}
?>


