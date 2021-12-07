<?php
require_once "../../src/Acesso.php";
$sessao = new Acesso;
$sessao->verificaAcesso();


require_once "../../src/Alunos.php";
$aluno = new Aluno;
$listaDeAlunos = $aluno->lerAlunos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Alunos | SELECT - CRUD com PHP e MySQL </title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link href="../../css/style.css" rel="stylesheet">
</head>
<body>

<header class="sticky-top border-bottom border-dark">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <h1 class="navbar-brand">Alunos | SELECT</h1>
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
    <h2>Lendo e carregando todos os Alunos</h2>
    <p><a class="btn btn-primary" href="inserir.php">Inserir</a></p> 
    <table class="table table-striped table-hover">
        <caption> Lista de Alunos </caption>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Primeira nota</th>
                <th>Segunda nota</th>
                <th>Media</th>
                <th>Situação</th>
                <th class="text-center">Operação</th>
            </tr>
        </thead>
<tbody>
<?php foreach($listaDeAlunos as $dadosAluno) { ?>
<tr class="<?php if($dadosAluno['situacao'] == 'Aprovado'){echo "table-success";}else{echo "table-danger";}?>">
  <td><?=$dadosAluno['nome']?></td>
  <td><?=$dadosAluno['p_nota']?></td>
  <td><?=$dadosAluno['s_nota']?></td>
  <td><?=$dadosAluno['media']?></td>
  <td><?=$dadosAluno['situacao']?></td>
  <td>
  <a class="btn btn-warning" onclick="return confirm('Tem certeza que deseja Atualizar os dados')" href="atualizar.php?id=<?=$dadosAluno['id']?>">Atualizar</a>
  <a class="btn btn-danger" onclick="return confirm('Tem certeza que deseja Excluir este registro?')" href="excluir.php?id=<?=$dadosAluno['id']?>">Excluir</a>
  </td>
</tr> 
<?php } ?>
</tbody>
</table>
</div> <!-- fim da div row -->

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>