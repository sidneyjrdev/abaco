<?php
if(!(isset($_SESSION['adm']))){
    echo "<script>location.href='index.php';</script>";
}
require_once 'controller/AlunoController.php';
require_once 'model/Aluno.php';
$alunoController = new AlunoController();
$aluno = new Aluno();

$listaAlunos = [];

$listaAlunos = $alunoController->pegarListaAlunos('%');


?>
<h1 class="text-center"><span class="glyphicon glyphicon-list-alt"></span> Lista de alunos</h1>

<div class="dvListaAlunos">
    <span class="msgLista label label-info"></span>
<table class="table table-inverse listaAlunos">
  <thead>
    <tr>
      <th>Nome completo</th>
      <th>Nome de usuário</th>
      <th>Escola</th>
      <th>Pontos</th>
      <th>Remover aluno</th>
    </tr>
  </thead>
  
  <tbody>
    <?php 
    if($listaAlunos == null){
    echo '<script>$(".msgLista").text("Lista vazia.");</script>';
}else{
    foreach($listaAlunos as $aluno){ 
    
?>
        <tr class="text-center">
      
      <td><?= $aluno->getNome(); ?></td>
      <td><?= $aluno->getNomeUsuario(); ?></td>
      <td><?= $aluno->getEscola()-> getNome(); ?> - <?= $aluno->getEscola()-> getBairro(); ?></td>
      <td><?= $aluno->getPontuacao(); ?></td>
      <td><a href="#" onclick="return confirmar(<?= $aluno->getCod() ?>);" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></td>
    </tr>
<?php } }?>
 </tbody>
</table>
</div>

<script>
      
    function confirmar(cod) {
        if (confirm("Tem certeza de que deseja excluir o aluno?")) {
            var dados= "cod="+cod+"&req=1";
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
