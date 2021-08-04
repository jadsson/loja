<?php 
    if(!include_once 'php/regras/UsuarioRegras.php') {
        header('location: ../index.php');
        exit;
    }
    $u = new UsuarioRegras;

?>
<!-- MODAL DE LOGIN -->
<div id="modal-login">
    <form action="" method="POST">
        <img src="./icons/close_black_24dp.svg" alt="" id="fecha-login">
        <h2>Entrar</h2>
        <div class="input">
            <input type="text" name="email" required autocomplete="off" id="emailLogin">
            <label>Email</label>
        </div>
        <div class="input">
            <input type="password" name="senha" required>
            <label>Senha</label>
        </div>
        <input type="submit" value="Entrar" name="logar">
    </form>
</div>

<?php 

    if(isset($_POST['logar'])) {
        $email = addslashes(htmlentities($_POST['email']));
        $senha = addslashes(htmlentities($_POST['senha']));
        
        $u->Entrar($email, $senha);
    }
