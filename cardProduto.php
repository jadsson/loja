<?php
    if(!isset($produtos)) {
        header('location: index.php');
        exit;
    }
    foreach ($produtos as $key => $value) {
    ?>
        <div id="cardComIconeAdd">

            <?php 
                if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'comum') {
                    ?>
                        <a href="?adicionar-no-carrinho=<?php echo $value['id_produto']?>">
                            <abbr title="ADICIONAR AO CARRINHO">
                                <img src="icons/add_black_24dp.svg" alt="" id="iconeCardAddCarrinho">
                            </abbr>
                        </a>
                    <?php 
                } 
            ?>

            <a href="item.php?id=<?php echo $value['id_produto']?>" id="cardUnicoJS">
                <div class="produtoUnico">
        
                    <img src="img/<?php if($value['img_produto'] != NULL){echo "produtos/".$value['img_produto'];}else{echo 'game.jpg';} ?>" alt="" id="imgProdutoCard">
        
                    <div class="conteudoProduto">
                        <h3>
                        <?php 
                            if(strlen($value['nome_produto']) > 30){
                                echo substr($value['nome_produto'], 0, 30)."...";
                            }else{
                                echo $value['nome_produto'];
                            }
                            
                            ?>
                        </h3>
                        <h2>R$ <?php echo number_format($value['preco'], 2, ',', '.')?></h2>
                        <p class="<?php if($value['qtd'] > 0) {echo 'green';}else{echo 'red';}?>">Disponível <?php echo $value['qtd']?> unidades</p>
                    </div>
                </div>
            </a>
        </div>
    <?php
    }
    
    ?>

<?php 
        // adicionar clique no produto 
        if(isset($_GET['id'])) {
            require_once 'php/regras/ProdutoRegras.php';
            
            $adClique = new ProdutoRegras;
            $novoClique = $adClique->AdicionaClique($_GET['id']);
        }

        // adicionar produto no carrinho
        if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'comum') {
            if(isset($_GET['adicionar-no-carrinho'])) {
                $vaiProCarrinho = new ProdutoRegras;
                $idProdutoClicado = $_GET['adicionar-no-carrinho'];
    
                $produtoSelecionado = $vaiProCarrinho->MostraProdutoUnico($idProdutoClicado);
         
                if($vaiProCarrinho->InserirNoCarrinho($_SESSION['id'], $produtoSelecionado['id_produto'])) {
                    echo "<script>alert('\"{$produtoSelecionado['nome_produto']}\" adicionado no seu carrinho')</script>";
                    echo "<script>location.href = 'http://localhost/j-store/carrinho.php'</script>";
                }
            }
        }
    ?>

    