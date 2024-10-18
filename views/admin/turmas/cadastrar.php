<div class="cadastro-turmas mt-5">
    <h2>Cadastrar Turma</h2>
    <form id="form-cadastro-turmas">
        <div class="row mb-3">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="nome_turma">Nome da Turma:</label>
                    <input type="text" class="form-control" id="nome_turma" name="nome_turma" placeholder="Nome da Turma" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="data_inicio">Data de Início:</label>
                    <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
                </div>
            </div>
        </div>
      
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="codigo_turma">Código da Turma:</label>
                    <input type="text" class="form-control" id="codigo_turma" name="codigo_turma" placeholder="Código da Turma" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="curso">Curso:</label>
                    <select class="form-control" id="curso" name="curso" required>
                        <option value="">-- Selecione o Curso --</option>
                        <option value="Desenvolvimento Web">Desenvolvimento Web</option>
                        <option value="Análise de Dados">Análise de Dados</option>
                        <option value="Marketing Digital">Marketing Digital</option>
                        <option value="Gestão de Projetos">Gestão de Projetos</option>
                        <option value="Engenharia de Software">Engenharia de Software</option>
                        <option value="Inteligência Artificial">Inteligência Artificial</option>
                        <option value="Segurança da Informação">Segurança da Informação</option>
                        <option value="Administração de Redes">Administração de Redes</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="turno">Turno:</label>
                    <select class="form-control" id="turno" name="turno" required>
                        <option value="">-- Selecione o Turno --</option>
                        <option value="manhã">Manhã</option>
                        <option value="tarde">Tarde</option>
                        <option value="noite">Noite</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="cadastrar-turma">
            <button type="submit" class="btn btn-cadastrar-turma">Cadastrar</button>
        </div>        
    </form>
    <div id="mensagem-retorno-cadastro-turma" class="mt-3"></div>
</div>
