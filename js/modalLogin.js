const abrirLogin = document.querySelector('#login');
const modalLogin = document.querySelector('#modal-login');
const fechaLogin = document.querySelector('#fecha-login');

if(fechaLogin) {
    fechaLogin.addEventListener('click', ()=>{
        modalLogin.style.display = 'none';
    })
    abrirLogin.addEventListener('click', ()=>{
        modalLogin.style.display = 'flex';
    })
}