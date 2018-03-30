<?php
require_once "controller/AlunoController.php";
require_once "controller/ProfessorController.php";
require_once "controller/EscolaController.php";

$alunoController = new AlunoController();
$professorController = new ProfessorController();
$escolaController = new EscolaController();

$res = " ";
$listaUsuarios = [];
$listaUsuarios = $alunoController->pegarListaUsuarios();
$usuarioValido = true;

$listaEscolas = [];
$listaEscolas = $escolaController->pegarListaEscolas();

if (filter_input(INPUT_POST, "btnCadUsuario", FILTER_SANITIZE_STRING)) {
    
        $nome = filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_STRING);
        $nomeUsuario = filter_input(INPUT_POST, "txtNomeUsuario", FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, "txtSenha1", FILTER_SANITIZE_STRING);
        $escola = filter_input(INPUT_POST, "slEscola", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_STRING);
        
        foreach ($listaUsuarios as $usuario) {
            if ($nomeUsuario === $usuario['nome_de_usuario']) {
                $usuarioValido = false;
                break;
            }
        }
        
  if ($usuarioValido) {    
    if (filter_input(INPUT_POST, "rdTipo", FILTER_SANITIZE_NUMBER_INT) == 0) {
        
            require_once ('model/Aluno.php');
            $aluno = new Aluno();
            
            $aluno->setNome($nome);
            $aluno->setNomeUsuario($nomeUsuario);
            $aluno->setSenha($senha);
            $aluno->getEscola()->setCod($escola);
            $aluno->setPontuacao(1);
            
            if ($alunoController->cadastrarAluno($aluno)) {

                
                echo '<script>location.href="index.php?pagina=login&cadastro=s";</script>';
            } else {
                $res = "<span class=\"label label-danger\">Erro ao tentar cadastrar.</span>";
            }
        
    
    //professor    
    } else {
        require_once ('model/Professor.php');
        $professor = new Professor();

        
            $professor->setNome($nome);
            $professor->setNomeUsuario($nomeUsuario);
            $professor->setSenha($senha);
            $professor->setEmail($email);
            $professor->setAtivo(0);
            

            if ($professorController->cadastrarProfessor($professor)) {
                echo '<script>location.href="index.php?pagina=login&cadastro=s";</script>';
            } else {
                $res = "<span class=\"label label-danger\">Erro ao tentar cadastrar.</span>";
            }
    }
    } else {
            $res = "<span class=\"label label-danger\">Erro ao tentar cadastrar. Nome de usuário já existente.</span>";
        }
}
?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1 class="tituloCad">Cadastro</h1>

        <div class="resultado"><?= $res ?></div>
        <form name="frmUsuNovo" method="post" id="frmUsuNovo" class="frmCadUsu" >

            <div class="form-group">
                <label for="txtNome">Nome completo:</label>
                <input type="text" class="form-control" name="txtNome" id="txtNome" minlength="6" required="required" title="Preencha o campo, e com pelo menos 6 caracteres"/>
            </div>

            <div class="form-group">
                <label for="txtNomeUsuario">Nome de usuário:</label>
                <input type="text" class="form-control" name="txtNomeUsuario" id="txtNomeUsuario" minlength="3" required="required" title="Preencha o campo, e com pelo menos 3 caracteres"/>
            </div>
            
            <div class="form-group">
                <label for="txtSenha1">Senha:</label>
                <input type="password" class="form-control" name="txtSenha1" id="txtSenha1" minlength="6" required="required" title="Preencha o campo, e com pelo menos 6 caracteres" oncopy="return false"/>
            </div>
            
            <div class="form-group">
                <label for="txtSenha2">Repita senha:</label>
                <input type="password" class="form-control" name="txtSenha2" id="txtSenha2" minlength="6" required="required" title="Preencha o campo, e com pelo menos 6 caracteres" oncopy="return false"/>
                <span class="spSenhas"></span>
            </div>
            
            <fieldset class="form-group">
                <legend>Tipo</legend>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="rdTipo" id="rdTipo1" value="0" checked>
                        Aluno
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="rdTipo" id="rdTipo2" value="1">
                        Professor
                    </label>
                </div>
                </fieldset>
            
            <div class="form-group dvHiddenEscola">
                <select name="slEscola" class="form-control">
                    <?php foreach($listaEscolas as $escola){ ?>
                        <option value="<?= $escola->getCod() ?>"><?= $escola->getNome() ?> - <?= $escola->getBairro() ?></option>
                    <?php  } ?>
                </select>
            </div>
            
            <div class="form-group dvHiddenEmail" style="display: none">
                <label for="txtEmail">E-mail:</label>
                <input type="email" class="form-control" name="txtEmail" id="txtEmail" />
                <span class="spCadProf">Você deverá aguardar o e-mail do administrador para confirmar seu cadastro.</span>
            </div> 

            <input type="submit" name="btnCadUsuario" class="btn btn-success btnCadUsuario" value="Cadastrar"/>
        </form>
    </div>
</div>

<script>

var conferem = false;
    $(".frmCadUsu").submit(function(e){
        if(!conferem){
        $("#txtSenha2").focus();
        e.preventDefault();
    }
    });
    
    $("input[type='password']").keyup(function(){
        
        var senha1 = $("#txtSenha1").val();
        var senha2 = $("#txtSenha2").val();
        
        if(senha1 !== senha2){
            $(".spSenhas").text('As senhas tem que ser iguais!').css('color', 'red');
            conferem = false;
        }else{
            $(".spSenhas").text('Senhas iguais.').css('color', 'green');
            conferem = true;
        }
    });
    
    $("input[type='radio'][name='rdTipo']").click(function(){
        
       if($("input[type='radio'][name='rdTipo']:checked").val() == 1){
           $(".dvHiddenEscola").hide();
           $(".dvHiddenEmail").show();
       }else{
           $(".dvHiddenEscola").show();
           $(".dvHiddenEmail").hide();
       } 
    });

</script>

