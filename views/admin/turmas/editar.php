<div id="modal-editar-turma" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog custom-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Turma</h5>            
                <button type="button" class="close btn-fechar" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>            
            </div>
            <div class="modal-body">
                <div id="conteudo-modal">
                <form id="form-editar-turma">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="nome_turma">Nome da Turma:</label>
                                <input type="text" class="form-control" id="nome_turma_editar" name="nome_turma_editar" placeholder="Nome da Turma" value="" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="codigo_turma">Código da Turma:</label>
                                <input type="text" class="form-control" id="codigo_turma_editar" name="codigo_turma_editar" placeholder="Código" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="curso">Curso:</label>
                                <select class="form-control mt-2" id="curso_editar" name="curso_editar" required>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="data_inicio">Data de Início:</label>
                                <input type="date" class="form-control mt-2" id="data_inicio_editar" name="data_inicio_editar" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="turno">Turno:</label>
                                <select class="form-control mt-2" id="turno_editar" name="turno_editar" required>
                                    <option value="">-- Selecione o Turno --</option>
                                    <option value="manhã">Manhã</option>
                                    <option value="tarde">Tarde</option>
                                    <option value="noite">Noite</option>
                                </select>
                            </div>
                        </div>                        
                        <div class="atualizar-turma">
                            <button type="submit" class="btn btn-editar-turma mt-4">Salvar</button>
                        </div>
                    </div>   
                </form>
                <div id="mensagem-retorno-editar-turma" class="mt-3"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-fechar" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
