<?php 
    require "header.php"; 
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="container-login col-lg-8 col-md-10 col-sm-12">
            <div class="row">
                <div class="background-login col-md-5">
                    <h2>FIAP</h2>
                    <h5 class="mt-4">Fazemos acontecer!</h5>
                    <p>Sua vida acadêmica em um só lugar</p>                    
                </div>
                <div class="formulario-login col-md-7">
                    <h2>Painel Administrativo</h2>
                    <form>
                        <input type="text" id="usuario" name="usuario" placeholder="usuário" required>
                        <div class="container-senha">
                            <input type="password" id="senha" name="senha" placeholder="senha" required>
                            <i id="toggle-senha" class="fas fa-lock"></i>
                        </div>                
                        <button type="submit" class="mt-4">Entrar ></button>
                    </form>
                    <a class="recuperar-senha mt-4 mb-4" href="#">Esqueceu sua senha?</a>                        
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "footer.php"; ?>

