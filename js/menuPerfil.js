const mostrarMenu = document.querySelector('#mostrar-menu-perfil');
const menuPerfil = document.querySelector('#drop-perfil');
const fechaMenu = document.querySelector('#corpo-home');
const btFechaMenu = document.querySelector('#fecha-menu');
const abreNaPaginaCarrinho = document.querySelector('.abrirMenuLateral');

if(abreNaPaginaCarrinho) {
    abreNaPaginaCarrinho.addEventListener('click', ()=>{
        menuPerfil.style.display = 'block';
    })
}
if(btFechaMenu) {
    btFechaMenu.addEventListener('click', ()=>{
        menuPerfil.style.display = 'none';
    })
    mostrarMenu.addEventListener('click', ()=>{
        menuPerfil.style.display = 'flex';
    })
}
