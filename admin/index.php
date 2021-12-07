<?php
require_once "../src/Acesso.php";
$sessão = new Acesso;
$sessão->verificaAcesso();
///



if(isset($_GET['sair']))
$sessão->logout();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Área administrativa - CRUD PHP e MySQL com controle de acesso </title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link href="../css/style.css" rel="stylesheet">

</head>
<body>
<div class="container">    
    <article class="jumbotron my-4 shadow text-center">
        <h1 class="display-4">Olá! <?=$_SESSION['nome']?></h1>
        <?php if(isset($_GET['nao_permitido'])){?>
            <p class="alert alert-danger"> Voçe nao tem permissão</p>
        <?php } ?>
        <p class="lead">Você está na área administrativa. <span class="badge badge-info"> <?=$_SESSION['tipo']?></span></p>
        <p class="lead">Operações de <b>inserção</b>, <b>leitura</b>, <b>atualização</b> e <b>exclusão</b> de dados.</p>
        <hr>
        <a class="btn btn-primary btn-lg" href="alunos/listar.php">Alunos</a> 
        <a class="btn btn-primary btn-lg" href="fabricantes/listar.php">Fabricantes</a> 
        <a class="btn btn-primary btn-lg" href="produtos/listar.php">Produtos</a>
        <?php if($_SESSION['tipo'] == "administrador"){?>
        <a class="btn btn-primary btn-lg" href="usuarios/listar.php">Usuários</a>
        <?php }?>
        <p class="my-2">
            <a class="btn btn-danger" href="?sair">&times; Sair</a>
        </p>
    </article>    
</div>
</body>
</html>