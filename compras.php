<?php 
    if(!isset($_SESSION)) session_start();
    if(isset($_SESSION['perfil']) && $_SESSION['perfil'] != 'comum') {
        header('location: index.php');
        exit;
    }
    require_once 'php/regras/ProdutoRegras.php';
    $carrinho = new ProdutoRegras;

    require_once 'menu-topo.php';

    if(isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
    }else {
        echo '<h1>Faça <span class="abrirMenuLateral" href="?menu=produtos" style="color:var(--verde); cursor:pointer">Login</span> para ver suas compras</h1>';
        return;
    }

?>

    <div class="pagina">
        <h1 class="h1-descPagina">O QUE VOCÊ COMPROU!</h1>

        <section id="produtosComprados">
        <?php 
            $id ? $meuCarrinho = $carrinho->MostraProdutoComprado($id) : false;

            if($meuCarrinho) {
                foreach($meuCarrinho as $key=>$value) {
                ?>
                        <div id="produtoCompradoUnico">
                            <img src="img/produtos/<?php echo $value['img_produto']?>" alt="">
                            <div class="informacoesCompra">
                                <h1><?php echo $value['nome_produto']?></h1>
                                <h2>R$ <?php echo number_format($value['preco'], 2,',','.')?></h2>
                                <p>Comprado em <?php $dia = new DateTime($value['hora_venda']); echo $dia->format('d-m-y H:i') ?></p>
                            </div>
                        </div>
                        <?php
                }
            }else{
                ?>
            <div>
                <h1 style='max-width:1200px;width:90vw;margin:auto;text-align:center'>Suas compras aparecerão aqui</h1>
                <p style='max-width:1200px;width:90vw;margin:auto;text-align:center'>vá para a <a href='?menu=produtos' style='color:var(--verde);'>página de produtos</a> e aproveite as ofertas</p>
            </div>
        </section>
    </div>
        <?php
    }

    require_once 'scripts.php';
?>