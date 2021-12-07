<?php
require_once "../../src/Acesso.php";
$sessao = new Acesso;
$sessao->verificaAcesso();
$sessao->verificaPermissao();


require "../../src/Usuario.php";
$usuario = new Usuario;
$usuario->setId($_GET['id']);
$dados = $usuario->lerUmUsuario();

if(isset($_POST['atualizar'])){
  $usuario->setNome($_POST['nome']);
  $usuario->setEmail($_POST['email']);
  $usuario->setTipo($_POST['tipo']);

  /* Se o campo senha está vazio */
  if( empty($_POST['senha']) ){   
    /* então, mantenha a senha já existe no banco */
    $usuario->setSenha($dados['senha']);
  } else {
    /* senão, verifique a senha digitada no form com a senha
    existente no banco.
    
    Sendo iguais, será mantida a mesma senha já existente e codificada no banco. Sendo diferentes, será usada a nova senha com uma nova
    codificação. */
    $usuario->setSenha(
      $usuario->verificaSenha($_POST['senha'], $dados['senha'])
    );
  } // fim if/else senhas

  $usuario->atualizarUsuario();
  header("location:listar.php");
} // fim if isset

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Usuários | UPDATE - CRUD com PHP e MySQL </title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link href="../../css/style.css" rel="stylesheet">
</head>
<body>
<header class="sticky-top border-bottom border-dark">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <h1 class="navbar-brand">Usuários | SELECT e UPDATE </h1>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">        
          <li class="nav-item">
              <a href="listar.php" class="nav-link">Listar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Home</a>
          </li>        
        </ul>
      </div>
    </div>
  </nav>
</header>

<div class="container">

    <h2>Utilize o formulário abaixo para atualizar os dados de um usuário.</h2>

    <form action="" method="post" class="w-50">
        <p class="form-group">
            <label class="form-label" for="nome">Nome:</label><br>
	        <input value="<?= $dados['nome']?>" class="form-control" type="text" name="nome" id="nome" required>
        </p>

        <p class="form-group">
            <label class="form-label" for="nome">E-mail:</label><br>
	        <input value="<?= $dados['email']?>" class="form-control" type="email" name="email" id="email" required>
        </p>

        <p class="form-group">
            <label class="form-label" for="nome">Senha:</label><br>
	        <input placeholder="Preencha apenas se for alterar" class="form-control" type="password" name="senha" id="senha" >
        </p>

        <p class="form-group">
            <span class="my-2 d-block">Tipo de usuário:</span> 

            <input  <?php if($dados['tipo'] == 'comun') echo "checked"; ?> type="radio" name="tipo" id="comum" value="comum" required>
            <label class="form-label" for="comum">Comum</label>
	        
            <input <?php if($dados['tipo'] == 'administrador') echo "checked"; ?> type="radio" name="tipo" id="administrador" value="administrador" required>
            <label class="form-label" for="administrador">Administrador</label>
        </p> 
        <button class="btn btn-primary" name="atualizar">Atualizar usuário</button>
	</form>	

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>