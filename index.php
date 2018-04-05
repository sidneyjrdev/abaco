<?php
session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ábaco interativo - ensino de matemática</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <link href="jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/abacoHome.js" type="text/javascript"></script>
        <script src="js/multiplicacao.js" type="text/javascript"></script>
        <script src="js/script.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        
        
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
          
        <link rel="shortcut icon" type="image/png" href="img/icone.png"/>
        
    </head>
    <body>
          
        <?php if(isset($_SESSION['nomeProfessor']) && @$_GET['pagina'] != "login"){ ?>
<!-- cabeçalho -->

 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="?pagina=home"><img src='img/logo.png' alt=''></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="?pagina=home">Home</a></li>
        <li><a href="?pagina=addAluno">Adicionar aluno à lista</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="?pagina=perfil">Perfil</a></li>
        <li><a href="?pagina=logout">Sair</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
 
        <?php }else if(isset($_SESSION['nomeUsuario']) && $_SESSION['nomeUsuario'] == "%global%adm"){ ?>
            
   <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="?pagina=home"><img src='img/logo.png' alt=''></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="?pagina=home">Professores pendentes</a></li>
        <li><a href="?pagina=listaAdm">Lista de alunos</a></li>
        <li><a href="?pagina=cadastrarEscola">Cadastrar escola</a></li>
        <li><a href="?pagina=gerenciarEscolas">Gerenciar escolas</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
       
          <li><p class="navbar-text tituloAdm">PAINEL DO ADMINISTRADOR</p></li>
        <li><a href="?pagina=logout">Sair</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>         
  
 
            
            <?php }else { ?>

<!-- cabeçalho -->

 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="?pagina=home"><img src='img/logo.png' alt=''></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="?pagina=home">Home</a></li>
        <li><a href="?pagina=funcionamento">Funcionamento do ábaco</a></li>
        <li><a href="?pagina=multiplicacao">Multiplicação</a></li>
        <li><a href="?pagina=quiz">Quiz</a></li>
        <?php if(isset($_SESSION['nome'])){ ?>
        <li><a href="?pagina=ranking">Ranking</a></li>
        <?php } ?>
        <li><a href="?pagina=reportarBug">Reportar bug</a></li>
     </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <?php
        if(isset($_SESSION['nome'])){ ?>
        <li><a href="?pagina=perfil">Perfil</a></li>
        <li><a href="?pagina=logout" class="btnSair" role="button">Sair</a></li>
        <?php }else{ ?>
        <li><a href="?pagina=login">Login/Registro</a></li>
        <?php } ?>
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
            <div class="dvConteudo">
            <?php }
              
              //inclusao da página
              require("util/incluirCaminho.php");
           
            ?>
            </div>
            <!-- rodapé -->

            <footer class="panel-footer text-center">
                <span id="spRodape">Todos os direitos reservados</span>


            </footer>

    </body>
</html>
