<?php

if (isset($_POST['req'])) {
    require_once "../DAL/EscolaDAO.php";
} else {
    require_once "DAL/EscolaDAO.php";
}


class EscolaController {

    private $escolaDAO;
    
    public function __construct() {
        $this->escolaDAO = new EscolaDAO();
    }

    
    
    public function cadastrarEscola($escola){
       if(strlen($escola->getBairro()) > 2 && strlen($escola->getNome()) > 2){
           return $this->escolaDAO->cadastrarEscola($escola);
       }else{
           return false;
       }
    }
    
   
    public function editarEscola($escola) {
        if(strlen($escola->getNome()) > 2 && strlen($escola->getBairro()) > 2){
          return $this->escolaDAO->editarEscola($escola);
       }else{
          return false;
       }
    }
    
    public function excluirEscola($cod) {
        if($cod > 0){
            return $this->escolaDAO->excluirEscola($cod);
        }else{
            return false;
        }
    }
    
    public function pegarListaEscolas(){
            $listaEscolas = [];
            $listaEscolas = $this->escolaDAO->pegarListaEscolas();
            return $listaEscolas;
    }
   
    
    }

