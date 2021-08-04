const modalCadastro = document.querySelector('#modal-cadastro');
const abrirModalCadastro = document.querySelector('#cadastrar');
const fecharModalCadastro = document.querySelector('#fecha-cadastro');

if(fecharModalCadastro) {
    fecharModalCadastro.addEventListener('click', ()=>{
        modalCadastro.style.display = 'none';
    })
    abrirModalCadastro.addEventListener('click', ()=>{
        modalCadastro.style.display = 'flex';
    })
}