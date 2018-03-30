<?php
$frutas = ["banana", "melancia", "amora", "abacaxi", "goiaba", "pera", "ameixa", "maçã", 
    "laranja", "abacate", "caju", "kiwi", "morango", "pêssego", "uva"];
$copiaFrutas = [];
$copiaFrutas = $frutas; 

//*1, *2, *3 adicionados para serem trocados na função str_replace()
$perguntas = [
    "Qual o total de quantidade das seguintes frutas: *1 e *2?",
    "Quantas(os) *1s tem a mais/a menos que *2s?",
    "Qual é a fruta com maior quantidade?",
    "Qual é a fruta com menor quantidade?",
    "Qual o valor da casa das *3 da quantidade de *1s?"
    
];
$copiaPerguntas = [];
$copiaPerguntas = $perguntas; 
$casas = ["unidades", "dezenas"];
$z = 0;

$arrayTabela = [];
$arrayQtd = [];

$maximoFrutas = 14;
$maximoPerguntas = count($perguntas) - 1;
$indiceFrutasQuestao;
function retornaQuestao(){
    
    global $maximoPerguntas, $casas, $perguntas, $arrayTabela;
    global $indiceFrutasQuestao;
    $indicePerguntas = rand(0, $maximoPerguntas);
             $cpQuestao = $perguntas[$indicePerguntas];
             $indiceFrutasQuestao = rand(1, 6);
             $perguntas[$indicePerguntas] = str_replace("*1", $arrayTabela[$indiceFrutasQuestao], $perguntas[$indicePerguntas]);      
             $perguntas[$indicePerguntas] = str_replace("*2", $arrayTabela[7 - $indiceFrutasQuestao], $perguntas[$indicePerguntas]);      
             
             $indiceCasas = rand(0, 1);
             $casa = $casas[$indiceCasas];
             $perguntas[$indicePerguntas] = str_replace("*3",$casa , $perguntas[$indicePerguntas]);    
             $questao = $perguntas[$indicePerguntas];
             array_splice($perguntas, $indicePerguntas, 1); 
             $maximoPerguntas--;
             return $questao."@".$cpQuestao."+".$indiceFrutasQuestao."+".$indiceCasas;
}

function calculaResposta($s){
    
    global $maximoPerguntas, $casas, $perguntas, $arrayTabela, $arrayQtd;
    global $copiaPerguntas;
    $copiaArrayQtd = [];
    $copiaArrayQtd = $arrayQtd;
   $arrayS = explode("+", $s);
   $questao = $arrayS[0];
   $indiceFrutasQuestao = $arrayS[1];
 
   $casa = $arrayS[2];
  // $fruta1 = $arrayTabela[$indiceFrutasQuestao];
  // $fruta2 = $arrayTabela[7 - $indiceFrutasQuestao];
   $valor1 = $arrayQtd[$indiceFrutasQuestao];
   $valor2 = $arrayQtd[7 - $indiceFrutasQuestao];
   $indicePergunta = array_search($questao, $copiaPerguntas);
   $resposta = 777777;
   
   switch($indicePergunta){
       case 0:
           $resposta = $valor1 + $valor2;
           break;
       case 1:
           $resposta = $valor1 - $valor2;
           if($valor2 > $valor1){
              $resposta = $valor2 - $valor1; 
           }
           break;
       case 2:
           arsort($copiaArrayQtd);
           $key_of_max = key($copiaArrayQtd);
           $resposta = $arrayTabela[$key_of_max];
           break;
       case 3:
           asort($copiaArrayQtd);
           $key_of_min = key($copiaArrayQtd);
           $resposta = $arrayTabela[$key_of_min];
           break;
       case 4:
           if($casa == 0){
               //unidades 
               
               $resposta = $valor1 % 10;
           }else if($casa == 1){
               //dezenas
              
               $resposta = ($valor1 / 10) % 10;
           }
           break;
       
   }
   return $resposta;
}

function verificarResposta($respostaOficial, $respostaAluno, $letraQuestao){
    global $z, $acertos;
    if($respostaOficial == $respostaAluno){
        if(isset($_SESSION['pontuacao'])){
        $_SESSION['pontuacao']++;
        require_once "controller/AlunoController.php";
$alunoController = new AlunoController();

if (isset($_SESSION['pontuacao'])) {
    
    $alunoController->atualizarPontuacao($_SESSION['cod'], $_SESSION['pontuacao']);
}
        }
       $acertos++; 
    }
  
    if($z == 2){
        if($acertos == 0){
            if(isset($_SESSION['pontuacao'])){
           $_SESSION['resQuiz'] = "Você não acertou nenhuma questão. Mas não desanime, responda as questões abaixo para ganhar pontos!"; 
            }else{
           $_SESSION['resQuiz'] = "Você não acertou nenhuma questão. Mas não desanime, responda as questões na nova tabela abaixo.";    
            }
            
        }else if($acertos == 1){
            if(isset($_SESSION['pontuacao'])){
             $_SESSION['resQuiz'] = "Você acertou 1 questão e ganhou 1 ponto! Responda as questões abaixo para ganhar mais pontos!"; 
        }else{
            $_SESSION['resQuiz'] = "Você acertou 1 questão. Responda mais questões na nova tabela abaixo.";
        }
           
        }else if($acertos == 2){
            if(isset($_SESSION['pontuacao'])){
                $_SESSION['resQuiz'] = "Você acertou 2 questões e ganhou 2 pontos! Responda as questões abaixo para ganhar mais pontos!"; 
        }else{
           $_SESSION['resQuiz'] = "Você acertou 2 questões. Responda mais questões na nova tabela abaixo."; 
        }
         
        }else if($acertos == 3){
            if(isset($_SESSION['pontuacao'])){
                $_SESSION['resQuiz'] = "Parábens, você acertou as 3 questões e ganhou 3 pontos! Responda as questões abaixo para ganhar mais pontos!"; 
        }else{
           $_SESSION['resQuiz'] = "Parábens, você acertou as 3 questões! Responda mais questões na nova tabela abaixo."; 
        }
           
        } 
        $_SESSION['questaoQuiz']++;
}
   $z++;

}

