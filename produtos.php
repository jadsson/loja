<?php 
    if(!isset($_SESSION)) session_start();
    require_once 'php/regras/ProdutoRegras.php';
    $paginaProdutos = new ProdutoRegras;

    $produtos = $paginaProdutos->MostraProduto('');  

    
    require_once 'menu-topo.php';

    if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'boss') {
        
        require_once 'modais/registraProduto.php';
    ?>
        <!-- ICONE ADD PRODUTO -->
        <abbr title="REGISTRAR NOVO PRODUTO">
            <img src="icons/add_black_24dp.svg" alt="" id="iconeRegistrarProduto">
        </abbr>
        <!-- ICONE FECHA MODAL -->
        <img src="icons/close_black_24dp.svg" alt="" id="fecha-modal-produto">
    <?php
    }
?>

<div class="pagina">
    <h1 class="h1-descPagina">TODA A LOJA</h1>
    <section class="secaoCardProduto">
        <?php 
            require_once 'cardProduto.php';
        ?>
    </section>
</div>

<?php require_once 'scripts.php'; ?>