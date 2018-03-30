<?php
if(!(isset($_SESSION['adm']))){
    echo "<script>location.href='index.php';</script>";
}
require_once "controller/EscolaController.php";
require_once "model/Escola.php";

$escolaValida = true;
$res = " ";
$escolaController = new EscolaController();

$listaEscolas = [];
$listaEscolas = $escolaController->pegarListaEscolas();

if (filter_input(INPUT_POST, "btnCadEscola", FILTER_SANITIZE_STRING)) {
    $nomeEscola = filter_input(INPUT_POST, "txtNomeEscola", FILTER_SANITIZE_STRING);
    $bairroEscola = filter_input(INPUT_POST, "txtBairroEscola", FILTER_SANITIZE_STRING);
    $escola = new Escola();
    foreach ($listaEscolas as $item) {
            if ($nomeEscola === $item->getNome() && $bairroEscola === $item->getBairro()) {
                $escolaValida = false;
                break;
            }
        }
        
    if($escolaValida){
        $escola->setNome($nomeEscola);
        $escola->setBairro($bairroEscola);
        if($escolaController ->cadastrarEscola($escola)){
            $res = "<div role=\"alert\" class=\"alert alert-success\">Cadastro feito com sucesso.</div>";
            } else {
                $res = "<div role=\"alert\" class=\"alert alert-danger\">Erro ao tentar cadastrar.</div>";
            }
        } else {
        $res = "<div role=\"alert\" class=\"alert alert-danger\">Erro ao tentar cadastrar. Escola já existente.</div>";
    }
    
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 dvFrmLogin">
            <h1>Cadastro de escolas</h1>
            <div class="msgCadEscola"><?= $res ?></div>
            <form method='post'>
            <div class="form-group">
                <label for="txtNomeEscola">Nome da escola:</label>
                <input type="text" class="form-control" name="txtNomeEscola" id="txtNomeEscola" minlength="3" required="required" title="Preencha o campo, e com pelo menos 3 caracteres"/>
            </div>

            <div class="form-group">
                <label for="txtBairroEscola">Bairro:</label>
                <input type="text" class="form-control" name="txtBairroEscola" id="txtBairroEscola" minlength="3" required="required" title="Preencha o campo, e com pelo menos 3 caracteres"/>
            </div>
                
                <br /><input type="submit" class="btn btn-success" name="btnCadEscola">
            </form>
        </div>
    </div>
</div>
