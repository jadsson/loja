<?php 
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['perfil']) || isset($_SESSION['perfil']) && $_SESSION['perfil'] != 'boss') {
        echo "<script>location.href = 'http://localhost/j-store'</script>";
        exit;
    }
    require_once 'php/regras/ProdutoRegras.php';

    $produtosVendidos = new ProdutoRegras;
    $mostraTodosVendidos = $produtosVendidos->MostraProdutoVendido();

    require_once 'menu-topo.php';

?>

    <div class="pagina">
        <h1 class="h1-descPagina">TUDO O QUE JÁ FOI VENDIDO!</h1>

        <section id="produtosComprados">
        <?php 
            if($mostraTodosVendidos) {
                foreach($mostraTodosVendidos as $key=>$value) {
                ?>
                    <div id="produtoCompradoUnico">
                        <img src="img/produtos/<?php echo $value['img_produto']?>" alt="">
                        <div class="informacoesCompra">
                            <h1><?php echo $value['nome_produto']?></h1>
                            <h2>R$ <?php echo number_format($value['preco'], 2,',','.')?></h2>
                            <p>Comprado por <?php echo $value['nome']?> em <?php $dia = new DateTime($value['hora_venda']); echo $dia->format('d/m/y - H:i') ?></p>
                        </div>
                    </div>
                <?php
                }
            }else{
                ?>
        </section>
        <div>
            <h1 style='max-width:1200px;width:90vw;margin:auto;text-align:center'>Todas as vendas aparecerão aqui</h1>
        </div>
    </div>
        <?php
    }

    require_once 'scripts.php';
?>