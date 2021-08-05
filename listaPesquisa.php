<?php 
    if(!isset($_SESSION)) session_start();

    require_once 'php/regras/ProdutoRegras.php';
    $produtosPesquisados = new ProdutoRegras;
    $produtos = $produtosPesquisados->MostraProduto($pesquisa);

?>

<div class="pagina">
    <h1 class='h1-descPagina'>resultados para <?php echo strtoupper($pesquisa) ?></h1>
    <section class="secaoCardProduto">
        <?php 
            if($produtos) {
                require_once 'cardProduto.php';

            }else{
                ?>
                    <div id="produtoNaoEncontrado">
                        <h1>PRODUTO NÃO ENCONTRADO</h1>
                        <p>Tente buscar por palavras diferentes</p>
                    </div>
                <?php
            }
        ?>
    </section>
</div>