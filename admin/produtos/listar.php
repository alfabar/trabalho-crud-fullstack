<?php
require_once "../../src/Acesso.php";
$sessao = new Acesso;
$sessao->verificaAcesso();


require_once "../../src/Produto.php";
$produto = new Produto;
$listaDeProdutos = $produto->lerProdutos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Produtos | SELECT - CRUD com PHP e MySQL </title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link href="../../css/style.css" rel="stylesheet">
</head>
<body>

<header class="sticky-top border-bottom border-dark">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <h1 class="navbar-brand">Produtos | SELECT</h1>
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

<div class="container my-4">
    
    <h2>Lendo e carregando todos os produtos</h2>
    <p><a class="btn btn-primary" href="inserir.php">Inserir</a></p>  

<div class="row"> <!-- inicio da div row (habilitar o grid system) -->

<?php foreach($listaDeProdutos as $dadosProduto) { ?>

  <div class="col-sm-6 col-md-4"> <!-- inicio das colunas -->
    <ul class="list-group">
        <li class="list-group-item"><b>Nome:</b> <?=$dadosProduto['nome']?> </li>
        <li class="list-group-item"><b>Preço:</b> 
        <?=$produto->formataPreco($dadosProduto['preco'])?> 
        </li>
        <li class="list-group-item"><b>Quantidade:</b> 
        <?=$dadosProduto['quantidade']?> </li>
        <li class="list-group-item"><b>Descrição:</b> 
        <?=$dadosProduto['descricao']?>  </li>
        <li class="list-group-item"><b>Fabricante:</b> 
        <?=$dadosProduto['fabricante']?> 
        </li>
    </ul>

    <p class="text-center my-2">
        <a class="btn btn-warning"
         href="atualizar.php?id=<?=$dadosProduto['id']?>">Atualizar</a> 
        <a class="btn btn-danger"
        href="excluir.php?id=<?=$dadosProduto['id']?>">Excluir</a>
    </p>

  </div> <!-- fim das colunas -->

<?php } ?>

</div> <!-- fim da div row -->

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>