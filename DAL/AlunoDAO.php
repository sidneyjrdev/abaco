<?php

require_once "Banco.php";

if (isset($_POST['req'])) {
    require_once "../model/Aluno.php";
} else {
    require_once "model/Aluno.php";
}

class AlunoDAO {

    private $banco;
    private $res;

    public function __construct() {
        $this->banco = new Banco();
    }

    function pegarAlunoLogin($nomeUsuario, $senha) {
        try {
            $sql = "SELECT * FROM aluno WHERE nome_de_usuario=:nomeUsuario AND senha=:senha";
            $params = array(
                ":nomeUsuario" => $nomeUsuario,
                ":senha" => $senha);

            $res = $this->banco->SelectUmaLinha($sql, $params);

            if ($res != null) {
                $aluno = new Aluno();
                $aluno->setCod($res['cod']);
                $aluno->setPontuacao($res['pontuacao']);
                $aluno->setNomeUsuario($res['nome_de_usuario']);
                $aluno->setSenha($res['senha']);
                $aluno->setNome($res['nome']);
                $aluno->getProfessor()->setCod($res['cod_professor']);
                $aluno->getEscola()->setCod($res['cod_escola']);
                return $aluno;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();

            return null;
        }
    }
    
    function mudarPontuacao($cod, $pontuacao){
        try{
          $sql = "UPDATE aluno SET pontuacao=:pontuacao WHERE cod=:cod";
            $params = array(
                ":cod" => $cod,
                ":pontuacao" => $pontuacao
            );

            return $this->banco->NonQuery($sql, $params);  
        } catch (PDOException $ex) {
            echo 'erro: ' . $ex->getMessage() . ' na linha: ' . $ex->getLine();
            return false;
        }
    }

    function cadastrarAluno($aluno) {
        try {

            $sql = "INSERT INTO aluno(nome, nome_de_usuario, pontuacao, senha, cod_escola) VALUES(:nome, :nomeUsuario, :pontuacao, :senha, :escola)";
            $params = array(
                ":nome" => $aluno->getNome(),
                ":nomeUsuario" => $aluno->getNomeUsuario(),
                ":pontuacao" => $aluno->getPontuacao(),
                ":senha" => md5($aluno->getSenha()),
                ":escola" => $aluno->getEscola()->getCod()
                
            );

            return $this->banco->NonQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }

    function pegarListaUsuarios() {
        try {
            $sql = "SELECT nome_de_usuario FROM aluno UNION SELECT nome_de_usuario FROM professor";
            $listaUsuarios = [];
            $listaUsuarios = $this->banco->SelectVariasLinhas($sql);
            return $listaUsuarios;
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }
    
    
    function filtroRanking($escolaFiltro){
        try {
            
            $termoEscola = '%' . $escolaFiltro . '%';
            
            
            $sql = "SELECT a.nome_de_usuario, a.pontuacao, e.nome as nomeEscola, e.bairro, e.cod as codEscola from aluno a, escola e WHERE e.nome LIKE :termoEscola AND a.cod_escola = e.cod ORDER BY a.pontuacao DESC";
            $params = array(
                ":termoEscola" => $termoEscola
            );
            
            
            $listaRanking = [];
            $listaRanking = $this->banco->SelectVariasLinhas($sql, $params);
            
            foreach ($listaRanking as $item) {
                $aluno = new Aluno();
                
                $aluno->setNomeUsuario($item['nome_de_usuario']);
                $aluno->getEscola()->setCod($item['codEscola']);
                $aluno->setPontuacao($item['pontuacao']);
                $aluno->getEscola()->setNome($item['nomeEscola']);
                $aluno->getEscola()->setBairro($item['bairro']);
                
                $listaRetornar[] = $aluno;
            }
            
            return @$listaRetornar;
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }

    
    public function editarAluno($aluno) {
        try {
            
                $sql = "UPDATE aluno SET nome = :nome, nome_de_usuario = :nomeUsuario, cod_escola = :escola WHERE cod = :cod";
                $params = array(
                    ":nome" => $aluno->getNome(),
                    ":nomeUsuario" => $aluno->getNomeUsuario(),
                    ":escola" => $aluno->getEscola()->getCod(),
                    ":cod" => $aluno->getCod()
                );
           
                return $this->banco->NonQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }

    public function excluirAluno($cod) {
        try {
            $sql = "DELETE FROM aluno WHERE cod = :cod";
            $params = array(
                ":cod" => $cod
            );

            return $this->banco->NonQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }
    
    public function atualizarPontuacao($cod, $pontuacao) {
        try {
            $sql = "UPDATE aluno SET pontuacao = :pontuacao WHERE cod = :cod";
            $params = array(
                ":cod" => $cod,
                ":pontuacao" => $pontuacao
            );

            return $this->banco->NonQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }
    
    function filtroAdicionar($escolaFiltro, $nomeFiltro){
        try {
            
            $termoEscola = '%' . $escolaFiltro . '%';
            $termoNome = '%' . $nomeFiltro . '%';
            
            $sql = "SELECT DISTINCT a.cod as codAluno, a.nome as nomeAluno, a.nome_de_usuario, e.cod as codEscola, a.pontuacao, a.cod_professor, e.nome as nomeEscola, e.bairro from aluno a, escola e WHERE e.nome LIKE :termoEscola AND a.nome LIKE :termoNome AND a.cod_escola = e.cod ORDER BY a.nome ASC";
            $params = array(
                ":termoEscola" => $termoEscola,
                ":termoNome" => $termoNome,
            );
            
            
            $listaAlunos = [];
            $listaAlunos = $this->banco->SelectVariasLinhas($sql, $params);
            
            foreach ($listaAlunos as $item) {
                $aluno = new Aluno();
                $aluno->setCod($item['codAluno']);
                $aluno->setNome($item['nomeAluno']);
                $aluno->setNomeUsuario($item['nome_de_usuario']);
                $aluno->getEscola()->setCod($item['codEscola']);
                $aluno->setPontuacao($item['pontuacao']);
                $aluno->getProfessor()->setCod($item['cod_professor']);
                $aluno->getEscola()->setNome($item['nomeEscola']);
                $aluno->getEscola()->setBairro($item['bairro']);
                
                $listaRetornar[] = $aluno;
            }
            
            return @$listaRetornar;
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }
    
    function excluirAlunoLista($cod){
      try {
          $sql = "UPDATE aluno SET cod_professor = null WHERE cod = :cod";
            $params = array(
                ":cod" => $cod
            );

            return $this->banco->NonQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }  
    }
    
    function adicionarAlunoLista($codAluno, $codProf){
      try {
            $sql = "UPDATE aluno SET cod_professor = :codProf WHERE cod = :codAluno";
            $params = array(
                ":codProf" => $codProf,
                ":codAluno" => $codAluno
           );

            return $this->banco->NonQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }  
    }
    
    function pegarListaAlunos($codProf){
        try {
            
            $params = array(
                ":codProf" => $codProf,
            );
            
            $listaAlunos = [];
            
            if($codProf == '%'){
                $sql = "SELECT a.cod as codAluno, a.nome as nomeAluno, a.nome_de_usuario, e.cod as codEscola, a.pontuacao, a.cod_professor, e.nome as nomeEscola, e.bairro from aluno a, escola e WHERE a.cod_escola = e.cod ORDER BY a.nome ASC";
                $listaAlunos = $this->banco->SelectVariasLinhas($sql);
            }else{
                $sql = "SELECT a.cod as codAluno, a.nome as nomeAluno, a.nome_de_usuario, e.cod as codEscola, a.pontuacao, a.cod_professor, e.nome as nomeEscola, e.bairro from aluno a, escola e WHERE a.cod_professor = :codProf AND a.cod_escola = e.cod ORDER BY a.nome ASC";
                $listaAlunos = $this->banco->SelectVariasLinhas($sql, $params);
            }
            
            
            
            foreach ($listaAlunos as $item) {
                $aluno = new Aluno();
                $aluno->setCod($item['codAluno']);
                $aluno->setNome($item['nomeAluno']);
                $aluno->setNomeUsuario($item['nome_de_usuario']);
                $aluno->getEscola()->setCod($item['codEscola']);
                $aluno->setPontuacao($item['pontuacao']);
                $aluno->getProfessor()->setCod($item['cod_professor']);
                $aluno->getEscola()->setNome($item['nomeEscola']);
                $aluno->getEscola()->setBairro($item['bairro']);
                
                $listaRetornar[] = $aluno;
            }
            
            return @$listaRetornar;
        } catch (PDOException $e) {
            echo 'erro: ' . $e->getMessage() . ' na linha: ' . $e->getLine();
            return false;
        }
    }
 
}
