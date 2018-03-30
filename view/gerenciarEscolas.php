<?php
if(!(isset($_SESSION['adm']))){
    echo "<script>location.href='index.php';</script>";
}
require_once 'controller/EscolaController.php';
require_once 'model/Escola.php';
$escolaController = new EscolaController();
$escola = new Escola();

$listaEscolas = [];

$listaEscolas = $escolaController->pegarListaEscolas();


?>
<h1 class="text-center"><img src="img/iconeEscola.png" alt="" /> Gerenciar escolas</h1>

<div class="dvListaAlunos">
    <span class="msgLista label label-info"></span>
<table class="table table-inverse listaAlunos">
  <thead>
    <tr>
      <th>Nome</th>
      <th>Bairro</th>
      <th>Ações</th>
    </tr>
  </thead>
  
  <tbody>
    <?php 
    if($listaEscolas == null){
    echo '<script>$(".msgLista").text("Lista vazia.");</script>';
}else{
    foreach($listaEscolas as $escola){ 
    
?>
        <tr class="text-center">
      
      <td><?= $escola->getNome(); ?></td>
      <td><?= $escola->getBairro(); ?></td>
      <td>
          <a href="?pagina=editarEscola&codEscola=<?= $escola->getCod() ?>&nomeEscola=<?= $escola->getNome() ?>&bairroEscola=<?= $escola->getBairro() ?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
          <a href="#" onclick="return confirmar(<?= $escola->getCod() ?>);" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span></a>
      
      </td>
    </tr>
<?php } }?>
 </tbody>
</table>
</div>

<script>
      
    function confirmar(cod) {
        if (confirm("Tem certeza de que deseja excluir a escola?")) {
            var dados= "cod="+cod+"&req=3";
            $.ajax({
                type: "post",
                url: "action/AdmAction.php",
                data: dados,
                success: function(retorno){
                  $(".dvListaAlunos").html(retorno).css("text-align", "center");
                  
                }

             }); 
        }
    }

</script>
