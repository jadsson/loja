<?php 

    class ComentarioCria {
        private $id, $conteudo, $idProduto, $idUsuario, $idVendedor;

        function getId()    { return $this->id; }
        function getCom()   { return $this->conteudo; }
        function getIdP()   { return $this->idProduto; }
        function getIdU()   { return $this->idUsuario; }
        function getIdV()   { return $this->idVendedor; }
        function setId($id) { $this->id = $id; }
        function setCom($c) { $this->conteudo = $c; }
        function setIdP($p) { $this->idProduto = $p; }
        function setIdU($u) { $this->idUsuario = $u; }
        function setIdV($v) { $this->idVendedor = $v; }
    }