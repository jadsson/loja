const btn = document.querySelector('#search');
const modalPesquisa = document.querySelector('#modal-pesquisa');
const fechaModal = document.querySelector('#fecha-modal-pesquisa');

fechaModal.addEventListener('click',()=>{
    modalPesquisa.style.display = 'none';
})
btn.addEventListener('click',()=>{
    modalPesquisa.style.display = 'block';
})