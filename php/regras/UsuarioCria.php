<?php 

    class UsuarioCria {
        private $id, $perfil, $nome, $email, $senha;

        function getId()        { return $this->id; }
        function getPerfil()    { return $this->perfil; }
        function getNome()      { return $this->nome; }
        function getEmail()     { return $this->email; }
        function getSenha()     { return $this->senha; }
        function setId($id)     { $this->id = $id; }
        function setPerfil($p)  { $this->perfil = $p; }
        function setNome($n)    { $this->nome = $n; }
        function setEmail($e)   { $this->email = $e; }
        function setSenha($s)   { $this->senha = $s; }
    }