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
                <div id="conteudo-modal">
                <form id="form-editar-aluno">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data_nascimento">Data de Nascimento:</label>
                                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="usuario_cpf">Usuário (CPF):</label>
                                <input type="text" class="form-control mt-2" id="usuario_cpf" name="usuario_cpf" placeholder="CPF 000.000.000-00" maxlength="14" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control mt-2" id="email" name="email" placeholder="E-mail" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                <input type="tel" class="form-control mt-2" id="telefone" name="telefone" required>
                            </div>
                        </div>
                        <div class="btn-atualizar">
                            <button type="submit" class="btn btn-editar-aluno mt-4">Salvar</button>
                        </div>
                    </div>   
                </form>
                <div id="mensagem-retorno-editar" class="mt-3"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-fechar" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
