<?php 
    if(!isset($_SESSION)) session_start();

    if(isset($_GET['c'])) {
        $categoria = $_GET['c'];
    }else{
        $categoria = '';
    }

    require_once 'php/regras/ProdutoRegras.php';
    $todos = new ProdutoRegras;
    $produtos = $todos->MostraProdutoPorCategoria($categoria);

    require_once 'menu-topo.php';

?>

<div class="pagina">
    <h1 class="h1-descPagina">TUDO EM <?php echo strtoupper($categoria)?></h1>
    <section class="secaoCardProduto">
        <?php 
            require_once 'cardProduto.php';
        ?>
    </section>
</div>

<?php require_once 'scripts.php'; ?>