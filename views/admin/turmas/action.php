<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../../controllers/TurmaController.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new TurmaController();

    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'cadastrar':    
                $nome_turma = $_POST['nome_turma'];
                $data_inicio = $_POST['data_inicio'];
                $codigo_turma = $_POST['codigo_turma'];
                $curso = $_POST['curso'];
                $turno = $_POST['turno'];              

                $resultado = $controller->cadastraTurma($nome_turma, $data_inicio, $codigo_turma, $curso, $turno); 
                if ($resultado === false) {     
                    echo json_encode(['error' => '<div class="msg-erro">Essa turma já está cadastrada.</div>']);
                } else {                 
                    echo json_encode(['message' => '<div class="msg-sucesso">Turma cadastrada com sucesso.</div>']);
                }
                break;     
                
            case 'editar':                    
                $id = $_POST['id'];
                $nome_turma = $_POST['nome_turma'];
                $data_inicio = $_POST['data_inicio'];
                $codigo_turma = $_POST['codigo_turma'];
                $curso = $_POST['curso'];
                $turno = $_POST['turno'];                
             
                $resultado = $controller->editaTurma($nome_turma, $data_inicio, $codigo_turma, $curso, $turno, $id);                    

                if ($resultado === false) {
                    echo json_encode(['error' => '<div class="msg-erro">Erro ao atualizar a turma.</div>']);
                } elseif ($resultado === "Nenhum dado alterado") {
                    echo json_encode(['error' => '<div class="msg-sem-alteracao">Nenhum dado alterado.</div>']);
                } else {
                    echo json_encode(['message' => '<div class="msg-sucesso">Turma atualizada com sucesso.</div>']);
                }
                break;

            case 'excluir':
                $id = $_POST['id'];
                $resultado = $controller->excluiTurma($id);

                if ($resultado === false) {
                    echo json_encode(['error' => 'Erro ao excluir a turma.']);
                } else {
                    echo json_encode(['message' => 'Turma excluída com sucesso.']);
                }
                break;

            default:
                echo json_encode(['error' => '<div class="msg-erro">Ação não reconhecida.</div>']);
                break;
        }
    } else {
        echo json_encode(['error' => '<div class="msg-erro">Nenhuma ação especificada.</div>']);
    }
} else {
    echo json_encode(['error' => '<div class="msg-erro">Erro em realizar a ação.</div>']);
}
?>
