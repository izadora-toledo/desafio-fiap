<?php 
if (!isset($_SESSION['id_usuario'])) {     
    header('Location: ../login/index.php');
    exit;
}
require_once __DIR__ . '/../../../controllers/AlunoController.php';
require_once __DIR__ . '/../../../controllers/TurmaController.php';
?>
<div class="matricula-alunos mt-5">
    <h2>Matricular Aluno</h2>
    <form id="form-matricula-alunos">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="aluno_id">Selecionar Aluno:</label>
                    <select class="form-control" id="aluno_id" name="aluno_id" required>
                        <option value="">-- Selecione o Aluno --</option>
                        <?php                       
                        $alunoController = new AlunoController();
                        $alunos = $alunoController->listaAlunos(); 
                        foreach ($alunos as $aluno) {
                            echo "<option value=\"{$aluno['id']}\">{$aluno['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="id_turma">Selecionar Turma:</label>
                    <select class="form-control" id="id_turma" name="id_turma" required>
                        <option value="">-- Selecione a Turma --</option>
                        <?php                        
                        $turmaController = new TurmaController();
                        $turmas = $turmaController->listaTurmas(); 
                        foreach ($turmas as $turma) {
                            echo "<option value=\"{$turma['id']}\">{$turma['nome_turma']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
      
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="data_matricula">Data de Matrícula:</label>
                    <input type="date" class="form-control" id="data_matricula" name="data_matricula" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="">-- Selecione o Status --</option>
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="matricular-aluno">
            <button type="submit" class="btn btn-matricular-aluno">Matricular</button>
        </div>        
    </form>
    <div id="mensagem-retorno-matricula" class="mt-3"></div>
</div>
