<?php 
require_once __DIR__ . '/../../../controllers/AlunoController.php';
require_once '../../../public/includes/funcoes.php'; 

$alunoController = new AlunoController();

// Captura a página atual da URL, se não existir, define como 1
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$limite = 5;

// Obtém a lista de alunos e informações de paginação
$resultado = $alunoController->listaAlunosPorPagina($pagina, $limite);
$alunos = $resultado['alunos'];
$totalPaginas = $resultado['totalPaginas'];
?>

<!-- Conteúdo atualizado com AJAX -->
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
                            <button type="button" class="btn btn-sm" id="btn-editar-lista-aluno" 
                                data-id="<?= $aluno['id']; ?>" 
                                data-nome="<?= ($aluno['nome']); ?>"
                                data-data-nascimento="<?= ($aluno['data_nascimento']); ?>"
                                data-usuario-cpf="<?= ($aluno['usuario_cpf']); ?>"
                                data-email="<?= ($aluno['email']); ?>"
                                data-telefone="<?= ($aluno['telefone']); ?>"
                                data-toggle="modal" 
                                data-target="#modal-editar-aluno">
                                Editar
                            </button>                     
                            <button type="button" class="btn btn-sm btn-excluir" id="btn-excluir-aluno" data-id="<?= $aluno['id']; ?>">Excluir</button>
                        </td>                
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?= ($i == $pagina) ? 'active' : ''; ?>">
                        <a class="page-link" href="#" data-pagina="<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>        
    <?php } else { ?>
        <p>Nenhum aluno encontrado.</p>
    <?php } ?>
</div>
<?php include 'editar.php'; // modal de edição?>
