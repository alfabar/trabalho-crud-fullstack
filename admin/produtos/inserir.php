<?php
//Verifica acesso antes de acessar recursos
require_once "../../src/Acesso.php";
$sessão = new Acesso;
$sessão->verificaAcesso();
//Acessa as classe semente apos verificar usuario
require_once "../../src/Produto.php";
require_once "../../src/Fabricante.php";

$produto = new Produto;
$fabricante = new Fabricante;
$listaDeFabricantes = $fabricante->lerFabricantes();

if( isset($_POST['inserir']) ){
    $produto->setNome($_POST['nome']);
    $produto->setPreco($_POST['preco']);
    $produto->setQuantidade($_POST['quantidade']);
    $produto->setDescricao($_POST['descricao']);
    $produto->setFabricanteId($_POST['fabricante']);

    $produto->inserirProduto();

    header("location:listar.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Produtos | INSERT - CRUD com PHP e MySQL </title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link href="../../css/style.css" rel="stylesheet">
</head>
<body>

<header class="sticky-top border-bottom border-dark">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <h1 class="navbar-brand">Produtos | INSERT </h1>
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

<div class="container my-4">
    
    <h2>Utilize o formulário abaixo para cadastrar um produto.</h2>    		
    
	<form action="#" method="post">
	    <p class="form-group">
            <label class="form-label" for="nome">Nome:</label>
	        <input class="form-control" type="text" name="nome" id="nome" required>
        </p>

        <p class="form-group">
            <label class="form-label" for="preco">Preço:</label>
	        <input class="form-control" type="number" name="preco" id="preco" min="0" max="15000" step="0.01" required>
        </p>

        <p class="form-group">
            <label class="form-label" for="quantidade">Quantidade:</label>
	        <input class="form-control" type="number" name="quantidade" id="quantidade" min="0" max="100" step="1" required></p>
	    
        <p class="form-group">
            <label class="form-label" for="fabricante">Fabricante:</label>
            <select class="custom-select" name="fabricante" id="fabricante" required>
                <!-- Primeiro option é estático e vazio
                (deixa do jeito que está) -->
                <option value=""></option>

                <?php foreach( $listaDeFabricantes as $dadosFabricante ) { ?>
                    <option value="<?=$dadosFabricante['id']?>">
                    <?=$dadosFabricante['nome']?>
                    </option>
                <?php } ?>
                
            </select>
        </p>

	    <p class="form-group">
            <label class="form-label" for="descricao">Descrição:</label>
	        <textarea class="form-control" name="descricao" id="descricao" rows="3" cols="40" maxlength="500" required></textarea>
        </p>
	    
        <button class="btn btn-primary" name="inserir">Inserir produto</button>
	</form>	


</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>