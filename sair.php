<?php 
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['email'])) {
        header('location: index.php');
        exit;
    }
    
    require_once 'php/regras/UsuarioRegras.php';

    $s = new UsuarioRegras;
    $s->Sair();
