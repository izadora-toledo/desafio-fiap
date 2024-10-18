<?php 
if (!isset($_SESSION['id_usuario'])) {     
    header('Location: ../login/index.php');
    exit;
}
?>
<div class="dashboard-fiap">
    <p>Bem vindo!</p>
</div>
