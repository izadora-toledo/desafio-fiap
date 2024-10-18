<div class="cadastro-alunos mt-5">
    <h2>Cadastrar Aluno</h2>
    <form id="form-cadastro-alunos">
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
                    <input type="text" class="form-control" id="usuario_cpf" name="usuario_cpf" placeholder="CPF 000.000.000-00" maxlength="14" required>
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
        <div class="cadastrar-aluno">
            <button type="submit" class="btn btn-cadastrar-aluno">Cadastrar</button>
        </div>        
    </form>
    <div id="mensagem-retorno-cadastro-aluno" class="mt-3"></div>
</div>

