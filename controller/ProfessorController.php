<?php

if (isset($_POST['req'])) {
    require_once "../DAL/ProfessorDAO.php";
} else {
    require_once "DAL/ProfessorDAO.php";
}


class ProfessorController {

    private $professorDAO;
    
    public function __construct() {
        $this->professorDAO = new ProfessorDAO();
    }

    public function pegarProfessorLogin($nomeUsuario, $senha) {
      if($nomeUsuario != "" && strlen($senha) > 5){
        $senha = md5($senha);
        return $this->professorDAO->pegarProfessorLogin($nomeUsuario, $senha);  
      }else{
        return null; 
      }
    }
    
    
    public function cadastrarProfessor($professor){
       if(strlen($professor->getSenha()) > 5 && strlen($professor->getNome()) > 5 && strlen($professor->getNomeUsuario()) > 2 && strpos($professor->getEmail(), "@") && strpos($professor->getEmail(), ".")){
           return $this->professorDAO->cadastrarProfessor($professor);
       }else{
           return false;
       }
    }
    
   
    public function editarProfessor($professor) {
        if(strlen($professor->getNome()) > 5 && strlen($professor->getNomeUsuario()) > 2 && strpos($professor->getEmail(), "@") && strpos($professor->getEmail(), ".")){
          return $this->professorDAO->editarProfessor($professor);
       }else{
          return false;
       }
    }
    
    public function pegarProfsPendentes() {
        
            $listaProfs = [];
            $listaProfs = $this->professorDAO->pegarProfsPendentes();
            return $listaProfs;
    }
    
    public function aprovarProf($codProf) {
        if($codProf > 0){
            return $this->professorDAO->aprovarProf($codProf);
        }else{
            return false;
        }
    }
    
    public function excluirProfPendente($cod){
        if($cod > 0){
            return $this->professorDAO->excluirProfPendente($cod);
        }else{
            return false;
        }
    }
   
    
    }
