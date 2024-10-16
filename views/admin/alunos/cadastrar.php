<?php 
$title = "Cadastrar alunos";
require '../../../public/includes/header.php'; 
?>
<div class="form-cadastro-alunos mt-5">
    <h2>Cadastrar Aluno</h2>
    <form>
        <div class="row mb-3">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                </div>
            </div>
        </div>
      
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="usuario">Usuário (CPF):</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="CPF do aluno" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" class="form-control" id="telefone" name="telefone" required>
                </div>
            </div>
            
        </div>
        <div class="btn-cadastrar">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>        
    </form>
</div>
<?php require '../../../public/includes/footer.php'; ?>
