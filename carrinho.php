<?php 
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['perfil']) || isset($_SESSION['perfil']) && $_SESSION['perfil'] != 'comum') {
        echo "<script>location.href='http://localhost/j-store'</script>";
        exit;
    }
    require_once 'php/regras/ProdutoRegras.php';

    $carrinho = new ProdutoRegras;

    require_once 'menu-topo.php';

    $id = $_SESSION['id'];
    $meuCarrinho = $carrinho->MostraProdutoDoCarrinho($id);

?>    
<section class="pagina carrinho">

    <h1 class="h1-descPagina">O QUE HÁ NO SEU CARRINHO!</h1>

        <?php 
        if($meuCarrinho) {
            foreach ($meuCarrinho as $key => $value) { ?>
                <div class="itemUnicoCarrinho">
                    <div class="imgCarrinho">
                        <img src="img/produtos/<?php echo $value['img_produto']?>" alt="">
                    </div>
                    <div class="conteudoCarrinho">
                        <a href="?removerItem=<?php echo $value['id_produto']?>">
                            <abbr title="REMOVER DO CARRINHO">
                                <img src="icons/remove_black_24dp.svg" alt="">
                            </abbr>
                        </a>
                        <h1 id="nProduto"><?php echo $value['nome_produto']?></h1>
                        <h1 id="pProduto">R$ <?php echo number_format($value['preco'],2,',','.')?></h1>
                        <p id="dProduto"><?php echo $value['desc_produto']?></p>
                        <p class="<?php if($value['qtd'] > 0){echo 'disponivel';}else{ echo 'indisponivel';}?>">Disponível <?php echo $value['qtd']?></p>
                        
                        <!-- abrir item na página de compra -->
                        <a href="item.php?id=<?php echo $value['id_produto']?>" id="lProduto">COMPRAR AGORA</a>
                    </div>
                </div>
            <?php } ?>
</section>

    
    <?php

    }else{
        echo "<h1 style='max-width:1200px; width:90vw;margin:40px auto 0 auto;'>Ainda não há produtos no seu carrinho</h1>";
        echo "<p style='max-width:1200px;width:90vw;margin:auto;'>vá para a <a href='?menu=produtos' style='color:var(--verde);'>página de produtos</a> e escolha seus favoritos</p>";
    }

    if(isset($_GET['removerItem'])) {
        if(!$carrinho->RemoverDoCarrinho($_SESSION['id'], $_GET['removerItem'])){
            echo "<script>alert('ocorreu um erro')</script>";
            echo "<script>location.href = 'http://localhost/j-store/carrinho.php'</script>";
        }
    }


    require_once 'scripts.php';
?>