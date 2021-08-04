<?php 

class Conectar {
    private static $instancia;

    public static function Banco() {
        if(!isset(self::$instancia)) {
            try {
                self::$instancia = new PDO('mysql:dbname=a_loja;host=localhost','root', 'root');
            } catch (Exception $e) {
                echo 'ERRO: '.$e->getMessage();
            }
        }
        return self::$instancia;
    }
}