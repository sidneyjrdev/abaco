<?php



class Professor {
    
private $cod;
private $nome;
private $nomeUsuario;
private $senha;
private $email;
private $ativo;
private $professor;
    

function getCod(){
    return $this->cod;
}

function getNome(){
    return $this->nome;
}

function getNomeUsuario(){
    return $this->nomeUsuario;
}

function getSenha(){
    return $this->senha;
}

function getEmail(){
    return $this->email;
}

function getAtivo(){
    return $this->ativo;
}

function getProfessor(){
    return $this->professor;
}

function setCod($cod){
    $this->cod = $cod;
}

function setNome($nome){
    $this->nome = $nome;
}

function setNomeUsuario($nomeUsuario){
    $this->nomeUsuario = $nomeUsuario;
}

function setSenha($senha){
    $this->senha = $senha;
}

function setEmail($email){
    $this->email = $email;
}

function setAtivo($ativo){
    $this->ativo = $ativo;
}

function setProfessor($professor){
    $this->professor = $professor;
}

}
