const abrirRegistroProduto = document.querySelector('#iconeRegistrarProduto');
const modalRegistraProduto = document.querySelector('#r-produtoFundo');
const fechaModalProduto = document.querySelector('#fecha-modal-produto');


if(modalRegistraProduto && abrirRegistroProduto) {
    fechaModalProduto.addEventListener('click', ()=>{
        modalRegistraProduto.style.display = 'none';
        fechaModalProduto.style.display = 'none';
    })
    abrirRegistroProduto.addEventListener('click', ()=>{
        modalRegistraProduto.style.display = 'block';
        fechaModalProduto.style.display = 'block';
    })
}