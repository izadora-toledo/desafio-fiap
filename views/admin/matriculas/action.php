<?php
include "../../../controllers/MatriculaController.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new MatriculaController();

    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'cadastrar':          
                $aluno_id = $_POST['aluno_id'];
                $turma_id = $_POST['turma_id'];
                $data_matricula = $_POST['data_matricula'];
                $status = $_POST['status'];
             
                $resultado = $controller->cadastraMatricula($aluno_id, $turma_id, $data_matricula, $status); 
                if ($resultado === true) {
                    echo json_encode(['message' => '<div class="msg-sucesso">Matrícula cadastrada com sucesso.</div>']);
                } else {
                    echo json_encode(['error' => '<div class="msg-erro">' . $resultado . '</div>']);
                }
                break;  
            default:
                echo json_encode(['error' => 'Ação não reconhecida.']);
                break;
        }
    } else {
        echo json_encode(['error' => '<div class="msg-erro">Nenhuma ação especificada.</div>']);
    } 
} else {
    echo json_encode(['error' => '<div class="msg-erro">Erro em realizar a ação.</div>']);
}
?>
