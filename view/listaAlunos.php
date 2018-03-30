<?php
require_once 'controller/AlunoController.php';
require_once 'model/Aluno.php';
$alunoController = new AlunoController();
$aluno = new Aluno();

$listaAlunos = [];

$listaAlunos = $alunoController->pegarListaAlunos($_SESSION['cod']);


?>
<h1 class="text-center"><span class="glyphicon glyphicon-list-alt"></span> Sua lista de alunos</h1>

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
    echo '<script>$(".msgLista").text("Lista vazia. Selecione Adicionar Aluno no menu acima.");</script>';
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
        if (confirm("Tem certeza de que deseja excluir o aluno da sua lista?")) {
            var dados= "cod="+cod+"&req=2";
            $.ajax({
                type: "post",
                url: "action/ProfessorAction.php",
                data: dados,
                success: function(retorno){
                  $(".dvListaAlunos").html(retorno).css("text-align", "center");
                  
                }

             }); 
        }
    }

</script>
