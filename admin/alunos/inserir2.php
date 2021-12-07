<?php
//Verifica acesso antes de acessar recursos
require_once "../../src/Acesso.php";
$sessão = new Acesso;
$sessão->verificaAcesso();
//Acessa as classe semente apos verificar usuario
require_once "../../src/Alunos.php";

$aluno = new Aluno;


if( isset($_POST['inserir']) ){
    $aluno->setNome($_POST['nome']);
    $aluno->setNota($_POST['p_nota']);
    $aluno->setNota1($_POST['s_nota']);
    $media = ($aluno->getNota() + $aluno->getNota1()/ 2);
    $aluno->setMedia($_POST['media']);
    $aluno->setSituacao($_POST['situacao']);
    $aluno->inserirAluno();
    header("location:listar.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Alunos | INSERT - CRUD com PHP e MySQL </title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link href="../../css/style.css" rel="stylesheet">
</head>
<body>

<header class="sticky-top border-bottom border-dark">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <h1 class="navbar-brand">Alunos | INSERT </h1>
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
    
    <h2>Utilize o formulário abaixo para cadastrar um Aluno.</h2>    		
    
	<form action="#" method="post">
	    <p class="form-group">
            <label class="form-label" for="nome">Nome:</label>
	        <input class="form-control" type="text" name="nome" id="nome" required>
        </p>

        <p class="form-group">
            <label class="form-label" for="preco">Primeira nota:</label>
	        <input class="form-control" type="number" name="p_nota" id="p_nota" min="0" max="15000" step="0.01" required>
        </p>

        <p class="form-group">
            <label class="form-label" for="quantidade">segunda nota:</label>
	        <input class="form-control" type="number" name="s_nota" id="s_nota" min="0" max="100" step="1" required></p>
          <p class="form-group">
            <label class="form-label" for="quantidade">media:</label>
	        <input class="form-control" value="<?php echo $media;?>" type="hidden" name="media" id="media"></p>
	    
        
	    <p class="form-group">
            <label class="form-label" for="descricao">situacao:</label>
	        <input class="form-control" type="hidden" name="situacao" id="situacao" rows="3" cols="40" maxlength="500" ></input>
        </p>
	    
        <button class="btn btn-primary" name="inserir">Inserir Aluno</button>
	</form>	


</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>