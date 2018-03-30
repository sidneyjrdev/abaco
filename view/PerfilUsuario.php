<?php
require_once "controller/AlunoController.php";
require_once "model/Aluno.php";
require_once "controller/ProfessorController.php";
require_once "model/Professor.php";
require_once "controller/EscolaController.php";

$alunoController = new AlunoController();
$professorController = new ProfessorController();
$escolaController = new EscolaController();

$aluno = new Aluno();
$professor = new Professor();

$res = "";
$listaUsuarios = [];
$listaUsuarios = $alunoController->pegarListaUsuarios();
$usuarioValido = true;

$listaEscolas = [];
$listaEscolas = $escolaController->pegarListaEscolas();

//excluir
if (filter_input(INPUT_GET, "excluir", FILTER_SANITIZE_NUMBER_INT)) {

    $codExcluir = filter_input(INPUT_GET, "excluir", FILTER_SANITIZE_NUMBER_INT);
    
    //aluno
    if (isset($_SESSION['pontuacao'])) {
        if ($alunoController->excluirAluno($codExcluir)) {

            echo "<script>window.location.href='?pagina=logout'</script>";
        } else {
            $res = "<span class=\"label label-danger\">Erro ao tentar excluir conta.</span>";
        }
    //professor
    }else{
        if ($professorController->excluirProfessor($codExcluir)) {

            echo "<script>window.location.href='?pagina=logout'</script>";
        } else {
            $res = "<span class=\"label label-danger\">Erro ao tentar excluir conta.</span>";
        }
    }
}

//editar
if (filter_input(INPUT_POST, "btnEditar", FILTER_SANITIZE_STRING)) {
    $nomeUsuario = filter_input(INPUT_POST, "txtNomeUsuario", FILTER_SANITIZE_STRING);
    
    if($nomeUsuario !== $_SESSION['nomeUsuario']){
    foreach ($listaUsuarios as $usuario) {
            if ($nomeUsuario === $usuario['nome_de_usuario']) {
                $usuarioValido = false;
                break;
            }
        }
    }
    
    if($usuarioValido){
        
    //aluno
    if (isset($_SESSION['pontuacao'])) {
        $nome = filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_STRING);
        $escola = filter_input(INPUT_POST, "slEscola", FILTER_SANITIZE_STRING);
        $cod = $_SESSION['cod'];

        $aluno->setNome($nome);
        $aluno->setNomeUsuario($nomeUsuario);
        $aluno->getEscola()->setCod($escola);
        $aluno->setCod($cod);

        if ($alunoController->editarAluno($aluno)) {
            $_SESSION['nome'] = $nome;
            $_SESSION['nomeUsuario'] = $nomeUsuario;
            $_SESSION['escola'] = $escola;
            $res = "<span class=\"label label-success\">Perfil editado com sucesso.</span>";
        } else {
            $res = "<span class=\"label label-danger\">Erro ao tentar editar perfil.</span>";
        }
        
    //professor
    } else {
        $nome = filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_STRING);
        $nomeUsuario = filter_input(INPUT_POST, "txtNomeUsuario", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_STRING);
        $cod = $_SESSION['cod'];

        $professor->setNome($nome);
        $professor->setNomeUsuario($nomeUsuario);
        $professor->setEmail($email);
        $professor->setCod($cod);

        if ($professorController->editarProfessor($professor)) {
            $_SESSION['nomeProfessor'] = $nome;
            $_SESSION['nomeUsuario'] = $nomeUsuario;
            $_SESSION['email'] = $email;
            $res = "<span class=\"label label-success\">Perfil editado com sucesso.</span>";
        } else {
            $res = "<span class=\"label label-danger\">Erro ao tentar editar perfil.</span>";
        }
    }
}else{
            $res = "<span class=\"label label-danger\">Erro ao tentar editar perfil. Usuário já existente.</span>";
        }
}
?>
<div class="row">
<div class="col-md-4 col-md-offset-4 dvPerfil">
    <h1><span class="glyphicon glyphicon-user"></span> SEU PERFIL</h1>

    <div><?= $res ?></div>

    <form method="post">

        <label for="txtNome">Nome completo:</label><br />
        <input type="text" name="txtNome" id="txtNomeAdm" minlength="6" title="Deve conter pelo menos 6 caracteres." value="<?= isset($_SESSION['nome'])? $_SESSION['nome'] : $_SESSION['nomeProfessor'] ?>"/><br /><br />

        <label for="txtNomeUsuario">Nome de usuário:</label><br />
        <input type="text" name="txtNomeUsuario" id="txtNomeUsuario" minlength="3" title="Deve conter pelo menos 3 caracteres." value="<?= $_SESSION['nomeUsuario'] ?>"/><br /><br />
        
        
            <?php if(isset($_SESSION['escola'])){ ?>
                <label for="slEscola">Escola:</label><br />
                <select id="slEscola" name="slEscola">
                    <?php foreach($listaEscolas as $escola){ ?>
                    <option value="<?= $escola->getCod() ?>" <?php if($_SESSION['escola'] == $escola->getCod()) echo 'selected' ?>><?= $escola->getNome() ?> - <?= $escola->getBairro() ?></option>
                    <?php  } ?>
                </select>
            
            
            <?php }else{ ?>
                <label for="txtEmail">E-mail:</label><br />
                <input type="email" name="txtEmail" id="txtEmail" required="required" value="<?= $_SESSION['email'] ?>"/><br />
                
            
            <?php } ?>
        <br /><br /><input type="submit" class="btn btn-success" name="btnEditar" value="Confirmar alterações" />

    </form>
    <br />
    <a href="#" onclick="return confirmar(<?= $_SESSION['cod'] ?>)" class="btn btn-danger" name="btnExcluir">Excluir conta</a>

</div>     
</div>

<script>
    function confirmar(cod) {
        if (confirm("Tem certeza de que deseja excluir sua conta?")) {
            window.location.href = '?pagina=perfil&excluir=' + cod;
        }
    }
    
    
</script>