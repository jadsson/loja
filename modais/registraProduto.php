<?php 
    if(!isset($_SESSION)) session_start();
    
    if(!isset($_SESSION['email']) || $_SESSION['perfil'] == 'comum') {
        header('location: ../index.php');
        exit;
    }

    if(!include_once 'php/regras/ProdutoRegras.php') {
        header('location: ../index.php');
        exit;
    }
    include_once 'php/regras/ProdutoCria.php';

    $produtoNovo = new ProdutoCria;
    $registraProduto = new ProdutoRegras;
    
?>

<div id="r-produtoFundo">
    <form action="" method="POST" id="r-produto" enctype="multipart/form-data">
        <h1>REGISTRAR NOVO PRODUTO</h1>
        <label for="categProduto">Categoria do Produto</label>
        <select name="categProduto" id="">
            <option value="game">game</option>
            <option value="pc">pc</option>
            <option value="smartphone">smartphone</option>
            <option value="smartv">smartv</option>
        </select>

        <label for="nomeProduto">Nome do Produto</label>
        <input type="text" name="nomeProduto" maxlength="60" required placeholder="nome do produto">


        <label for="precoProduto">Preço do Produto</label>
        <input type="number" name="precoProduto" required placeholder="ex: 1500">

        <label for="qtdProduto">Quantidade do Produto</label>
        <input type="number" name="qtdProduto" required placeholder="ex: 32">

        <label for="descProduto">Descrição do Produto</label>
        <textarea name="descProduto" maxlength="255" required placeholder="descreva o produto"></textarea>

        <label for="imgProduto">Imagem do Produto</label>
        <input type="file" name="imgProduto">

        <input type="submit" value="REGISTRAR" name="registraNovoProduto">
    </form>
</div>

<?php 

    
    if(isset($_POST['registraNovoProduto'])) {
        /**
         * upload da imagem
         */
        $extensao = pathinfo($_FILES['imgProduto']['name'], PATHINFO_EXTENSION);

        $pasta = "Img/produtos/";
        $nomeTemporario = $_FILES['imgProduto']['tmp_name'];
        $novoNomeImg = sha1(uniqid(time())).".$extensao";

        if(move_uploaded_file($nomeTemporario, $pasta.$novoNomeImg)) {
    
            $nomeNovoProduto = addslashes(htmlentities($_POST['nomeProduto']));
            $categProduto = addslashes(htmlentities($_POST['categProduto']));
            $precoNovoProduto = addslashes(htmlentities($_POST['precoProduto']));
            $qtdNovoProduto = addslashes(htmlentities($_POST['qtdProduto']));
            $descricaoNovoProduto = addslashes(htmlentities($_POST['descProduto']));
            $idVendedor = $_SESSION['id'];
    
            if(!empty($nomeNovoProduto) && !empty($precoNovoProduto) && !empty($descricaoNovoProduto)) {
                $produtoNovo->setNome($nomeNovoProduto);
                $produtoNovo->setPreco($precoNovoProduto);
                $produtoNovo->setDesc($descricaoNovoProduto);
                $produtoNovo->setCateg($categProduto);
                $produtoNovo->setQtd($qtdNovoProduto);
                $produtoNovo->setVendedor($idVendedor);
                $produtoNovo->setImg($novoNomeImg);
                
                $registraProduto->RegistraProduto($produtoNovo);
            }

        }else{
            echo "<script>alert('houve um problema ao adicionar a imagem')</script>";
        }
    }

?>