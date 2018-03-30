<?php


class Escola {
    
private $cod;
private $nome;
private $bairro;
private $escola;


function getCod(){
    return $this->cod;
}

function getNome(){
    return $this->nome;
}

function getBairro(){
    return $this->bairro;
}

function getEscola(){
    return $this->escola;
}

function setCod($cod){
    $this->cod = $cod;
}

function setNome($nome){
    $this->nome = $nome;
}

function setBairro($bairro){
    $this->bairro = $bairro;
}

function setEscola($escola){
    $this->escola = $escola;
}

}