if(filter_input(INPUT_POST, "btnResponder", FILTER_SANITIZE_STRING)){
   $txtRespostaA = filter_input(INPUT_POST, "txtRespostaA", FILTER_SANITIZE_STRING);
   $txtRespostaB = filter_input(INPUT_POST, "txtRespostaB", FILTER_SANITIZE_STRING);
   $txtRespostaC = filter_input(INPUT_POST, "txtRespostaC", FILTER_SANITIZE_STRING);
   $strA = filter_input(INPUT_POST, "strA", FILTER_SANITIZE_STRING);
   $strB = filter_input(INPUT_POST, "strB", FILTER_SANITIZE_STRING);
   $strC = filter_input(INPUT_POST, "strC", FILTER_SANITIZE_STRING);
   $acertouA = verificarResposta($strA, $txtRespostaA, "A");
   $acertouB = verificarResposta($strB, $txtRespostaB, "B");
   $acertouC = verificarResposta($strC, $txtRespostaC, "C");
}


?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <span class="spResQuiz alert alert-info"><?= $_SESSION['resQuiz']?></span><br /><br /><br />
        <span class="spEnunciado">Dada a tabela abaixo, de frutas e suas quantidades, responda as seguintes questões.</span>
        <h1 class="tituloQuiz text-center">Tabela <?= $_SESSION['questaoQuiz'] ?></h1>
        <table class="table table-bordered table-condensed tabelaQuiz">
            <thead>
    <tr>
      <th>FRUTA</th>
      <th>QUANTIDADE</th>
    </tr>
  </thead>
  
  <tbody>
      <?php  for($i=0; $i < 7; $i++){
          $indiceFrutas = rand(0, $maximoFrutas);
          $arrayTabela[] = $frutas[$indiceFrutas];
          $qtd = rand(1,99);
          $arrayQtd[] = $qtd;
        ?>
      <tr>
      
      <th scope="row"><?= $frutas[$indiceFrutas] ?></th>
      <td class="text-center"><?= $qtd ?></td>
      
    </tr>
    <?php array_splice($frutas, $indiceFrutas, 1); $maximoFrutas--; 
    
      } ?>
    
 </tbody>
</table>
        
        <form class="frmQuiz" method="post" action="">
        
        <div>a)<?php
                $arrayQuestaoA = explode("@",retornaQuestao()); 
                $strA = calculaResposta($arrayQuestaoA[1]);
                ?>
            <span class="spQuestao"><?= $arrayQuestaoA[0] ?></span>
            <input type="text" name="txtRespostaA" />
            <input type="hidden" name="strA" value="<?= $strA ?>">
        </div>
        
        <div>b)<?php
                $arrayQuestaoB = explode("@",retornaQuestao()); 
                $strB = calculaResposta($arrayQuestaoB[1]);
                ?> 
            <span class="spQuestao"><?= $arrayQuestaoB[0] ?></span>
            <input type="text" name="txtRespostaB" />
            <input type="hidden" name="strB" value="<?= $strB ?>"/>
        </div>
       
        <div>c)<?php
                $arrayQuestaoC = explode("@",retornaQuestao()); 
                $strC = calculaResposta($arrayQuestaoC[1]);
                
                ?> 
            <span class="spQuestao"><?= $arrayQuestaoC[0] ?></span>
            <input type="text" name="txtRespostaC" />
            <input type="hidden" name="strC" value="<?= $strC ?>"/>
        </div>  
            <?php if (isset($_SESSION['nome'])){ ?>
          <div class="pontuacao pull-right" style="background: lightcyan;">
            Sua pontuação: <?= $_SESSION['pontuacao'] ?> <br />
            <a href='?pagina=pontuacao'>Saiba mais</a>
          </div>  
        <?php }else{ ?>
        <span class="spPont bg-info pull-right">Faça login/nova conta acima para ter pontuação.</span>
        <?php } ?> 
            <input type="submit" class="btnResponder btn btn-success" name="btnResponder" value="Responder" />
        </form>
       
        
    </div>
    
    </div>

<script>
    $(document).ready(function(){
    window.scroll(0, 26);
    });
</script>


