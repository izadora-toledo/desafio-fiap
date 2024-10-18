$(document).ready(function () {
    /* PAINEL ADMINISTRATIVO */
    var hash = window.location.hash;

    if (hash) {
        $('.tab-link').removeClass('active');
        $('.tab-content').hide(); 
        $('.tab-link[href="' + hash + '"]').addClass('active');
        $(hash).show(); // Mostra o conteúdo da aba correspondente ao hash
    } else {
        // Se não houver hash, define a primeira aba como ativa
        $('.tab-link:first').addClass('active');
        $('.tab-content').hide(); 
        $('.tab-content:first').show(); 
    }

    // Atualiza a classe 'active' e o conteúdo ao clicar em um link
    $('.tab-link').click(function(e) {
        e.preventDefault();     
        $('.tab-link').removeClass('active');
        $(this).addClass('active');         
        $('.tab-content').hide();        
        var tabContentId = $(this).attr('href');
        $(tabContentId).show();

        // Reseta os campos do formulário ao trocar de aba
        $('#form-cadastro-alunos')[0].reset(); 
        $('#form-cadastro-turmas')[0].reset();
        $('#form-matricula-alunos')[0].reset();
        $('#mensagem-retorno-cadastro-aluno').html(''); 
        $('#mensagem-retorno-cadastro-turma').html('');
        $('#mensagem-retorno-matricula').html('');

        // Atualiza a URL com o hash da aba ativa
        window.location.hash = tabContentId;
    });

    $('.dropdown-item').click(function(e) {
        e.preventDefault();     
        
        $('.dropdown-item').removeClass('active');
        $(this).addClass('active');              
        
        $('.tab-content').hide();
        var sectionId = $(this).attr('href');
        
        // Verifica se o href não é "#", e então mostra a seção correspondente
        if (sectionId && sectionId !== '#') {
            $(sectionId).show();

            // Reseta os campos do formulário ao trocar de seção
            $('#form-cadastro-alunos')[0].reset(); // Reseta o formulário de cadastro ao trocar de seção
            $('#mensagem-retorno-cadastro-aluno').html(''); // Limpa a mensagem de retorno

            // Atualiza a URL com o hash da aba ativa
            window.location.hash = sectionId;
        }       
    });  

    /* CADASTRO ALUNO */
    // Processa o cadastro do aluno
    $('#form-cadastro-alunos').on('submit', function (e) {
        e.preventDefault();      

        $('#mensagem-retorno-cadastro-aluno').html('');   
        var form = this; 

        $.ajax({
            type: "POST",
            url: "../alunos/action.php",
            data: $(this).serialize() + '&acao=cadastrar',
            dataType: "json", 
            success: function (data) {
                if (data.message) {                   
                    $('#mensagem-retorno-cadastro-aluno').html('<div style="color:green;">' + data.message + '</div>');  
                    form.reset(); 
                    carregarListaAlunos();  
                    carregarListaMatriculas();             
                } else {                   
                    $('#mensagem-retorno-cadastro-aluno').html('<div style="color:red;">' + data.error + '</div>');                   
                }
            },
            error: function (xhr, status, error) {
                $('#mensagem-retorno-cadastro-aluno').html('<div style="color:red;">Erro: ' + error + '</div>');
            }
        });
    });

    // Máscara de CPF
    $('#usuario_cpf').on('input', function() {
        var valor = $(this).val().replace(/\D/g, '');

        if (valor.length <= 11) {
            var cpf = valor;
            if (cpf.length > 9) {
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            }
            if (cpf.length > 7) {
                cpf = cpf.replace(/(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
            }
            if (cpf.length > 5) {
                cpf = cpf.replace(/(\d{3})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3-$4');
            }
            $(this).val(cpf);
        }
    });
       
    $(document).on('click', '#btn-editar-lista-aluno', function() {
      
        var id = $(this).data('id');
        var nome = $(this).data('nome');
        var dataNascimento = $(this).data('data-nascimento');
        var usuarioCpf = $(this).data('usuario-cpf');
        var email = $(this).data('email');
        var telefone = $(this).data('telefone');    
     
        $('#modal-editar-aluno #id').val(id); 
        $('#modal-editar-aluno #nome_editar').val(nome);
        $('#modal-editar-aluno #data_nascimento_editar').val(dataNascimento);
        $('#modal-editar-aluno #usuario_cpf_editar').val(usuarioCpf);
        $('#modal-editar-aluno #email_editar').val(email);
        $('#modal-editar-aluno #telefone_editar').val(telefone);    
      
        $('#modal-editar-aluno').modal('show'); 
    });
    
    $('.btn-fechar').on('click', function() {
        $('#modal-editar-aluno').modal('hide');
        $('#modal-editar-turma').modal('hide');       
    });

    // Envio do formulário para editar o aluno
    $('#form-editar-aluno').on('submit', function(event) {
        event.preventDefault();        
    
        $.ajax({
            url: '../alunos/action.php', 
            type: 'POST',
            data: $(this).serialize() + '&acao=editar',
            dataType: 'json',
            success: function(data) {            
                if (data.message) {
                    $('#mensagem-retorno-editar-aluno').html(data.message);
                    carregarListaMatriculas();
                    location.reload();
                } else if (data.error) {
                    $('#mensagem-retorno-editar-aluno').html(data.error);
                }
            },
            error: function(xhr, status, error) {
                $('#mensagem-retorno-editar-aluno').html('Erro: ' + error);
            }
        });
    });

    // Exclui o aluno
    $(document).on('click', '#btn-excluir-aluno', function () {
        const id = $(this).data('id');
        
        if (confirm('Tem certeza que deseja excluir este aluno?')) {
            $.ajax({
                type: 'POST',
                url: '../alunos/action.php',
                data: { acao: 'excluir', id: id },
                dataType: 'json',
                success: function (data) {
                    if (data.message) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.error);                        
                    }
                },
                error: function () {
                    alert('Erro ao processar a solicitação.');
                }
            });
        }
    });

    /* CADASTRO TURMA */

    $('#form-cadastro-turmas').on('submit', function (e) {
        e.preventDefault();      
    
        $('#mensagem-retorno-cadastro-turma').html('');   
        var form = this;
    
        $.ajax({
            type: "POST",
            url: "../turmas/action.php",
            data: $(this).serialize() + '&acao=cadastrar',
            dataType: "json", 
            success: function (data) {
                if (data.message) {                   
                    $('#mensagem-retorno-cadastro-turma').html('<div style="color:green;">' + data.message + '</div>');   
                    form.reset(); 
                    carregarListaTurmas();       
                    carregarListaMatriculas();      
                } else {                   
                    $('#mensagem-retorno-cadastro-turma').html('<div style="color:red;">' + data.error + '</div>');                    
                }
            },
            error: function (xhr, status, error) {
                $('#mensagem-retorno-cadastro-turma').html('<div style="color:red;">Erro: ' + error + '</div>');
            }
        });
    });

    $(document).on('click', '#btn-editar-lista-turma', function() {
    
        var id = $(this).data('id');
        var nomeTurma = $(this).data('nome-turma');
        var codigoTurma = $(this).data('codigo-turma');
        var curso = $(this).data('curso');
        var dataInicio = $(this).data('data-inicio');
        var turno = $(this).data('turno');
        
        $('#modal-editar-turma #id').val(id);
        $('#modal-editar-turma #nome_turma_editar').val(nomeTurma);
        $('#modal-editar-turma #codigo_turma_editar').val(codigoTurma);
        $('#modal-editar-turma #curso_editar').val(curso);
        $('#modal-editar-turma #data_inicio_editar').val(dataInicio);
        $('#modal-editar-turma #turno_editar').val(turno);
        
        $('#modal-editar-turma').modal('show');
    });   

    $('#form-editar-turma').on('submit', function(event) {
        event.preventDefault();        
    
        $.ajax({
            url: '../turmas/action.php', 
            type: 'POST',
            data: $(this).serialize() + '&acao=editar',
            dataType: 'json',
            success: function(data) {            
                if (data.message) {
                    $('#mensagem-retorno-editar-turma').html(data.message);
                    carregarListaMatriculas();
                    location.reload();
                } else if (data.error) {
                    $('#mensagem-retorno-editar-turma').html(data.error);
                }
            },
            error: function(xhr, status, error) {
                $('#mensagem-retorno-editar-turma').html('Erro: ' + error);
            }
        });
    });    

    // Exclui a turma
    $(document).on('click', '#btn-excluir-turma', function () {
        const id = $(this).data('id');
        
        if (confirm('Tem certeza que deseja excluir esta turma?')) {
            $.ajax({
                type: 'POST',
                url: '../turmas/action.php',
                data: { acao: 'excluir', id: id },
                dataType: 'json',
                success: function (data) {
                    if (data.message) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.error);                        
                    }
                },
                error: function () {
                    alert('Erro ao processar a solicitação.');
                }
            });
        }
    });
    
    /* MATRÍCULA ALUNO */

    $('#form-matricula-alunos').on('submit', function (e) {
        e.preventDefault();      

        $('#mensagem-retorno-matricula').html('');   
        var form = this; 

        $.ajax({
            type: "POST",
            url: "../matriculas/action.php",
            data: $(this).serialize() + '&acao=cadastrar',
            dataType: "json", 
            success: function (data) {
                if (data.message) {                   
                    $('#mensagem-retorno-matricula').html('<div style="color:green;">' + data.message + '</div>');  
                    form.reset();
                    carregarListaMatriculas();                    
                } else {                   
                    $('#mensagem-retorno-matricula').html('<div style="color:red;">' + data.error + '</div>');                   
                }
            },
            error: function (xhr, status, error) {
                $('#mensagem-retorno-matricula').html('<div style="color:red;">Erro: ' + error + '</div>');
            }
        });
    });

    $('.tab-link[href="#listar-alunos-matriculados-por-turma"]').click(function() {    
        $('#turma_id option[value=""]').prop('selected', true);
        $('#curso_matricula').val(''); 
        $('#turno_matricula').val(''); 
        $('#codigo_turma_matricula').val(''); 
        $('#tabela-alunos-matriculados-turma').hide();
    });   
});

function carregarListaAlunos() {
    $.ajax({
        url: "../alunos/listar.php", 
        type: "GET",
        dataType: "html", 
        success: function (data) {           
            $('#listar-alunos').html(data);
        },
        error: function (xhr, status, error) {
            console.log("Erro ao carregar a lista de alunos: " + error);
        }
    });
}

function carregarListaTurmas() {
    $.ajax({
        url: "../turmas/listar.php", 
        type: "GET",
        dataType: "html", 
        success: function (data) {           
            $('#listar-turmas').html(data); 
        },
        error: function (xhr, status, error) {
            console.log("Erro ao carregar a lista de alunos: " + error);
        }
    });
}

function carregarListaMatriculas() {
    $.ajax({
        url: "../matriculas/listar.php", 
        type: "GET",
        dataType: "html", 
        success: function (data) {       
            $('#listar-alunos-matriculados-turma').html(data); 
        },
        error: function (xhr, status, error) {
            console.log("Erro ao carregar a lista de alunos: " + error);
        }
    });

}

