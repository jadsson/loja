<?php 
    require_once 'BancoConecta.php';
    require_once 'ComentarioCria.php';

    class ComentarioRegras {
        function RegistraComentario(ComentarioCria $p) {
            $sql = "INSERT INTO comentario (conteudo, fk_coment_usuario, fk_coment_produto, fk_coment_vendedor) VALUES (?,?,?,?)";
            $stmt = Conectar::Banco()->prepare($sql);
            $stmt->bindValue(1, $p->getCom());
            $stmt->bindValue(2, $p->getIdU());
            $stmt->bindValue(3, $p->getIdP());
            $stmt->bindValue(4, $p->getIdV());
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return true;
            }
            return false;
        }

        function RespostaDoVendedor(ComentarioCria $p) {
            $sql = "SELECT * FROM reposta WHERE fk_coment = ?";
            $stmt = Conectar::Banco()->prepare($sql);
            $stmt->bindValue(1, $p->getId());
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                echo "<script>alert('já há uma resposta para este comentário')</script>";
                return false;
            }else {
                $sql = "INSERT INTO reposta (conteudo, fk_coment) VALUES (?,?)";
                $stmt = Conectar::Banco()->prepare($sql);
                $stmt->bindValue(1, $p->getCom());
                $stmt->bindValue(2, $p->getId());
                $stmt->execute();
                if($stmt) {
                    echo "<script>alert('resposta enviada')</script>";
                    return true;
                }
            }
        }

        function MostraComentarios($id) {
            $sql = "SELECT c.id, c.conteudo, c.dia_hora, u.nome, p.id_produto FROM comentario as c
                    INNER JOIN produto as p ON p.id_produto = c.fk_coment_produto AND p.id_produto = $id
                    INNER JOIN usuario as u ON c.fk_coment_usuario = u.id ORDER BY c.dia_hora DESC";
            $stmt = Conectar::Banco()->query($sql);
            if($stmt->rowCount() > 0) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            }
            return [];
        }

        function MostraResposta($id) {
            $sql = "SELECT * FROM reposta WHERE fk_coment = ?";
            $stmt = Conectar::Banco()->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;
            }
            return false;
        }
    }