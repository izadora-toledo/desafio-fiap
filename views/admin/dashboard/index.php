<?php
require_once __DIR__ . '/../../../controllers/AlunoController.php';
require_once __DIR__ . '/../../../controllers/TurmaController.php';
require_once '../../../public/includes/funcoes.php'; 
session_start();

if (!isset($_SESSION['id_usuario'])) {     
    header('Location: ../login/index.php');
    exit;
}

$title = "Painel Administrativo";
include "../../../public/includes/header.php"; 
?>
<div class="menu row">
    <div class="col-md-3">
        <h2>FIAP</h2>
    </div>
    <div class="col-md-8 deslogar mb-2">
        <nav class="nav justify-content-between">
            <div class="menu-center">
                <!-- DASHBOARD -->
                <div class="nav-item">
                    <a class="nav-link tab-link" href="#dashboard">Dashboard</a>
                </div>
                
                <!-- ALUNOS -->
                <div class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="dropdown-alunos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Alunos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-alunos">
                        <li><a class="dropdown-item tab-link" href="#cadastrar-aluno">Cadastrar aluno</a></li>
                        <li><a class="dropdown-item tab-link" href="#listar-alunos">Listar alunos</a></li>
                    </ul>
                </div>

                <!-- TURMAS -->
                <div class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="dropdown-turmas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Turmas
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-turmas">
                        <li><a class="dropdown-item tab-link" href="#cadastrar-turma">Cadastrar turma</a></li>
                        <li><a class="dropdown-item tab-link" href="#listar-turmas">Listar turmas</a></li>
                    </ul>
                </div>

                <!-- MATRÍCULAS -->
                <div class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="dropdown-matriculas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Matrículas
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-matriculas">
                        <li><a class="dropdown-item tab-link" href="#matricular-aluno-turma">Cadastrar aluno em turma</a></li>
                        <li><a class="dropdown-item tab-link" href="#listar-alunos-matriculados-por-turma">Listar matrículas por turma</a></li>
                    </ul>
                </div>
            </div>

          
        </nav>
    </div>
    <!-- BOTÃO SAIR -->
    <div class="col-md-1">           
        <button class="btn logout">
            <a class="btn-logout" href="../login/logout.php">Sair</a>
        </button>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="tab-content" id="dashboard">
            <?php include_once "dashboard.php"; ?>
        </div>
        <div class="tab-content" id="cadastrar-aluno">
            <?php include_once "../alunos/cadastrar.php"; ?>
        </div>

        <div class="tab-content" id="listar-alunos">
            <?php include_once "../alunos/listar.php"; ?>
        </div>

        <div class="tab-content" id="cadastrar-turma">
            <?php include_once "../turmas/cadastrar.php"; ?>
        </div>

        <div class="tab-content" id="listar-turmas">
            <?php include_once "../turmas/listar.php"; ?>
        </div>

        <div class="tab-content" id="matricular-aluno-turma">
            <?php include_once "../matriculas/cadastrar.php"; ?>
        </div>

        <div class="tab-content" id="listar-alunos-matriculados-por-turma">
            <?php include_once "../matriculas/listar.php"; ?>
        </div>
    </div>
</div>

<?php include '../../../public/includes/footer.php'; ?>
<script src="dashboard.js"></script>