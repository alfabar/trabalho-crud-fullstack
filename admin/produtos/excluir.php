<?php
require_once "../../src/Acesso.php";
$sessao = new Acesso;
$sessao->verificaAcesso();

if( isset($_SESSION['id']) ){
    require_once "../../src/Produto.php";
    $produto = new Produto;
    $produto->setId($_GET['id']);
    $produto->excluirProduto();
    header("location:listar.php");
}