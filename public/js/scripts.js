$(document).ready(function () {
    /* LOGIN */
    // Trata o icone de cadeado na tela de login
    const $senha = $('#senha');
    const $toggleSenha = $('#toggle-senha');

    $toggleSenha.on('click', function () {
        // Alterna o tipo do input entre 'password' e 'text'
        const type = $senha.attr('type') === 'password' ? 'text' : 'password';
        $senha.attr('type', type);

        // Alterna o ícone do cadeado entre aberto e fechado
        $(this).toggleClass('fa-lock fa-lock-open');
    });

    // Processa o login
    $('#form-login .btn-logar').on('submit', function (e) {
        e.preventDefault();

        var usuario = $('#usuario').val();
        var senha = $('#senha').val();

        $.ajax({
            url: 'processar-login.php', 
            type: 'POST',
            data: {
                usuario: usuario,
                senha: senha
            },
            success: function (response) {          
                if (response.success) {
                    window.location.href = response.redirect;
                } else {
                    alert(response.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Erro AJAX:", textStatus, errorThrown);
                alert('Erro ao tentar realizar login.');
            }
        });
    });
    /* CADASTRO ALUNO */
    // Processa o cadastro do aluno
    $('#form-cadastro-alunos .btn-cadastrar-aluno').on('click', function (e) {
        e.preventDefault();

        const $form = $('#form-cadastro-alunos');
        const $button = $(this);

        // Se o botão já estiver desabilitado, não faz nada
        if ($button.prop('disabled')) return;

        // Desabilita o botão de submit para evitar múltiplos cliques
        $button.prop('disabled', true);

        // Limpa a área da mensagem de retorno antes de enviar o formulário
        $('#mensagem-retorno-cadastro').html('');

        $.ajax({
            type: "POST",
            url: "../alunos/action.php",
            data: $form.serialize() + '&acao=cadastrar',
            dataType: "json", // Espera um JSON como resposta
            success: function (response) {
                if (response.error) {
                    // Exibe mensagem de erro
                    $('#mensagem-retorno-cadastro').html('<div style="color:red;">' + response.error + '</div>');
                    // Não limpa o formulário se houver erro
                } else {
                    // Exibe mensagem de sucesso
                    $('#mensagem-retorno-cadastro').html('<div style="color:green;">' + response.message + '</div>');
                    $form[0].reset(); // Reseta o formulário somente se o cadastro for bem-sucedido
                }
            },
            error: function (xhr, status, error) {
                $('#mensagem-retorno-cadastro').html('<div style="color:red;">Erro: ' + error + '</div>');
            },
            complete: function () {
                // Habilita o botão novamente após a resposta
                $button.prop('disabled', false);
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
    /* PAINEL ADMINISTRATIVO */
    // Trata as abas do painel administrativo          
    // Define a aba ativa com base no hash da URL
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
    $('.tab-link').click(function(event) {
        event.preventDefault();     
        $('.tab-link').removeClass('active');
        $(this).addClass('active');         
        $('.tab-content').hide();        
        var tabContentId = $(this).attr('href');
        $(tabContentId).show();
    });

    // Lógica para gerenciar o dropdown e navegação entre as seções
    $('.dropdown-item').click(function(event) {
        event.preventDefault();     
        
        $('.dropdown-item').removeClass('active');
        $(this).addClass('active');              
        $('.tab-content').hide();

        // Obtém o ID da seção a partir do href do item do dropdown
        var sectionId = $(this).attr('href');
        
        // Verifica se o href não é "#", e então mostra a seção correspondente
        if (sectionId && sectionId !== '#') {
            $(sectionId).show();
        }       
    });  
    
    $('.btn-editar').on('click', function () {    
        $('#modal-editar-aluno').modal('show');       
        var alunoId = $(this).data('id');
        // Carregando o conteúdo do editar.php dentro do modal
        $.ajax({
            url: '../alunos/editar.php?id=' + alunoId, 
            method: 'GET',
            success: function(data) {             
                $('#conteudo-modal').html(data); 
            },
            error: function(xhr, status, error) {
                $('#conteudo-modal').html('<div class="alert alert-danger">Erro ao carregar os dados do aluno.</div>');
            }
        });
    });

    $('.btn-fechar').on('click', function() {
        $('#modal-editar-aluno').modal('hide');
    });

    $('#form-editar-aluno .btn-editar-aluno').on('submit', function (e) {
        e.preventDefault();
    
        $.ajax({
            url: '../alunos/action.php',
            method: 'POST',
            data: $(this).serialize() + '&acao=editar',
            success: function (response) {
                $('#mensagem-retorno-editar').html(response);
            },
            error: function () {
                $('#mensagem-retorno-editar').html('<div class="alert alert-danger">Erro ao editar o aluno.</div>');
            }
        });
    });
   
});
