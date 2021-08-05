<?php 
    require_once 'ProdutoCria.php';
    require_once 'BancoConecta.php';

class ProdutoRegras {
    /**
     * Registrar produto
     */
    function RegistraProduto(ProdutoCria $p) {
        $sql = "INSERT INTO produto (nome_produto, preco, desc_produto, categoria, qtd, fk_produto_vendedor, img_produto) VALUES (?,?,?,?,?,?,?)";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $p->getNome());
        $stmt->bindValue(2, $p->getPreco());
        $stmt->bindValue(3, $p->getDesc());
        $stmt->bindValue(4, $p->getCateg());
        $stmt->bindValue(5, $p->getQtd());
        $stmt->bindValue(6, $p->getVendedor());
        $stmt->bindValue(7, $p->getImg());
        $stmt->execute();

        if($stmt) {
            echo "<script>alert('{$p->getNome()} registrado com sucesso')</script>";
            echo "<script>location.href = 'http://localhost/j-store/produtos.php'</script>";
            return true;
        }
        return "<script>alert('falha ao cadastrar produto')</script>";
    }
    
    /**
     * Mostrar produtos na busca
     */
    function MostraProduto($busca) {
        $sql = "SELECT * FROM produto WHERE nome_produto LIKE '%$busca%' OR desc_produto LIKE '%$busca%' ORDER BY clique DESC";
        $stmt = Conectar::Banco()->query($sql);
        if($stmt->rowCount() > 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    /**
     * Mostrar apenas um produto
     */
    function MostraProdutoUnico($id) {
        $sql = "SELECT * FROM produto WHERE id_produto = ?";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }
    /**
     * Mostra produtos por categoria
     */
    function MostraProdutoPorCategoria($categoria) {
        $sql = "SELECT * FROM produto WHERE categoria = ? ORDER BY clique DESC";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $categoria);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    /**
     * Mostra produtos mais vistos
     */
    function MostraProdutoMaisVisto() {
        $sql = "SELECT * FROM produto WHERE qtd > 0 ORDER BY clique DESC LIMIT 10";
        $stmt = Conectar::Banco()->query($sql);
        
        if($stmt->rowCount() > 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    /**
     * Comprar Produto
     */
    function CompraProduto($idProduto, $idComprador, $idVendedor) {
        $sql = "SELECT qtd FROM produto WHERE id_produto = ?";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $idProduto);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            
            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            if($res['qtd'] != 0) {
                $sql = "INSERT INTO venda (fk_venda_produto, fk_venda_comprador, fk_venda_vendedor) VALUES (?,?,?)";
                $stmt = Conectar::Banco()->prepare($sql);
                $stmt->bindValue(1, $idProduto);
                $stmt->bindValue(2, $idComprador);
                $stmt->bindValue(3, $idVendedor);
                $stmt->execute();
                if($stmt->rowCount() > 0) {
                    $qtd = $res['qtd'];
                    $qtdAtual = $qtd-1;
                    $sql = "UPDATE produto SET qtd = '$qtdAtual' WHERE id_produto = '$idProduto'";
                    $stmt = Conectar::Banco()->query($sql);
                    
                    return true;
                }
                return false;
            }else{
                echo "<script>alert('infelizmente este produto não está disponível')</script>";
                return false;
            }
        }
    }
    /**
     * Mostra produtos comprados pelo cliente
     */
    function MostraProdutoComprado($cliente) {
        $sql = "SELECT p.nome_produto, p.img_produto, p.preco, venda.hora_venda, v.nome FROM produto as p 
                INNER JOIN venda ON p.id_produto = venda.fk_venda_produto
                INNER JOIN usuario as u ON u.id = venda.fk_venda_comprador AND u.id = ?
                INNER JOIN vendedor as v ON v.id = venda.fk_venda_vendedor AND v.id = 1
                ORDER BY venda.hora_venda DESC";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $cliente);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return false;
    }

    /**
     * Mostra todos os vendidos
     */
    function MostraProdutoVendido() {
        $sql = "SELECT v.hora_venda, u.nome, p.id_produto, p.nome_produto, p.preco, p.desc_produto, p.img_produto FROM venda as v
                INNER JOIN produto as p ON v.fk_venda_produto = p.id_produto
                INNER JOIN usuario as u ON u.id = v.fk_venda_comprador 
                ORDER BY v.hora_venda DESC";
        $stmt = Conectar::Banco()->query($sql);
        if($stmt->rowCount() > 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    /**
     * Mostra produtos de um vendedor
     */
    function MostraProdutoDoVendedor($vendedor) {
        $sql = "SELECT * FROM produto WHERE fk_produto_vendedor = ? ORDER BY clique DESC";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $vendedor);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return false;
    }

    /**
     * Recomendados na página de compra
     */
    function MostraRecomendados($categoria, $produtoAtual) {
        $sql = "SELECT * FROM produto WHERE categoria = ? AND id_produto != ? ORDER BY clique DESC LIMIT 7";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $categoria);
        $stmt->bindValue(2, $produtoAtual);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    /**
     * Adiciona clique
     */
    function AdicionaClique($id) {
        $sql = "SELECT clique FROM produto WHERE id_produto = ?";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            $clique = $res['clique'];
            $clique++;
            $nsql = "UPDATE produto SET clique = '$clique' WHERE id_produto = '$id'";
            $nstmt = Conectar::Banco()->query($nsql);

            if($nstmt) {
                return true;
            }
        }
        return false;
    }

    /**
     * Atualiza quantidade de produtos
     */
    function AtualizaDados(ProdutoCria $p) {
        $sql = "UPDATE produto SET nome_produto = ?, preco = ?, qtd = ?, desc_produto = ? WHERE id_produto = ?";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $p->getNome());
        $stmt->bindValue(2, $p->getPreco());
        $stmt->bindValue(3, $p->getQtd());
        $stmt->bindValue(4, $p->getDesc());
        $stmt->bindValue(5, $p->getId());
        $stmt->execute();

        if($stmt) {
            return true;
        }
        return false;
    }

    /**
     * Excluir produto
     */
    function DeletaProduto($id) {
        $sql = "DELETE FROM produto WHERE id_produto = '$id'";
        $stmt = Conectar::Banco()->query($sql);
        if($stmt) {
            echo "<script>alert('Produto excluído com sucesso')</script>";
            echo "<script>location.href='http://localhost/j-store/produtos.php'</script>";
            return true;
        }else{
            echo "<script>alert('falha ao excluir produto')</script>";
            return false;
        }
    }

    // -- CARRINHO DE COMPRAS

    /**
     * Inserir produtos no carrinho
     */
    function InserirNoCarrinho($id_usuario, $id_produto) {
        $sql = "SELECT * FROM carrinho WHERE fk_carrinho_usuario = '$id_usuario' AND fk_carrinho_produto = '$id_produto'";
        $stmt = Conectar::Banco()->query($sql);
        if($stmt->rowCount() > 0) {
            echo "<script>alert('este produto já está no seu carrinho')</script>";
            echo "<script>location.href = 'http://localhost/j-store/carrinho.php'</script>";
            return false;
        }else{
            $sql = "INSERT INTO carrinho (fk_carrinho_usuario, fk_carrinho_produto) VALUES (?,?)";
            $stmt = Conectar::Banco()->prepare($sql);
            $stmt->bindValue(1, $id_usuario);
            $stmt->bindValue(2, $id_produto);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                return true;
            }
        }
    }

    /**
     * Mostrar produtos do carrinho
     */
    function MostraProdutoDoCarrinho($id) {
        $sql = "SELECT u.id, p.id_produto, p.categoria, p.nome_produto, p.preco, p.desc_produto, p.qtd, p.img_produto, c.id
                FROM produto as p INNER JOIN carrinho as c INNER JOIN usuario as u
                WHERE u.id = c.fk_carrinho_usuario AND u.id = $id AND p.id_produto = c.fk_carrinho_produto
                ORDER BY c.id DESC";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    /**
     * Remover produtos do carrinho
     */
    function RemoverDoCarrinho($idUsuario, $idProduto) {
        $sql = "DELETE FROM carrinho WHERE fk_carrinho_usuario = ? AND fk_carrinho_produto = ?";
        $stmt = Conectar::Banco()->prepare($sql);
        $stmt->bindValue(1, $idUsuario);
        $stmt->bindValue(2, $idProduto);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            echo "<script>alert('produto removido do carrinho')</script>";
            echo "<script>location.href = 'http://localhost/j-store/carrinho.php'</script>";
            return true;
        }
        return false;
    }

}