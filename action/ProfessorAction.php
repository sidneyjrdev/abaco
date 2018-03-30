<?php
session_start();
require_once "../controller/AlunoController.php";
require_once "../model/Aluno.php";
require_once "../model/Professor.php";

$alunoController = new AlunoController();

$aluno = new Aluno();
$professor = new Professor();

$listaAlunos = [];

function retornarListaAdicionar($adicionar){
   $escola = filter_input(INPUT_POST, "escola", FILTER_SANITIZE_STRING);
   $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
   $listaAdicionar = $alunoController ->filtroAdicionar($escola, $nome); 
   
   if($listaAdicionar != null){
       echo '<div class="msgLista label label-info">';
       if($adicionar != null){
           if($adicionar){
             echo 'Aluno adicionado à lista com sucesso.';  
           }else{
             echo 'Erro ao tentar adicionar aluno à lista.';  
           }
       }
       echo '</div>';
     echo '<table class="table table-inverse listaAlunos">';
  echo '<thead>';
    echo '<tr>';
      echo '<th>Nome completo</th>';
      echo '<th>Nome de usuário</th>';
      echo '<th>Escola</th>';
      echo '<th>Adicionar aluno</th>';
    echo '</tr>';
  echo '</thead>';
  
  echo '<tbody>';
     foreach($listaAdicionar as $aluno){ 
        
        echo '<tr>';
      
      echo '<td>' . $aluno->getNome()  . '</td>';
      echo '<td>' . $aluno->getNomeUsuario()  . '</td>';
      echo '<td>' . $aluno->getEscola()->getNome()  .  ' - ' . $aluno->getEscola()-> getBairro() . '</td>';
      echo '<td>';
      if($aluno->getProfessor()->getCod() === $_SESSION['cod']){ 
          echo '<button type="button" class="btn btn-success" disabled="disabled" title="Aluno já pertence a sua lista."><span class="glyphicon glyphicon-plus"></span></button>';
       }else{ 
         echo '<button type="button" class="btn btn-success btnAdicionarLista" value="'.$aluno->getCod().'"><span class="glyphicon glyphicon-plus"></span></button>';
       }   
      echo '</td>';
   echo '</tr>';
   echo '<input type="hidden" class="codAlunoLista" value="'.$aluno->getCod(). '" />';
    echo '<input type="hidden" class="codProfLista" value="'.$_SESSION['cod']. '" />';
     } 
echo '</tbody>';
echo '</table>';
   }else{
    echo '<div class="text-center" style="color: red;">Nenhum aluno encontrado.</div>';
}
}

function retornarListaAlunos($excluir){
    $listaAlunos = $alunoController->pegarListaAlunos($_SESSION['cod']);
    if($listaAlunos == null){
    echo '<script>$(".msgLista").text("Lista vazia. Selecione Adicionar Aluno no menu acima.");</script>';
    }else{
    
    echo '<div class="msgLista label label-info">';
    if($excluir){
      echo 'Aluno excluído da lista com sucesso.';  
    }else{
      echo 'Erro ao tentar excluir aluno.'; 
    }
    echo '</div>';
echo '<table class="table table-inverse listaAlunos">';
  echo '<thead>';
    echo '<tr>';
      echo '<th>Nome completo</th>';
      echo '<th>Nome de usuário</th>';
      echo '<th>Escola</th>';
      echo '<th>Pontos</th>';
      echo '<th>Remover aluno</th>';
    echo '</tr>';
  echo '</thead>';
  
  echo '<tbody>';
     foreach($listaAlunos as $aluno){ 
        
        echo '<tr class="text-center">';
      
      echo '<td>'.$aluno->getNome().'</td>';
      echo '<td>'.$aluno->getNomeUsuario().'</td>';
      echo '<td>' . $aluno->getEscola()->getNome()  .  ' - ' . $aluno->getEscola()-> getBairro() . '</td>';
      echo '<td>'.$aluno->getPontuacao().'</td>';
      echo '<td><a href="#" onclick="return confirmar('.$aluno->getCod().');" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></td>';
   echo ' </tr>';
     } 
 echo '</tbody>';
echo '</table>';
    }
}

$req = filter_input(INPUT_POST, "req", FILTER_SANITIZE_NUMBER_INT);

switch ($req) {
//listaAdicionar
    case 1:
        retornarListaAdicionar(null);
    break;

//excluir aluno da lista
    case 2:
       $cod = filter_input(INPUT_POST, "cod", FILTER_SANITIZE_STRING);
       $excluir = $alunoController->excluirAlunoLista($cod); 
       retornarListaAlunos($excluir);
    break;

//adicionar aluno na lista
    case 3:
        $cod = filter_input(INPUT_POST, "codAluno", FILTER_SANITIZE_STRING);
        $codProf = filter_input(INPUT_POST, "codProf", FILTER_SANITIZE_STRING);
        $adicionar = $alunoController->adicionarAlunoLista($cod, $codProf); 
        retornarListaAdicionar($adicionar);
    break;
}