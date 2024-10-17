<?php 
$title = "Listar Alunos";
include "../../../public/includes/header.php"; 

if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login/index.php');
    exit;
}

require_once __DIR__ . '/../../../controllers/AlunoController.php';
$alunoController = new AlunoController();
$alunos = $alunoController->listarAlunos();
?>

<div class="listar-alunos mt-5">
    <h2>Lista de Alunos</h2>

    <?php if (is_array($alunos) && count($alunos) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Usuário</th>
                    <th>Email</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos as $aluno): ?>
                    <tr>
                        <td><?= htmlspecialchars($aluno['nome']) ?></td>
                        <td><?= htmlspecialchars($aluno['data_nascimento']) ?></td>
                        <td><?= htmlspecialchars($aluno['usuario_cpf']) ?></td>
                        <td><?= htmlspecialchars($aluno['email']) ?></td>
                        <td><?= htmlspecialchars($aluno['telefone']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum aluno encontrado.</p>
    <?php endif; ?>
</div>

<?php require '../../../public/includes/footer.php'; ?>
