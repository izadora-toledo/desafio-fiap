<?php 
$title = "Listar Alunos";
include '../../../public/includes/header.php'; 
require '../../../public/includes/funcoes.php';

if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login/index.php');
    exit;
}

require_once __DIR__ . '/../../../controllers/AlunoController.php';

$alunoController = new AlunoController();
$alunos = $alunoController->listaAlunos();
?>

<div class="listar-alunos mt-5">
    <h2>Lista de Alunos</h2>

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
                    <th>Ações</th> <!-- Nova coluna para ações -->
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
                        <td>                     
                            <button class="btn btn-sm btn-editar" data-id="<?= $aluno['id']; ?>">Editar</button>                 
                        </td>                 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Nenhum aluno encontrado.</p>
    <?php } ?>
</div>
<div id="modal-editar-aluno" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog custom-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Aluno</h5>            
                <button type="button" class="close btn-fechar" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>            
            </div>
            <div class="modal-body">
                <div id="conteudo-modal"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-fechar" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<?php require '../../../public/includes/footer.php'; ?>
