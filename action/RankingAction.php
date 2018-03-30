<?php
session_start();
require_once "../controller/AlunoController.php";
require_once "../model/Aluno.php";

$alunoController = new AlunoController();
$aluno = new Aluno();

$listaRanking = [];
$escola = filter_input(INPUT_POST, "escola", FILTER_SANITIZE_STRING);
$listaRanking = $alunoController ->filtroRanking($escola);

if($listaRanking != null){
    echo '<table class="'; echo 'table table-inverse table-bordered tabelaRanking"'; echo '>';
    echo "<thead>
    <tr>
      <th>Posição</th>
      <th>Nome de usuário</th>
      <th>Escola</th>
      <th>Pontos</th>
    </tr>
  </thead>
  
  <tbody>";
    $i = 1; foreach($listaRanking as $aluno){
     if($aluno->getNomeUsuario() == $_SESSION['nomeUsuario']){ 
            echo '<tr class= "bordaRanking" id="minhaPosicao">';
         }else{ 
        echo '<tr>'; 
        }
      echo '<th scope="row">' .  $i  . '°</th>';
      echo "<td>" . $aluno->getNomeUsuario()  . "</td>";
      echo '<td>' . $aluno->getEscola()->getNome()  .  ' - ' . $aluno->getEscola()-> getBairro() . '</td>';
      echo "<td>" . $aluno->getPontuacao()  . "</td>";
    echo "</tr>";
    $i ++; }
 echo "</tbody>";
 echo "</table>";
}else{
    echo '<div class="text-center" style="color: red;">Escola não encontrada.</div>';
}
