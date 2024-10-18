<?php 
    require_once '../../../public/includes/funcoes.php'; 
    require_once __DIR__ . '/../../../controllers/TurmaController.php';
    $turmaController = new TurmaController();
    $turmas = $turmaController->listaTurmas();
?>

<div class="listar-turmas mt-5">
    <h2>Lista de Turmas</h2>

    <?php if (is_array($turmas) && count($turmas) > 0) { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome da Turma</th>
                    <th>Código da Turma</th>
                    <th>Curso</th>
                    <th>Data de Início</th>
                    <th>Turno</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($turmas as $turma) { ?>
                    <tr>
                        <td><?= $turma['id']; ?></td>
                        <td><?= htmlspecialchars(strtoupper($turma['nome_turma'])) ?></td>
                        <td><?= htmlspecialchars($turma['codigo_turma']) ?></td>
                        <td><?= htmlspecialchars($turma['curso']) ?></td>
                        <td><?= htmlspecialchars(Funcoes::converterDataParaBR($turma['data_inicio'])) ?></td>
                        <td><?= htmlspecialchars($turma['turno']) ?></td>
                        <td>                
                            <button type="button" class="btn btn-sm" id="btn-editar-lista-turma" 
                                data-id="<?= $turma['id']; ?>" 
                                data-nome-turma="<?= ($turma['nome_turma']); ?>"
                                data-codigo-turma="<?= ($turma['codigo_turma']); ?>"
                                data-curso="<?= ($turma['curso']); ?>"
                                data-data-inicio="<?= ($turma['data_inicio']); ?>"
                                data-turno="<?= ($turma['turno']); ?>"
                                data-toggle="modal" 
                                data-target="#modal-editar-turma">
                                Editar
                            </button>                     
                            <button type="button" class="btn btn-sm btn-excluir" id="btn-excluir-turma" data-id="<?= $turma['id']; ?>">Excluir</button>
                        </td>                
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Nenhuma turma encontrada.</p>
    <?php } ?>
</div>
<?php include 'editar.php'; // modal de edição?>

