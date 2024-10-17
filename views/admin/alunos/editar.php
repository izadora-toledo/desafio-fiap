<?php 
include "../../../controllers/AlunoController.php"; 

$id_aluno = $_GET['id'] ?? null; 
$aluno = []; 

if ($id_aluno) {
    $alunoController = new AlunoController();
    $aluno = $alunoController->buscaAlunoPorId($id_aluno);   
} else {
    echo '<div class="alert alert-danger">Aluno não encontrado.</div>';
}

?>

<form id="form-editar-aluno">
    <input type="hidden" name="id" id="id" value="<?= htmlspecialchars($aluno['id'] ?? '') ?>">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required value="<?= htmlspecialchars($aluno['nome'] ?? '') ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required value="<?= htmlspecialchars($aluno['data_nascimento'] ?? '') ?>">
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="form-group">
                <label for="usuario_cpf">Usuário (CPF):</label>
                <input type="text" class="form-control mt-2" id="usuario_cpf" name="usuario_cpf" placeholder="CPF do aluno" maxlength="14" required value="<?= htmlspecialchars($aluno['usuario_cpf'] ?? '') ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control mt-2" id="email" name="email" placeholder="E-mail" required value="<?= htmlspecialchars($aluno['email'] ?? '') ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" class="form-control mt-2" id="telefone" name="telefone" required value="<?= htmlspecialchars($aluno['telefone'] ?? '') ?>">
            </div>
        </div>
        <div class="btn-atualizar">
            <button type="submit" class="btn btn-editar-aluno mt-4">Salvar</button>
        </div>
    </div>
    
</form>
<div id="mensagem-retorno-editar" class="mt-3"></div>
