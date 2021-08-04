<?php 
    if(!include_once 'php/regras/ProdutoCria.php') {
        header('location: ../index.php');
        exit;
    }
?>
<div class='fundoEditarProduto'>
    <form action="" method="POST" class="modalEditarProduto">

        <h1>EDITAR DADOS DO PRODUTO</h1>

        <label for="nome">Nome do Produto</label>
        <input type="text" name="nome" value="<?php echo $itemAtual['nome_produto']?>">

        <label for="preco">Preço do Produto</label>
        <input type="number" name="preco" value="<?php echo $itemAtual['preco']?>">

        <label for="qtd">Quantidade do Produto</label>
        <input type="number" name="qtd" value="<?php echo $itemAtual['qtd']?>">

        <label for="desc">Descrição do Produto</label>
        <textarea name="desc"><?php echo $itemAtual['desc_produto']?></textarea>
        
        <input type="submit" value="CONFIRMAR" name="confirmarEdicao">
        <button type="submit" class="submit-modal-editar">CANCELAR</button>
    </form>
</div>
<script>
    const fechaModalEdit = document.querySelector('.submit-modal-editar');
    const mod = document.querySelector('.fundoEditarProduto');
    fechaModalEdit.addEventListener('click', (e)=>{
        e.preventDefault();
        mod.style.display = 'none';
    })
</script>