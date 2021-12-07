<?php
require_once "../../src/Acesso.php";
$sessão = new Acesso;
$sessão->verificaAcesso();

if(isset($_SESSION['id']))
{
    require_once "../../src/Fabricante.php";
    $fabricante = new Fabricante;
    $fabricante->setId( $_GET['id'] );
    $fabricante->excluirFabricante();
    header("location:listar.php");        
}