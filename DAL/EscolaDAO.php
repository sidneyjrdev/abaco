<?php

require_once "Banco.php";

if (isset($_POST['req'])) {
    require_once "../model/Escola.php";
} else {
    require_once "model/Escola.php";
}

class EscolaDAO {

    private $banco;
    private $res;

    public function __construct() {
        $this->banco = new Banco();
    }

    public function cadastrarEscola($escola){
      try {

            $sql = "INSERT INTO escola(nome, bairro) VALUES(:nome, :bairro)";
            $params = array(
                ":nome" => $escola->getNome(),
                ":bairro" => $escola->getBairro()
               
            );

            return $this->banco->NonQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }
    
   
    public function editarEscola($escola) {
        try {
            
                $sql = "UPDATE escola SET nome = :nome, bairro = :bairro WHERE cod = :cod";
                $params = array(
                    ":nome" => $escola->getNome(),
                    ":bairro" => $escola->getBairro(),
                    ":cod" => $escola->getCod()
                );
           
                return $this->banco->NonQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }
    
    public function excluirEscola($cod) {
        try {
            $sql = "DELETE FROM escola WHERE cod = :cod";
            $params = array(
                ":cod" => $cod
            );

            return $this->banco->NonQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }
    
    public function pegarListaEscolas(){
        try {
            $sql = "SELECT * FROM escola";
            $listaEscolas = [];
            $listaEscolas = $this->banco->SelectVariasLinhas($sql);
            
            foreach ($listaEscolas as $item) {
                $escola = new Escola();
                $escola->setCod($item['cod']);
                $escola->setNome($item['nome']);
                $escola->setBairro($item['bairro']);
                
                $listaRetornar[] = $escola;
            }
            
            
            return $listaRetornar;
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }   
    }

}