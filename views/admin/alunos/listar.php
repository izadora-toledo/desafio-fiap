<?php 
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login/index.php');
    exit;
}

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
                    <th>Ações</th>
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
                        <button type="button" class="btn btn-sm" id="btn-editar" 
                                data-id="<?= $aluno['id']; ?>" 
                                data-nome="<?= htmlspecialchars($aluno['nome']); ?>"
                                data-data-nascimento="<?= htmlspecialchars($aluno['data_nascimento']); ?>"
                                data-usuario-cpf="<?= htmlspecialchars($aluno['usuario_cpf']); ?>"
                                data-email="<?= htmlspecialchars($aluno['email']); ?>"
                                data-telefone="<?= htmlspecialchars($aluno['telefone']); ?>"
                                data-toggle="modal" 
                                data-target="#modal-editar-aluno">
                            Editar
                        </button>
             
                        </td>                 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Nenhum aluno encontrado.</p>
    <?php } ?>
</div>
<?php
    include 'editar.php'; // modal de edição?>

