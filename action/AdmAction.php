<?php
session_start();
require_once "../controller/AlunoController.php";
require_once "../controller/ProfessorController.php";
require_once "../controller/EscolaController.php";
require_once "../model/Aluno.php";
require_once "../model/Professor.php";
require_once "../model/Escola.php";

$alunoController = new AlunoController();
$professorController = new ProfessorController();
$escolaController = new EscolaController();

$aluno = new Aluno();
$professor = new Professor();
$escola = new Escola();

$listaAlunos = [];
$listaEscolas = [];

function retornarListaAdm($excluir){
    $listaAlunos = $alunoController->pegarListaAlunos('%');
    if($listaAlunos == null){
    echo '<script>$(".msgLista").text("Lista vazia.");</script>';
    }else{
    
    echo '<div class="msgLista label label-info">';
    if($excluir){
      echo 'Aluno excluído com sucesso.';  
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
      echo '<td><a href="#" onclick="return confirmar(' . $aluno->getCod() . ')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></td>';
   echo ' </tr>';
     } 
 echo '</tbody>';
echo '</table>';
    }
}

function retornarProfsPendentes($acaoSucesso){
    $listaProfessor = $professorController->pegarProfsPendentes();
    echo '<div class="msgLista label label-info">';
    if($acaoSucesso){
      echo 'Cadastro alterado com sucesso.';  
    }else{
      echo 'Erro ao tentar alterar cadastro.'; 
    }
    if($listaProfessor == null){
    echo '<script>$(".msgLista").text("Não há professores pendentes.");</script>';
    }else{
    
    
    echo '</div>';
echo '<table class="table table-inverse listaAlunos">';
  echo '<thead>';
    echo '<tr>';
      echo '<th>Nome completo</th>';
      echo '<th>Nome de usuário</th>';
      echo '<th>Email</th>';
      echo '<th>Aprovar cadastro/Excluir</th>';
    echo '</tr>';
  echo '</thead>';
  
  echo '<tbody>';
     foreach($listaProfessor as $prof){ 
        
        echo '<tr class="text-center">';
      
      echo '<td>'.$prof->getNome().'</td>';
      echo '<td>'.$prof->getNomeUsuario().'</td>';
      echo '<td>'.$prof->getEmail().'</td>';
      echo '<td><a href="#" onclick="aprovar( ' . $prof->getCod() . ')" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></a>
             <a href="#" onclick="return confirmar( ' . $prof->getCod() .' )" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>';
   echo ' </tr>';
     } 
 echo '</tbody>';
echo '</table>';
    }
}

function retornarListaEscolas($excluir){
    $listaEscolas = $escolaController->pegarListaEscolas();
    if($listaEscolas == null){
    echo '<script>$(".msgLista").text("Lista vazia.");</script>';
    }else{
    
    echo '<div class="msgLista label label-info">';
    if($excluir){
      echo 'Escola excluída com sucesso.';  
    }else{
      echo 'Erro ao tentar excluir escola.'; 
    }
    echo '</div>';
echo '<table class="table table-inverse listaAlunos">';
  echo '<thead>';
    echo '<tr>';
      echo '<th>Nome</th>';
      echo '<th>Bairro</th>';
      echo '<th>Ações</th>';
    echo '</tr>';
  echo '</thead>';
  
  echo '<tbody>';
     foreach($listaEscolas as $escola){ 
        
        echo '<tr class="text-center">';
      
      echo '<td>'.$escola->getNome().'</td>';
      echo '<td>'.$escola->getBairro().'</td>';
      
      echo '<td><a href="?pagina=editarEscola" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
          <a href="#" onclick="return confirmar(' . $escola->getCod() . ')" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span></a></td>';
   echo ' </tr>';
     } 
 echo '</tbody>';
echo '</table>';
    }
}

$req = filter_input(INPUT_POST, "req", FILTER_SANITIZE_NUMBER_INT);

switch ($req) {
//excluir aluno adm
    case 1:
   $cod = filter_input(INPUT_POST, "cod", FILTER_SANITIZE_STRING);
   $excluir = $alunoController->excluirAluno($cod); 
   retornarListaAdm($excluir);
   break;

//aprovar professor pendente
    case 2:
   $cod = filter_input(INPUT_POST, "cod", FILTER_SANITIZE_STRING);
   $aprovar = $professorController->aprovarProf($cod); 
   retornarProfsPendentes($aprovar);
   break;

//excluir escola
    case 3:
   $cod = filter_input(INPUT_POST, "cod", FILTER_SANITIZE_STRING);
   $excluir = $escolaController->excluirEscola($cod); 
   retornarListaEscolas($excluir);
   break;

//excluir professor pendente
    case 4:
   $cod = filter_input(INPUT_POST, "cod", FILTER_SANITIZE_STRING);
   $excluir = $professorController->excluirProfPendente($cod); 
   retornarProfsPendentes($excluir);
   break;

}