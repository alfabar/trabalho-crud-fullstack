<?php
require_once "../../src/Acesso.php";
$sessao = new Acesso;
$sessao->verificaAcesso();
$sessao->verificaPermissao();


require "../../src/Usuario.php";
$usuario = new Usuario;
$listarUsuarios = $usuario->lerUsuarios();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Usuários | SELECT - CRUD com PHP e MySQL </title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link href="../../css/style.css" rel="stylesheet">
</head>
<body>

<header class="sticky-top border-bottom border-dark">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <h1 class="navbar-brand">Usuários | SELECT</h1>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">        
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Home</a>
          </li>        
        </ul>
      </div>
    </div>
  </nav>
</header>
      

<div class="container">
    
    <h2>Lendo e carregando todos os usuários</h2>
    <p><a class="btn btn-primary" href="inserir.php">Inserir</a></p>    

    <table class="table table-striped table-hover">
        <caption> Lista de Usuários </caption>
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Tipo</th>
                <th class="text-center">Operação</th>
            </tr>
        </thead>
                
        <tbody>
        <?php foreach( $listarUsuarios as $dadosUsuario ){ ?>
            <tr>
                <td> <?=$dadosUsuario['nome']; ?></td>
                <td> <?=$dadosUsuario['email']; ?></td>
                <td> <?=$dadosUsuario['tipo']; ?></td>
                <td class="text-center">
                    <a class="btn btn-warning" href="atualizar.php?id=<?=$dadosUsuario['id']?>">Atualizar</a>
                    <a class="btn btn-danger" href="excluir.php?id=<?=$dadosUsuario['id']?>">Excluir</a>
                </td>
            </tr>

            <?php } ?>

        </tbody>

    </table>
 
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>