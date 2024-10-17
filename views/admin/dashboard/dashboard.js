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
        $('#form-cadastro-alunos')[0].reset(); // Reseta o formulário de cadastro ao trocar de aba
        $('#mensagem-retorno-cadastro').html(''); // Limpa a mensagem de retorno

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
            $('#mensagem-retorno-cadastro').html(''); // Limpa a mensagem de retorno

            // Atualiza a URL com o hash da aba ativa
            window.location.hash = sectionId;
        }       
    });  

    /* CADASTRO ALUNO */
    // Processa o cadastro do aluno
    $('#form-cadastro-alunos').on('submit', function (e) {
        e.preventDefault();

        const $form = $('#form-cadastro-alunos');
        const $button = $(this);

        if ($button.prop('disabled')) return;  
        $button.prop('disabled', true);

        $('#mensagem-retorno-cadastro').html('');

        $.ajax({
            type: "POST",
            url: "../alunos/action.php",
            data: $form.serialize() + '&acao=cadastrar',
            dataType: "json", 
            success: function (response) {
                if (response.error) {                   
                    $('#mensagem-retorno-cadastro').html('<div style="color:red;">' + response.error + '</div>');                
                } else {                   
                    $('#mensagem-retorno-cadastro').html('<div style="color:green;">' + response.message + '</div>');
                    $form[0].reset(); // Reseta o formulário somente se o cadastro for bem-sucedido
                }
            },
            error: function (xhr, status, error) {
                $('#mensagem-retorno-cadastro').html('<div style="color:red;">Erro: ' + error + '</div>');
            },
            complete: function () {              
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
});