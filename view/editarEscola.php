<?php

require_once "model/Escola.php";
require_once "controller/EscolaController.php";

$escolaController = new EscolaController();
$escola = new Escola();

$res = "";

$escolaValida = true;

$listaEscolas = [];
$listaEscolas = $escolaController->pegarListaEscolas();

$cod = filter_input(INPUT_GET, "codEscola", FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_GET, "nomeEscola", FILTER_SANITIZE_STRING);
$bairro = filter_input(INPUT_GET, "bairroEscola", FILTER_SANITIZE_STRING);

//botão editar
if (filter_input(INPUT_POST, "btnEditarEscola", FILTER_SANITIZE_STRING)) {
    $nomeNovo = filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_STRING);
    $bairroNovo = filter_input(INPUT_POST, "txtBairro", FILTER_SANITIZE_STRING);
    
    foreach ($listaEscolas as $item) {
            if ($nomeNovo === $item->getNome() && $bairroNovo === $item->getBairro()) {
                $escolaValida = false;
                break;
            }
        }
        
        if($escolaValida){
    
        $escola->setNome($nomeNovo);
        $escola->setBairro($bairroNovo);
        $escola->setCod($cod);
        

        if ($escolaController->editarEscola($escola)) {
           
            $res = "<span class=\"label label-success\">Escola editada com sucesso.</span>";
            echo "<script>location.href='index.php?pagina=gerenciarEscolas';</script>";
        } else {
            $res = "<span class=\"label label-danger\">Erro ao tentar editar escola.</span>";
        }
        }else{
            $res = "<span class=\"label label-danger\">Erro ao tentar editar escola. Escola já existente.</span>";
        }
   
}
?>
<div class="row">
<div class="col-md-4 col-md-offset-4 dvFrmLogin">
    <h1>EDITAR ESCOLA</h1>

    <div><?= $res ?></div>

    <form method="post">
        
      <div class="form-group">
        <label for="txtNome">Nome:</label><br />
        <input type="text" name="txtNome" class="form-control" id="txtNome" minlength="3" title="Deve conter pelo menos 3 caracteres." value="<?= $nome ?>"/>
      </div>
        
      <div class="form-group">
        <label for="txtBairro">Bairro:</label><br />
        <input type="text" name="txtBairro" class="form-control" id="txtBairro" minlength="3" title="Deve conter pelo menos 3 caracteres." value="<?= $bairro ?>"/>
      </div> 
        
            
        <br /><input type="submit" class="btn btn-success" name="btnEditarEscola" value="Salvar alterações" />
        
        <a href="?pagina=gerenciarEscolas" class="pull-right">Voltar</a>
    </form>
    
</div>     
</div>
