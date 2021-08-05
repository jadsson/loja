<?php 
    if(!isset($_SESSION)) session_start();

    include_once 'php/regras/ProdutoRegras.php';
    include_once 'php/regras/ProdutoCria.php';
    include_once 'php/regras/ComentarioCria.php';
    include_once 'php/regras/ComentarioRegras.php';

    $id = $_GET['id'];
    
    $item = new ProdutoRegras;
    $p = new ProdutoCria;

    $comentario = new ComentarioCria;
    $c = new ComentarioRegras;

    $itemAtual = $item->MostraProdutoUnico($id);
    if(!$itemAtual){
        header('Location: index.php');
        exit;
    } 
    $produtos = $item->MostraRecomendados($itemAtual['categoria'], $itemAtual['id_produto']);
    $todosComentarios = $c->MostraComentarios($itemAtual['id_produto']);

    require_once 'menu-topo.php';

?>

<div class="pagina">
    
<section id="paginaItemUnico">
    <div id="corpoItem">
        <!-- imagem -->
        <div id="ladoEsquerdo">
            <div class="imgItemUnico">
                <img src="img/<?php if($itemAtual['img_produto'] != NULL){echo "produtos/".$itemAtual['img_produto'];}else{echo 'game.jpg';} ?>" alt="">
            </div>

        </div>

        <!-- informações do protudo -->
        <div id="ladoDireito">
            <div class="conteudoItemUnico">
                <div>
                    <h1><?php echo $itemAtual['nome_produto']?></h1>
                    <h2>R$ <?php echo number_format($itemAtual['preco'],2,',','.')?></h2>
                    <p><?php echo $itemAtual['desc_produto']?></p>
                    <p id="qtd" class="<?php if($itemAtual['qtd'] > 0){echo "disponivel";}else{echo "naoDisponivel";}?>">Disponível <?php echo $itemAtual['qtd']?> unidades</p>
                </div>
                <div>
                    <!-- opção de compra e carrinho só visível para clientes -->
                    <?php 
                        if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'comum') {
                    ?>
                        <form method="POST">
                            <input type="submit" id="btComprar" name="comprar-produto" value="COMPRAR"></input>
                        </form>
                            <!-- 'comprar' produto -->
                            <?php 
                                if(isset($_POST['comprar-produto'])) {
                                    $idProdutoComprado = $itemAtual['id_produto'];
                                    $idComprador = $_SESSION['id'];
                                    $idVendedor = 1;
                                    if($item->CompraProduto($idProdutoComprado, $idComprador, $idVendedor)) {
                                        echo "<script>alert('PARABÉNS!!! Você comprou um {$itemAtual['nome_produto']}')</script>";
                                        echo "<script>location.href = 'http://localhost/j-store/compras.php'</script>";
                                    }
                                }
                            ?>
                            <!-- adicionar ao carrinho, o código se encontra em cardProduto.php -->
                        <div>
                            <a href="?id=<?php echo $itemAtual['id_produto']?>&adicionar-no-carrinho=<?php echo $itemAtual['id_produto']?>">
                                <button id="btAdicionaCarrinho">ADICIONAR AO CARRINHO</button>
                            </a>
                        </div>
                    <?php
                        }
                    ?>

                    <!-- formulario excluir produto -->
                    <?php 
                        if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'boss') {
                            ?>
                                <form action="" method="POST" id="excluir-produto">
                                    <input type="submit" name="editar-produto" value="EDITAR DADOS DO PRODUTO" id="input-editar-produto">
                                    <input type="submit" name="excluir-produto" value="EXCLUIR PRODUTO" id="input-excluir-produto">
                                </form>
                            <?php
                        }
                        // excluir produto
                        if(isset($_POST['excluir-produto'])) {
                            if($item->DeletaProduto($itemAtual['id_produto'])){
                                $caminho = "img/produtos/".$itemAtual['img_produto'];
                                unlink($caminho);
                            }
                        }

                        // editar produto
                        if(isset($_POST['editar-produto'])) {
                            require_once 'modais/editaProduto.php';
                        }
                        if(isset($_POST['confirmarEdicao'])) {
                            $novoNomeProduto = addslashes(htmlentities($_POST['nome']));
                            $novoPrecoProduto = addslashes(htmlentities($_POST['preco']));
                            $novaQtdProduto = addslashes(htmlentities($_POST['qtd']));
                            $novaDescProduto = addslashes(htmlentities($_POST['desc']));
                            $idProduto = $itemAtual['id_produto'];
                            $p->setNome($novoNomeProduto);
                            $p->setPreco($novoPrecoProduto);
                            $p->setQtd($novaQtdProduto);
                            $p->setDesc($novaDescProduto);
                            $p->setId($idProduto);

                            if($item->AtualizaDados($p)){
                                echo "<script>alert('{$itemAtual['nome_produto']} atualizado')</script>";
                                echo "<script>location.href = 'http://localhost/j-store/item.php?id={$itemAtual['id_produto']}'</script>";
                            }else{
                                echo "<script>alert('erro ao atualizar produto')</script>";
                            }
                        }
                    ?>
                </div>
            </div>

        </div>

        <!-- formulário de comentário -->
        <?php 
            if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'comum'){
                ?>
                    <form action="" method="POST" id="formPergunta">
                        <textarea name="comentario" id="" cols="30" rows="4" placeholder="FALAR COM O VENDEDOR"></textarea>
                        <input type="submit" name="comentar" value="ENVIAR">
                    </form>
                <?php

                if(isset($_POST['comentar'])) {
                    $textoComentario = addslashes(htmlentities($_POST['comentario']));
                    $comentario->setIdP($itemAtual['id_produto']);
                    $comentario->setIdU($_SESSION['id']);
                    $comentario->setCom($textoComentario);

                    if(!empty($textoComentario)) {
                        if($c->RegistraComentario($comentario)) {
                            echo "<script>location.href = 'http://localhost/j-store/item.php?id={$itemAtual['id_produto']}'</script>";
                        }else{
                            echo "<script>alert('erro ao adicionar comentário')</script>";
                        }
                    }
                }

            }elseif(!isset($_SESSION['perfil'])){
                echo "<h1 id='pedidoLogin'>Faça <span>Login</span> para comprar ou falar com o vendedor</h1>";
            }
        ?>

        <!-- seção de comentários -->
        <?php 
            foreach ($todosComentarios as $comentUnico) {
                ?>
                <div id="secaoComentarios">
                    <p class='nomeCliente'>
                        <?php echo $comentUnico['nome']?>  
                        <?php $dia = new DateTime($comentUnico['dia_hora']); 
                            echo $dia->format('d/m/Y - H:i:s');
                        ?>
                    </p>
                    <p class='conteudoCliente'><?php echo $comentUnico['conteudo']?></p>

                    <!-- exibir resposta -->
                    <?php 
                        $resposta = $c->MostraResposta($comentUnico['id']);
                        
                        if($resposta) {
                        ?>
                            <div id="divResposta">
                                <div id="respostaDoVendedor">
                                    <p class='nomeVendedor'>Resposta do Vendedor <?php $dia = new DateTime($resposta['dia_hora']); echo $dia->format('d-M-Y H:i:s')?></p>
                                    <p class='conteudoResposta'><?php echo $resposta['conteudo']?></p>
                                </div>
                            </div>
                        <?php
                        }
                    ?>
                </div>

                <?php
                if(!$resposta) {
                    if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'boss') {
                        ?>
                            <!-- responder comentário -->
                            <form action="" method="POST" id="formResponderComentario">
                                <input type="text" hidden name="comentarioDoUsuario" value="<?php echo $comentUnico['conteudo']?>">
                                <input type="text" hidden name="quemComentou" value="<?php echo $comentUnico['nome']?>">
                                <input type="number" hidden name="idComentario" value="<?php echo $comentUnico['id']?>">
                                <input type="submit" value="RESPONDER" name="responderComentario">
                            </form>
                        <?php
    
                    }
                }
            }

            if(isset($_POST['responderComentario'])) {
                $quemComentou = $_POST['quemComentou'];
                $comentarioDoUsuario = $_POST['comentarioDoUsuario'];
                $idComentario = $_POST['idComentario'];
                ?>
                    <div id="formularioDeResposta">
                        <form action="" method="POST">
                            
                            <input type="text" value="<?php echo $comentarioDoUsuario?>" id="comentarioDoUsuario">
                            <input type="number" hidden name="idComentarioUsuario" value="<?php echo $idComentario?>">
                            
                            <textarea name="responder" id="" cols="30" rows="10" placeholder="Responder <?php echo $quemComentou?>"></textarea>
                            
                            <button type="submit" name="cancelarResposta" onclick="fechaModalResposta()">CANCELAR</button>
                            <input type="submit" name="responderUsuario" value="ENVIAR RESPOSTA">
                        
                        </form>
                    </div>
                    <script>
                        function fechaModalResposta() {
                            const formResposta = document.querySelector('#formularioDeResposta');
                            formResposta.style.display = 'none';
                        }
                    </script>
                <?php
            }
            // adicionar resposta
            if(isset($_POST['responderUsuario'])) {
                $contResposta = addslashes(htmlentities($_POST['responder']));
                $fkComent = addslashes(htmlentities($_POST['idComentarioUsuario']));
                $comentario->setCom($contResposta);
                $comentario->setId($fkComent);
                if($c->RespostaDoVendedor($comentario)){
                    echo "<script>location.href = 'http://localhost/j-store/item.php?id={$itemAtual['id_produto']}'</script>";
                }else{
                    echo "<script>alert('erro ao adicionar comentário')</script>";
                }
            }
        ?>
    </div>
</section>
</div>

<!-- recomendados  -->

<h1 class="h1-descPagina" style="max-width: 1800px!important;">MAIS EM <?php echo strtoupper($itemAtual['categoria'])?></h1>
<section class="secaoCardProduto" style="max-width: 1800px!important;">
    <?php 
        require_once 'cardProduto.php';
    ?>
</section>

<?php require_once 'scripts.php'; ?>