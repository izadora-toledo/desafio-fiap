<?php 
require_once __DIR__ . '/../../../controllers/TurmaController.php';
require_once __DIR__ . '/../../../controllers/MatriculaController.php';
require_once '../../../public/includes/funcoes.php'; 

$turmaController = new TurmaController();
$matriculaController = new MatriculaController();

$turmas = $turmaController->listaTurmas();
$turma_id_selecionada = isset($_POST['turma_id']) ? $_POST['turma_id'] : null;
$alunos = null;
$turma = null; 

if ($turma_id_selecionada) {      
    $alunos = $matriculaController->buscaAlunosPorTurma($turma_id_selecionada);
    $turma = $turmaController->buscarTurmaPorId($turma_id_selecionada);
}
?>

<div class="listar-alunos-matriculados-turma mt-5">
    <h2>Lista de Alunos por Turma</h2>
    <form method="post" class="mb-4">
        <div class="row">
            <div class="col-md-2">
                <label for="turma_id">Selecione a Turma:</label>
                <select id="turma_id" name="turma_id" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Selecione uma turma --</option>
                    <?php if (is_array($turmas) && count($turmas) > 0) { ?>
                        <?php foreach ($turmas as $turma_item) { // Renomear variável para evitar conflito ?>
                            <option value="<?= $turma_item['id']; ?>" <?= ($turma_item['id'] == $turma_id_selecionada) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($turma_item['nome_turma']); ?>
                            </option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2">
                <label for="curso">Curso:</label>
                <input type="text" id="curso_matricula" name="curso_matricula" class="form-control" value="<?= isset($turma['curso']) ? htmlspecialchars($turma['curso']) : ''; ?>" disabled>
            </div>
            <div class="col-md-2">
                <label for="turno">Turno:</label>
                <input type="text" id="turno_matricula" name="turno_matricula" class="form-control" value="<?= isset($turma['turno']) ? htmlspecialchars($turma['turno']) : ''; ?>" disabled>
            </div>
            <div class="col-md-2">
                <label for="codigo_turma">Código da Turma:</label>
                <input type="text" id="codigo_turma_matricula" name="codigo_turma_matricula" class="form-control" value="<?= isset($turma['codigo_turma']) ? htmlspecialchars($turma['codigo_turma']) : ''; ?>" disabled>
            </div>
        </div>
    </form>

    <?php if (is_array($alunos) && count($alunos) > 0) { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Usuário</th>
                    <th>Email</th>
                    <th>Telefone</th>                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos as $aluno) { ?>
                    <tr>
                        <td><?= $aluno['id']; ?></td>
                        <td><?= htmlspecialchars(strtoupper($aluno['nome'])) ?></td>
                        <td><?= htmlspecialchars(Funcoes::converterDataParaBR($aluno['data_nascimento'])) ?></td>
                        <td><?= htmlspecialchars($aluno['usuario_cpf']) ?></td>
                        <td><?= htmlspecialchars($aluno['email']) ?></td>
                        <td><?= htmlspecialchars($aluno['telefone']) ?></td>                                   
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Nenhum aluno encontrado para a turma selecionada.</p>
    <?php } ?>
</div>
