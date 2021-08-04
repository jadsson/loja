<?php 
if(!include_once 'php/regras/UsuarioRegras.php') {
    header('location: ../index.php');
    exit;
}
include_once 'php/regras/UsuarioCria.php';

$usuario = new UsuarioCria;
$u = new UsuarioRegras;

?>
<!-- MODAL DE CADASTRO  -->
<div id="modal-cadastro">

    <img src="./icons/close_black_24dp.svg" alt="" id="fecha-cadastro">

    <form action="" method="POST" id="cadastro">
    <h2>CADASTRAR</h2>
        <div class="input">
            <input type="text" name="nome" required maxlength="100" autocomplete="off">
            <label>Nome</label>
        </div>
        <div class="input">
            <input type="email" name="email" required maxlength="60" autocomplete="off">
            <label>Email</label>
        </div>
        <div class="input">
            <input type="password" name="senha" required maxlength="25">
            <label>Senha</label>
        </div>
        <div class="input">
            <input type="password" name="conf" required maxlength="25">
            <label>Confirmar Senha</label>
        </div>
        <input type="submit" value="Confirmar">
    </form>
</div>

<?php 

    if(isset($_POST['conf'])) {
        $nome = addslashes(htmlentities($_POST['nome']));
        $email = addslashes(htmlentities($_POST['email']));
        $senha = addslashes(htmlentities($_POST['senha']));
        $conf = addslashes(htmlentities($_POST['conf']));
        
        if(!empty($nome) && !empty($email) && !empty($senha) && !empty($conf)) {
            if($senha === $conf) {
                $usuario->setNome($nome);
                $usuario->setEmail($email);
                $usuario->setSenha($conf);
    
                $u->RegistraUsuario($usuario);
            }else{
                echo "<script>alert('SENHAS DIVERGENTES')</script>";
            }
        }else{
            echo "<script>alert('PREENCHA TODOS OS CAMPOS')</script>";
        }
    }
