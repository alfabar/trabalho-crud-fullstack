<?php
require_once "../../src/Acesso.php";
$sessao = new Acesso;
$sessao->verificaAcesso();
$sessao->verificaPermissao();

if( isset($_SESSION['id']) ){
    require "../../src/Usuario.php";
    $usuario = new Usuario;
    $usuario->setId($_GET['id']);
    $usuario->excluirUsuario();
    header("location:listar.php");
}