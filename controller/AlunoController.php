<?php

if (isset($_POST['req'])) {
    require_once "../DAL/AlunoDAO.php";
} else {
    require_once "DAL/AlunoDAO.php";
}


class AlunoController {

    private $alunoDAO;
    
    public function __construct() {
        $this->alunoDAO = new AlunoDAO();
    }

    public function pegarAlunoLogin($nomeUsuario, $senha) {
      if($nomeUsuario != "" && strlen($senha) > 5){
        $senha = md5($senha);
        return $this->alunoDAO->pegarAlunoLogin($nomeUsuario, $senha);  
      }else{
        return null; 
      }
    }
    
    public function mudarPontuacao($cod, $pontuacao){
        if($cod > 0 && $pontuacao >= 0){
            return $this->alunoDAO->mudarPontuacao($cod, $pontuacao);
        }else{
            return false;
        }
    }
      
    public function cadastrarAluno($aluno){
      if(strlen($aluno->getSenha()) > 5 && strlen($aluno->getNome()) > 5 && strlen($aluno->getNomeUsuario()) > 2 && $aluno->getEscola()->getCod() > 0){
           return $this->alunoDAO->cadastrarAluno($aluno);
       }else{
           return false;
       }
    }
      
   public function pegarListaUsuarios(){
        
            $listaUsuarios = [];
            $listaUsuarios = $this->alunoDAO->pegarListaUsuarios();
            return $listaUsuarios;
        
    }
    
    public function pegarDadosRanking(){
            $listaRanking = [];
            $listaRanking = $this->alunoDAO->pegarDadosRanking();
            return $listaRanking;
    }
    
    public function filtroRanking($escolaFiltro){
            $listaFiltroRank = [];
            $listaFiltroRank = $this->alunoDAO->filtroRanking($escolaFiltro);
            return $listaFiltroRank;
            
    }
   
    public function editarAluno($aluno) {
        if(strlen($aluno->getNome()) > 5 && strlen($aluno->getNomeUsuario()) > 2 && $aluno->getEscola()->getCod() > 0){
          return $this->alunoDAO->editarAluno($aluno);
       }else{
          return false;
       }
    }
    
    public function excluirAluno($cod) {
        if($cod > 0){
            return $this->alunoDAO->excluirAluno($cod);
        }else{
            return false;
        }
    }
    
    public function atualizarPontuacao($cod, $pontuacao) {
        if($cod > 0 && $pontuacao > 0){
            return $this->alunoDAO->atualizarPontuacao($cod, $pontuacao);
        }else{
            return false;
        }
    }
    
    public function filtroAdicionar($escolaFiltro, $nomeFiltro){
            $listaAlunos = [];
            $listaAlunos = $this->alunoDAO->filtroAdicionar($escolaFiltro, $nomeFiltro);
            return $listaAlunos;
    }
    
    public function excluirAlunoLista($cod){
            
            $excluir = $this->alunoDAO->excluirAlunoLista($cod);
            return $excluir;
    }
    
     public function adicionarAlunoLista($codAluno, $codProf){
            $adicionar = $this->alunoDAO->adicionarAlunoLista($codAluno, $codProf);
            return $adicionar;
    }
    
    public function pegarListaAlunos($codProf){
            $listaAlunos = [];
            $listaAlunos = $this->alunoDAO->pegarListaAlunos($codProf);
            return $listaAlunos;
    }
    
    
    }
