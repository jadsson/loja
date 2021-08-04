<?php   
    if(!isset($_SESSION)) session_start();
    require_once 'php/regras/ProdutoRegras.php';

    $p = new ProdutoRegras;
    $produtos = $p->MostraProdutoMaisVisto();

    require_once 'menu-topo.php';
?>

<div class="pagina">
    <!-- categoria principal -->
    <div class="principal">
        <a href="categoria.php?c=game">
            <img src="./img/game.jpg" alt="" class="img">
        </a>
        <h1>CONSOLES E GAMES</h1>
    </div>
    <!-- categoria secundárias -->
    <div class="secundaria">
        <div>
            <a href="categoria.php?c=smartphone">
                <img src="./img/iphone.png" alt="">
            </a>
            <h1>SMARTPHONES</h1>
        </div>
        <div>
            <a href="categoria.php?c=pc">
                <img src="./img/pc.png" alt="">
            </a>
            <h1>PC</h1>
        </div>
        <div>
            <a href="categoria.php?c=smartv">
                <img src="./img/tv.png" alt="">
            </a>
            <h1>SMARTV</h1>
        </div>
    </div>

    <!-- divisão  -->
    <div class="divisao">
        <h1>MAIS VISTOS</h1>
    </div>

    <!-- os mais  -->
    <section class="secaoCardProduto">
        <?php 
            require_once 'cardProduto.php';
        ?>
    </section>
</div>

<?php require_once 'scripts.php'; ?>