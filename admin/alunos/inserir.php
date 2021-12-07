<?php
//Verifica acesso antes de acessar recursos
require_once "../../src/Acesso.php";
$sessão = new Acesso;
$sessão->verificaAcesso();
//Acessa as classe semente apos verificar usuario
require_once "../../src/Alunos.php";

$alunos = new Aluno;


if(isset($_POST['inserir'])){
  $total = ($_POST['p_nota'] + $_POST['s_nota'] )/2;
  if($total >= 7)
  {
    $total = "Aprovado";
  }
  else
  {
    $total = "Reprovado";
  }
  $alunos->setNome($_POST['nome']);
  $alunos->setNota($_POST['p_nota']);
  $alunos->setNota1($_POST['s_nota']);
  //$media = ($alunos->getNota() + $alunos->getNota1()/2);
  $alunos->setMedia($_POST['media']);
  $alunos->setSituacao($total);


  
    $alunos->inserirAluno();
    header("location:listar.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Alunos | UPDATE - CRUD com PHP e MySQL </title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link href="../../css/style.css" rel="stylesheet">
<style>

</style>
</head>
<body>

<header class="sticky-top border-bottom border-dark">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <h1 class="navbar-brand">Alunos | Inserir </h1>
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
    <h2>Utilize o formulário abaixo para atualizar os dados de um Aluno.</h2>
    
    <form action="#" method="post">
        <p class="form-group">
            <label class="form-label" for="nome">Nome:</label>
	        <input class="form-control" value="<?=$dados['nome']?>" type="text" name="nome" id="nome" required>
        </p>

        <p class="form-group">
            <label class="form-label" for="p_nota">Primeira nota:</label>
	        <input class="form-control" value="<?=$dados['p_nota']?>" type="number" name="p_nota" id="p_nota" min="0" max="15000" step="0.01" required>
        </p>

        <p class="form-group">
            <label class="form-label" for="s_nota">Segunda nota:</label>
	        <input class="form-control" value="<?=$dados['s_nota']?>" type="number" name="s_nota" id="s_nota" min="0" max="100" step="1" required>
        </p>
       



        <p class="form-group">
        <span id="ValorNota" name="valorNota"></span><br>
        <span id="situacao" name="situacao"></span>
        <span id="mensagem" name="mensagem"></span>
            <label class="form-label" for="media">Media:</label>
	        <input class="form-control" value="<?=$dados['media']?>" type="number" name="media" id="media" min="0" max="15000" step="0.01">

        </p>   
	    <p class="form-group">
            <label class="form-label" for="situacao"></label>
	        <input class="form-control" type="hidden" value="<?=$dados['situacao']?>" name="situacao" id="situacao"></input>
        </p>
	    
        <button class="btn btn-success"  name="calcular">Calcular media</button>
        <button class="btn btn-primary" onclick="return confirm('Tem certeza que deseja inserir este registro?')" name="inserir">Inserir Aluno</button>
	</form>	   

<pre><?php var_dump($dados['media']) ?></pre>

</div>


<script>
var campo1 = document.getElementById("p_nota");
var campo2 = document.getElementById("s_nota");
var media = document.getElementById("media");
var resultado = document.getElementById("ValorNota");
var reprovado = document.getElementById("situacao");
var aprovado = document.getElementById("situacao");


function trocaCor() {
  document.getElementById("situacao").style.color = "red";
}
function Aprovado() {
  document.getElementById("situacao").style.color = "green";
}

var somenteNumeros = new RegExp("[^0-9]", "g");

var toNumber = function (value) {
  var number = value.replace(somenteNumeros, "");    
  number = parseInt(number);    
  if (isNaN(number)) 
    number = 0;
  return number;
}

var somenteNumeros = function (event) {
  event.target.value = toNumber(event.target.value);
}

var onInput = function (event) {
  var num1 = toNumber(p_nota.value);
  var num2 = toNumber(s_nota.value);
  var calc = num1 + num2
  resultado.textContent = calc + " media / " + eval(calc)/2;

  media = (num1 + num2)/2;
  if(media < 7){
    reprovado.textContent = ("Reprovado");
    trocaCor();

  }
  else if(media > 7){
    aprovado.textContent = ("Aprovado");
    Aprovado();
  }
  function Media(){
    document.getElementById('media').value = calc;
  }

  document.getElementById('media').value = media;

}

p_nota.addEventListener("input", somenteNumeros);
s_nota.addEventListener("input", somenteNumeros);
resultado.addEventListener("input", somenteNumeros);
resultado.addEventListener("input", onInput);
p_nota.addEventListener("input", onInput);
s_nota.addEventListener("input", onInput);

onInput();

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>