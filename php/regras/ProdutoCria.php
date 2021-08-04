<?php 

    class ProdutoCria {
        private $id, $nome, $preco, $desc, $categoria, $qtd, $vendedor, $img;

        function getId()                { return $this->id; }
        function getNome()              { return $this->nome; }
        function getPreco()             { return $this->preco; }
        function getDesc()              { return $this->desc; }
        function getCateg()             { return $this->categoria; }
        function getQtd()               { return $this->qtd; }
        function getVendedor()          { return $this->vendedor; }
        function getImg()               { return $this->img; }
        function setId($id)             { $this->id = $id; }
        function setNome($n)            { $this->nome = $n; }
        function setPreco($p)           { $this->preco = $p; }
        function setDesc($d)            { $this->desc = $d; }
        function setCateg($c)           { $this->categoria = $c; }
        function setQtd($qtd)           { $this->qtd = $qtd; }
        function setVendedor($vend)     { $this->vendedor = $vend; }
        function setImg($img)           { $this->img = $img; }
    }