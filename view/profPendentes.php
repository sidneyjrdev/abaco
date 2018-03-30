<?php
if(!(isset($_SESSION['adm']))){
    echo "<script>location.href='index.php';</script>";
}

require_once 'controller/ProfessorController.php';
require_once 'model/Professor.php';
$professorController = new ProfessorController();
$professor = new Professor();

$listaProfessor = [];

$listaProfessor = $professorController->pegarProfsPendentes();


?>
<h1 class="text-center"><img src="img/iconeProf.png" alt=""/> Professores pendentes</h1>

<div class="dvListaAlunos">
    <span class="msgLista label label-info"></span>

    <?php 
    if($listaProfessor == null){
    echo '<script>$(".msgLista").text("Não há professores pendentes");</script>';
}else{ ?>
    <table class="table table-inverse listaAlunos">
  <thead>
    <tr>
      <th>Nome completo</th>
      <th>Nome de usuário</th>
      <th>Email</th>
      <th>Aprovar cadastro/Excluir</th>
    </tr>
  </thead>
  
  <tbody>
   <?php foreach($listaProfessor as $prof){ 
    
?>
        <tr class="text-center">
      
      <td><?= $prof->getNome(); ?></td>
      <td><?= $prof->getNomeUsuario(); ?></td>
      <td><?= $prof->getEmail(); ?></td>
      <td>
          <a href="#" onclick="aprovar( <?= $prof->getCod(); ?> )" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></a>
          <a href="#" onclick="return confirmar( <?= $prof->getCod(); ?> )" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
      </td>
    </tr>
<?php } }?>
 </tbody>
</table>
</div>

<script>
      
    function aprovar(cod) {
            
            var dados= "cod="+cod+"&req=2";
            $.ajax({
                type: "post",
                url: "action/AdmAction.php",
                data: dados,
                success: function(retorno){
                  $(".dvListaAlunos").html(retorno).css("text-align", "center");
                  
                }

             }); 
         }
       
   
    function confirmar(cod) {
            if(confirm("Tem certeza de que deseja excluir o professor?")){
            var dados= "cod="+cod+"&req=4";
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

