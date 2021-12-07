<?php
//Verifica acesso antes de acessar recursos
require_once "../../src/Acesso.php";
$sessão = new Acesso;
$sessão->verificaAcesso();
//Acessa as classe semente apos verificar usuario

// Importando a classe Fabricante
require "../../src/Fabricante.php";

// Criando um objeto para fabricante
$fabricante = new Fabricante;

// Obtendo a relação de fabricantes via método
$listaDeFabricantes = $fabricante->lerFabricantes();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Fabricantes | SELECT - CRUD com PHP e MySQL </title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link href="../../css/style.css" rel="stylesheet">
</head>
<body>

<header class="sticky-top border-bottom border-dark">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <h1 class="navbar-brand">Fabricantes | SELECT</h1>
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
    
    <h2>Lendo e carregando todos os fabricantes</h2>
    <p><a class="btn btn-primary" href="inserir.php">Inserir</a></p>    

    <table class="table table-striped table-hover">
        <caption> Lista de Fabricantes </caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th class="text-center">Operação</th>
            </tr>
        </thead>
                
        <tbody>

<?php foreach( $listaDeFabricantes as $arrFabricante ){ ?>
            <tr>
                <td> <?=$arrFabricante['id']?> </td>
                <td> <?=$arrFabricante['nome']?> </td>
                <td class="text-center">
    <a class="btn btn-warning" href="atualizar.php?id=<?=$arrFabricante['id']?>">Atualizar</a>
    <a class="btn btn-danger" href="excluir.php?id=<?=$arrFabricante['id']?>">Excluir</a>
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