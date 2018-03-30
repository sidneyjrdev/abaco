<?php

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_STRING);

$paginas = [
    "home" => "view/Home.php",
    "login" => "view/Login.php",
    "logout" => "Logout.php",
    "cadUsuario" => "view/CadUsuario.php",
    "mudarSenha" => "view/MudarSenha.php",
    "ranking" => "view/ranking.php",
    "perfil" => "view/PerfilUsuario.php",
    "pontuacao" => "view/saibaMaisPontuacao.php",
    "funcionamento" => "view/funcionamentoAbaco.php",
    "quiz" => "view/quiz.php",
    "addAluno" => "view/adicionarAluno.php",
    "listaAlunos" => "view/listaAlunos.php",
    "multiplicacao" => "view/multiplicacao.php",
    "listaAdm" => "view/listaAdm.php",
    "cadastrarEscola" => "view/cadastrarEscola.php",
    "gerenciarEscolas" => "view/gerenciarEscolas.php",
    "editarEscola" => "view/editarEscola.php",
    "reportarBug" => "view/reportarBug.php"
   ];

if ($pagina) {
    $encontrou = false;
    foreach ($paginas as $key => $value) {

        if ($key == $pagina) {
            $encontrou = true; ?>
            <script>$("a").parent().removeClass("active");</script>
            <script>$("a[href='?pagina=<?=$pagina?>']").parent().addClass("active");</script>
            <?php    
            require_once ($value);
            break;
        }
    }

    if ($encontrou === false) { ?>
        <script>$("a").parent().removeClass("active");</script>
        <script>$("a[href='?pagina=home']").parent().addClass("active");</script>
        <?php require_once ("view/Home.php");
    }
} else {
    require_once ("view/Home.php"); ?>

            <script>$("a").parent().removeClass("active");</script>
            <script>$("a[href='?pagina=home']").parent().addClass("active");</script>
<?php } ?>