<!-- MODAL DE BUSCA -->
<?php 
    if(!include_once 'php/regras/UsuarioRegras.php') {
        header('location: ../index.php');
        exit;
    }
?>
<div id="modal-pesquisa">
    <div class="modal-pesquisa-content">
        <img src="icons/close_black_24dp.svg" alt="" id="fecha-modal-pesquisa">
        <h1>buscar produto</h1>
        <form action="" method="POST">
            <input type="text" name="nome-produto" maxlength="45">
            <input type="submit" value="Buscar" name="buscar-produto">
        </form>
    </div>
</div>

