<?php

require_once 'Professor.php';
require_once 'Escola.php';

class Aluno {
    
private $cod;
private $nome;
private $nomeUsuario;
private $senha;
private $pontuacao;
private $escola;
private $professor;
   
public function __construct(){
    $this->professor = new Professor();
    $this->escola = new Escola();
}

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

function getEscola(){
    return $this->escola;
}

function getProfessor(){
    return $this->professor;
}

function getPontuacao(){
    return $this->pontuacao;
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

function setEscola($escola){
    $this->escola = $escola;
}

function setProfessor($professor){
    $this->professor = $professor;
}

function setPontuacao($pontuacao){
    $this->pontuacao = $pontuacao;
}

}
