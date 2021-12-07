<?php 
require_once "src/Acesso.php";
require_once "src/Usuario.php";

//detectar os parametros de url
if(isset($_GET['senha_incorreta'])){
    $mensagem = "Senha incorreta, verifique e digite novamente";

}elseif(isset($_GET['nao_encontrado'])){
    $mensagem = "Usuario nao encontrado no sistema";
}elseif(isset($_GET['acesso_negado'])){    
    $mensagem = "Voce deve Logar Primeiro";
}elseif(isset($_GET['logout'])){    
    $mensagem = "Voce saiu do sistema";

}

if(isset($_POST['entrar']))
{
    $usuario = new Usuario;
    $usuario->setEmail($_POST['email']);
    $dados = $usuario->buscaUsuario();
    
    //var_dump($dados);
    //se foi localizado um usuario pelo email

    if( $dados != null){
        //então verificamos a senha digitada com o banco
        if(password_verify($_POST['senha'], $dados['senha'])){
            $sessao = new Acesso;
            $sessao->login($dados['id'], $dados['nome'], $dados['tipo']);
        }
        else
        {
            //se a senha for diferente não loga
            header("location:index.php?senha_incorreta");
        }
    }else{
        header("location:index.php?nao_encontrado");
    }    
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> CRUD PHP e MySQL com controle de acesso </title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">

    <div class="jumbotron my-4 shadow text-center">
        <h1 class="display-4">CRUD PHP e MySQL com controle de acesso</h1>
        <hr class="my-4">
        <h2 class="lead">Consultar produtos existentes</h2>
        <form action="resultado.php" method="GET" class="form-inline justify-content-center">
            <input type="search" class="form-control mr-2" name="busca" id="busca">
            <button type="submit" class="btn btn-primary" >OK</button>
        </form>
        <h2 class="lead">Deseja realizar tarefas administrativas? Então entre com seu e-mail e senha para acessar o sistema.</h2>
        <hr class="my-4">
        
        
        <form action="" class="w-50 mx-auto" method="post">
            <?php if(isset($mensagem)){ ?>
                
            <p class="alert alert-warning">
                <?=$mensagem?>
            </p>
        <?php } ?>
            <p class="form-group text-left">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control">

            </p>
            <p class="formgroup">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" name="senha" id="senha" class="form-control">

            </p>
            <button type="submit" class="btn btn-primary" name="entrar">Entrar</button>
        </form>
    </div>     
</div>
</body>
</html>