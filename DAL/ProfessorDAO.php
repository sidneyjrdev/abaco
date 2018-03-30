<?php

require_once "Banco.php";

if (isset($_POST['req'])) {
    require_once "../model/Professor.php";
} else {
    require_once "model/Professor.php";
}

class ProfessorDAO {

    private $banco;
    private $res;

    public function __construct() {
        $this->banco = new Banco();
    }

    function pegarProfessorLogin($nomeUsuario, $senha) {
        try {
            $sql = "SELECT * FROM professor WHERE nome_de_usuario=:nomeUsuario AND senha=:senha AND ativo = 1";
            $params = array(
                ":nomeUsuario" => $nomeUsuario,
                ":senha" => $senha);

            $res = $this->banco->SelectUmaLinha($sql, $params);

            if ($res != null) {
                $professor = new Professor();
                $professor->setCod($res['cod']);
                $professor->setNomeUsuario($res['nome_de_usuario']);
                $professor->setSenha($res['senha']);
                $professor->setNome($res['nome']);
                $professor->setEmail($res['email']);
                return $professor;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();

            return null;
        }
    }
    

    function cadastrarProfessor($professor) {
    
        try {

            $sql = "INSERT INTO professor(nome, nome_de_usuario, email, senha, ativo) VALUES(:nome, :nomeUsuario, :email, :senha, :ativo)";
            $params = array(
                ":nome" => $professor->getNome(),
                ":nomeUsuario" => $professor->getNomeUsuario(),
                ":email" => $professor->getEmail(),
                ":senha" => md5($professor->getSenha()),
                ":ativo" => $professor->getAtivo()
               
            );

            return $this->banco->NonQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }
    
    public function editarProfessor($professor) {
        try {
            
                $sql = "UPDATE professor SET nome = :nome, nome_de_usuario = :nomeUsuario, email = :email WHERE cod = :cod";
                $params = array(
                    ":nome" => $professor->getNome(),
                    ":nomeUsuario" => $professor->getNomeUsuario(),
                    ":email" => $professor->getEmail(),
                    ":cod" => $professor->getCod()
                );
           
                return $this->banco->NonQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }

    public function excluirProfessor($cod) {
        try {
            $sql = "DELETE FROM professor WHERE cod = :cod";
            $params = array(
                ":cod" => $cod
            );

            return $this->banco->NonQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }

    function pegarProfsPendentes(){
        try {
            
            $sql = "SELECT cod, nome, nome_de_usuario, email FROM professor WHERE ativo = 0 ORDER BY nome ASC";

            $listaProf = [];
                
            $listaProf = $this->banco->SelectVariasLinhas($sql);
           
            foreach ($listaProf as $item) {
                $professor = new Professor();
                $professor->setCod($item['cod']);
                $professor->setNome($item['nome']);
                $professor->setNomeUsuario($item['nome_de_usuario']);
                $professor->setEmail($item['email']);
                
                
                $listaRetornar[] = $professor;
            }
            
            return @$listaRetornar;
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }
    
    function aprovarProf($codProf){
        try {
            
            $sql = "UPDATE professor SET ativo = 1 WHERE cod = :codProf";
            
            $params = array(
                ":codProf" => $codProf
            );
             
            return $this->banco->NonQuery($sql, $params);
            
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }
    
    function excluirProfPendente($cod){
        try {
            
            $sql = "DELETE FROM professor WHERE cod = :cod";
            
            $params = array(
                ":cod" => $cod
            );
             
            return $this->banco->NonQuery($sql, $params);
            
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }
}
