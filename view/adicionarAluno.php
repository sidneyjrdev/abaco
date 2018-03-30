<?php
require_once 'controller/AlunoController.php';
$alunoController = new AlunoController();

require_once 'model/Aluno.php';
$aluno = new Aluno();

$listaAlunos = [];
$listaAlunos = $alunoController->filtroAdicionar("", "");


?>
<div class="row dvAddAluno">
    <div class="col-md-10 col-md-offset-1">
<h1 class="text-center">Adicionar aluno</h1>

<label for="txtNomeLista" class="lblNomeLista">Nome completo(ou parte dele):</label>
<input type="text" name="txtNomeLista" id="txtNomeLista" />

<div class="pull-right">
<label for="txtEscolaLista" class="lblEscolaLista">Escola:</label>
<input type="text" name="txtEscolaLista" id="txtEscolaLista" />
</div>

<div class="dvTableAddAluno">
    <span class="msgLista label label-info"></span>
<table class="table table-inverse listaAlunos">
  <thead>
    <tr>
      <th>Nome completo</th>
      <th>Nome de usuário</th>
      <th>Escola</th>
      <th>Adicionar aluno</th>
    </tr>
  </thead>
  
  <tbody>
    <?php foreach($listaAlunos as $aluno){ ?>
        
        <tr class="text-center">
      
      <td><?= $aluno->getNome(); ?></td>
      <td><?= $aluno->getNomeUsuario(); ?></td>
      <td><?= $aluno->getEscola()-> getNome(); ?> - <?= $aluno->getEscola()-> getBairro(); ?></td>
      <td><?php if($aluno->getProfessor()->getCod() == $_SESSION['cod']){ ?>
          <button type="button" class="btn btn-success" disabled="disabled" title="Aluno já pertence a sua lista."><span class="glyphicon glyphicon-plus"></span></button>
      <?php }else{ ?>
          <button type="button" class="btn btn-success btnAdicionarLista" value="<?= $aluno->getCod(); ?>"><span class="glyphicon glyphicon-plus"></span></button>
      <?php } ?>    
      </td>
      
    </tr>
    <input type="hidden" class="codProfLista" value="<?= $_SESSION['cod']; ?>" />
    <?php } ?>
 </tbody>
</table>

</div>
</div>
    </div>
<script>
    
            $('body').on('click', '.btnAdicionarLista', function(){
            $("#txtNomeLista, #txtEscolaLista").val("");
            var codAluno = $(this).val();
            var codProf = $(".codProfLista").val();
            var dados= "codAluno="+codAluno+"&codProf="+codProf+"&req=3";
            $.ajax({
                type: "post",
                url: "action/ProfessorAction.php",
                data: dados,
                success: function(retorno){
                  $(".dvTableAddAluno").html(retorno).css("text-align", "center");

                }

             }); 
         });
    
        
    function filtroAdicionar(escola, nome){
       
       
        var dados= "escola="+escola+"&nome="+nome+"&req=1";
        $.ajax({
            type: "post",
            url: "action/ProfessorAction.php",
            data: dados,
            success: function(retorno){
              $(".dvTableAddAluno").html(retorno).css("text-align", "center");

            }
            
         }); 
     
    }
    
    $("#txtEscolaLista, #txtNomeLista").keyup(function(){
        var escola = $("#txtEscolaLista").val();
        var nome = $("#txtNomeLista").val();
        if(escola == "" && nome == ""){ 
            location.reload(); }
        filtroAdicionar(escola, nome);
         }); 

</script>
