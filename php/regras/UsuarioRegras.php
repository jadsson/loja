<?php 
    require_once 'UsuarioCria.php';
    require_once 'BancoConecta.php';

class UsuarioRegras {
    /**
     * Verifica se email já existe antes de registrar usuário
     */
    function RegistraUsuario(UsuarioCria $p) {
        /**
         * Verificando na tabela de usuários comuns
         */
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $p->getEmail());
        $stmt->execute();
        if($stmt->rowCount() > 0){
            echo "<script>alert('{$p->getEmail()} já está cadastrado')</script>";
            return false;
        }else{
            /**
             * Verificando na tabela de vendedores
             */
            $sql = "SELECT * FROM vendedor WHERE email = ?";
            $stmt = Conectar::Banco()->prepare($sql);
            $stmt->bindValue(1, $p->getEmail());
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                echo "<script>alert('{$p->getEmail()} já está cadastrado')</script>";
                return false;
            }else{
                $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?,?,?)";
                $stmt = Conectar::Banco()->prepare($sql);
                $stmt->bindValue(1, $p->getNome());
                $stmt->bindValue(2, $p->getEmail());
                $stmt->bindValue(3, password_hash($p->getSenha(), PASSWORD_DEFAULT));
                $stmt->execute();
        
                if($stmt) {
                    echo "<script>alert('cadastro realizado com sucesso')</script>";
                    $login = new UsuarioRegras;
                    $login->Entrar($p->getEmail(), $p->getSenha());
                    return true;
                }
            }
        }
    }

    /**
     * Mostrar dados do usuário
     */
    function MostrarUsuario($id) {
        $sql = "SELECT * FROM usuario WHERE id = ?";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if($stmt) {
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        }else{
            echo "<script>alert('usuário não encontrado')</script>";
        }
    }

    /**
     * Excluir usuário
     */
    function DeletaUsuário($id) {
        $sql = "DELETE FROM usuario WHERE id = ?";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if($stmt) {
            echo "<script>alert('usuário excluído com sucesso')</script>";
            return true;
        }else{
            echo "<script>alert('erro ao excluir conta')</script>";
            return false;
        }
    }

    /**
     * Atualiza dados do usuário
     */
    function AtualizaUsuario() {

    }

    /**
     * Iniciar sessão
     */
    function Entrar($email, $senha) {
        /**
         * Verifica se o email do login pertence à tabela de usuários
         */
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($senha, $res['senha'])){
                if(!isset($_SESSION)) session_start();
                $_SESSION['id'] = $res['id'];
                $_SESSION['perfil'] = $res['perfil'];
                $_SESSION['nome'] = $res['nome'];
                $_SESSION['email'] = $res['email'];
                
                echo "<script>alert('bem vindo(a), {$_SESSION['nome']}')</script>";
                echo '<script>location.href="http://localhost/j-store"</script>';
                return true;
            }else{
                echo "<script>alert('senha incorreta')</script>";
            }
        }else{
            /**
             * Verifica se o email do login pertence à tabela de vendedores
             */
            $sql = "SELECT * FROM vendedor WHERE email = ?";
            $stmt = Conectar::Banco()->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if(password_verify($senha, $res['senha'])) {
                    if(!isset($_SESSION)) session_start();
                    $_SESSION['id'] = $res['id'];
                    $_SESSION['perfil'] = $res['perfil'];
                    $_SESSION['nome'] = $res['nome'];
                    $_SESSION['email'] = $res['email'];

                    echo "<script>alert('bem vindo(a), {$_SESSION['nome']}')</script>";
                    echo '<script>location.href="http://localhost/j-store"</script>';
                    return true;
                }else{
                    echo "<script>alert('SENHA INCORRETA')</script>";
                }
            }else{
                echo "<script>alert('$email NÃO ESTÁ CADASTRADO')</script>";
                
            }
        }
        return false;
    }

    /**
     * Encerrar sessão 
     */
    function Sair() {
        if(!isset($_SESSION)) session_start();
        unset($_SESSION['id'], $_SESSION['perfil'], $_SESSION['email']);
        echo "<script>alert('sua sessão foi encerrada')</script>";
        echo "<script>location.href = 'http://localhost/j-store'</script>";
        exit;
    }
}