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
    $('#form-login').on('submit', function (e) {
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
    $('#form-cadastro-alunos').on('submit', function(e) {
        e.preventDefault(); 
       
        var dados_formulario = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "../alunos/action.php", 
            data: dados_formulario,
            success: function(response) {               
                $('#mensagem-retorno-cadastro').html(response);
                $('#form-cadastro-alunos')[0].reset(); 
            },
            error: function(xhr, status, error) {                
                $('#mensagem-retorno-cadastro').html("Erro: " + error);
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
});