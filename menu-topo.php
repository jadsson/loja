<?php 
    if(!isset($_SESSION)) session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icons/local_shipping_white_24dp.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/modais/modalPesquisa.css">
    <link rel="stylesheet" href="css/modais/modalCadastro.css">
    <link rel="stylesheet" href="css/modais/modalLogin.css">
    <link rel="stylesheet" href="css/modais/registraProduto.css">
    <link rel="stylesheet" href="css/cardProduto.css">
    <link rel="stylesheet" href="css/item.css">
    <link rel="stylesheet" href="css/carrinho.css">
    <link rel="stylesheet" href="css/modais/editaProduto.css">
    <link rel="stylesheet" href="css/vendidos.css">
    <title>j-Store</title>
</head>
<body>
    <section>
        <!-- MENU  -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">
                        <img src="icons/home_black_24dp.svg" alt="" id="home">           
                    </a>
                    <ul class='menu-descricao'>
                        <li>INÍCIO</li>
                    </ul>
                </li>
            </ul>

            <div id="menu-centro">
                <ul>
                    <li>
                        <img src="icons/search_black_24dp.svg" alt="" id="search">
                        <ul class='menu-descricao'>
                            <li>BUSCAR</li>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="produtos.php">
                            <img src="icons/shopping_bag_black_24dp.svg" alt="" id="settings">
                        </a>
                        <ul class='menu-descricao'>
                            <li>PRODUTOS</li>
                        </ul>
                    </li>
                </ul>
                <?php
                    if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'boss') {
                        ?>
                        <ul>
                            <li>
                                <a href="vendido.php">
                                    <img src="icons/local_shipping_black_24dp.svg" alt="" id="settings">
                                </a>
                                <ul class='menu-descricao'>
                                    <li>VENDAS</li>
                                </ul>
                            </li>
                        </ul>
                    <?php
                    }
                
                    if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'comum') {
                        ?>
                        <ul>
                            <li>
                                <a href="carrinho.php">
                                    <img src="icons/shopping_cart_black_24dp.svg" alt="" id="email">
                                </a>
                                <ul class='menu-descricao'>
                                    <li>CARRINHO</li>
                                </ul>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="http://localhost/j-store/compras.php">
                                    <img src="icons/local_shipping_black_24dp.svg" alt="" id="lock">
                                </a>
                                <ul class='menu-descricao'>
                                    <li>SUAS COMPRAS</li>
                                </ul>
                            </li>
                        </ul>
                        <?php
                    }
                ?>
                <ul>
            </div>

            <ul>
                <?php if(isset($_SESSION['email'])) { ?>
                        <li>
                            <div>
                                <img src="icons/account_circle_black_24dp.svg" alt="" id="mostrar-menu-perfil">
                            </div>
                            <div id="drop-perfil">
                                <img src="icons/close_black_24dp.svg" alt="" id="fecha-menu">
                                <ul id="dropPerfilConteudo">
                                    <div id="menuLateralSuperior">
                                        <li>CONTA</li>
                                        <li>CONFIGURAÇÕES</li>
                                        <li>PAGAMENTOS</li>
                                    </div>
                                    <abbr title="AO CLICAR VOCÊ SERÁ DESLOGADO">
                                        <div id="menuLaretalInferior">
                                            <a href="sair.php">
                                                <li>SAIR</li>
                                            </a>
                                        </div>
                                    </abbr>
                                </ul>
                            </div>
                        </li>
                <?php }else{ ?>

                        <li>
                            <div>
                                <img src="icons/login_black_24dp.svg" alt="" id="mostrar-menu-perfil">
                            </div>
                            <div id="drop-perfil">
                                <img src="icons/close_black_24dp.svg" alt="" id="fecha-menu">
                                <ul>
                                    <li id="login">ENTRAR</li>
                                    <li id="cadastrar">CADASTRAR</li>
                                </ul>
                            </div>
                        </li>

                <?php } ?>

            </ul>
        </nav>
    <?php 
    
        include_once 'modais/busca.php'; 

        // se o usuário está deslogado, os modais de login e cadastro são incluídos junto com a pesquisa

        if(isset($_POST['buscar-produto']) && !isset($_SESSION['perfil'])) {
            $pesquisa = addslashes(htmlentities($_POST['nome-produto']));
            if(!empty($pesquisa)) {
                include_once 'listaPesquisa.php';
                include_once 'modais/cadastro.php';
                include_once 'modais/login.php';
                include_once 'scripts.php';
                exit;
            }
        }

        // buscar um produto traz a página com a lista de encontrados

        if(isset($_POST['buscar-produto'])) {
            $pesquisa = addslashes(htmlentities($_POST['nome-produto']));
            if(!empty($pesquisa)) {
                include_once 'listaPesquisa.php';
                include_once 'scripts.php';
                exit;
            }
        }

        
        // modais de login e cadastro 

        if(!isset($_SESSION['perfil'])) {
            include_once 'modais/cadastro.php';
            include_once 'modais/login.php';
        }
    ?>