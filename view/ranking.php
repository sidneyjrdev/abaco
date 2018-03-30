<?php
require_once 'controller/AlunoController.php';
$alunoController = new AlunoController();

$listaRanking = [];
$listaRanking = $alunoController->filtroRanking("");


?>
<div class="row dvRanking">
<div class="col-md-8 col-md-offset-2">
    
<div class="text-center">
    
<img src="img/podium.png" alt="" />
<h1>Ranking</h1>
</div>

<label for="txtEscolaRank" class="lblEscolaRank">Escola:</label>
<input type="text" name="txtEscolaRank" id="txtEscolaRank" placeholder="Só exibir alunos dessa escola"/>


<button type="button" class="btn btn-sm btn-info btnMinhaPosicao pull-right">Minha posição</button>

<div class="dvTabelaRanking">
<table class="table table-inverse table-bordered tabelaRanking">
  <thead>
    <tr>
      <th>Posição</th>
      <th>Nome de usuário</th>
      <th>Escola</th>
      <th>Pontos</th>
    </tr>
  </thead>
  
  <tbody>
    <?php $i = 1; foreach($listaRanking as $aluno){ 
        if($aluno->getNomeUsuario() == $_SESSION['nomeUsuario']){  ?>
            <tr class= "bordaRanking" id="minhaPosicao"> 
        
        <?php }else{ ?>
        <tr> <?php } ?>
      <th scope="row"><?= $i ?>°</th>
      <td><?= $aluno->getNomeUsuario(); ?></td>
      <td><?= $aluno->getEscola()-> getNome(); ?> - <?= $aluno->getEscola()-> getBairro(); ?></td>
      <td><?= $aluno->getPontuacao(); ?></td>
    </tr>
    <?php $i ++; } ?>
 </tbody>
</table>
</div>
</div>
</div>

<script>
    $(document).ready(function(){
        
    function filtroEscola(escola){
       
       var dados= "escola="+escola;
        $.ajax({
            type: "post",
            url: "action/RankingAction.php",
            data: dados,
            success: function(retorno){
              $(".dvTabelaRanking").html(retorno).css("text-align", "center");

            }
         }); 
     
    }
    
    $("#txtEscolaRank").keyup(function(){
        var escola = $(this).val();
        if(escola == ""){ 
            location.reload(); }
        filtroEscola(escola);
         }); 
         
    
    });
    
    $(".btnMinhaPosicao").click(function(){
        window.location.hash = "#minhaPosicao";
    });
   
</script>