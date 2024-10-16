$(document).ready(function () {
    const $senha = $('#senha');
    const $toggleSenha = $('#toggle-senha');

    $toggleSenha.on('click', function () {
        // Alterna o tipo do input entre 'password' e 'text'
        const type = $senha.attr('type') === 'password' ? 'text' : 'password';
        $senha.attr('type', type);

        // Alterna o ícone do cadeado entre aberto e fechado
        $(this).toggleClass('fa-lock fa-lock-open');
    });

    $('form').on('submit', function (e) {
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

});