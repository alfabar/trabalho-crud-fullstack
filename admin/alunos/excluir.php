<?php
require_once "../../src/Acesso.php";
$sessao = new Acesso;
$sessao->verificaAcesso();

if( isset($_SESSION['id']) ){
    require_once "../../src/Alunos.php";
    $aluno = new Aluno;
    $aluno->setId($_GET['id']);
    $aluno->excluirAluno();
    header("location:listar.php");
}