<?php 

$_SESSION['resQuiz'] = "Aqui aparecerá o número de acertos obtidos nas questões da tabela.";
if(!isset($_SESSION['questaoQuiz'])){
$_SESSION['questaoQuiz'] = 1;}

if(isset($_SESSION['nomeUsuario']) && $_SESSION['nomeUsuario'] === "%global%adm"){ 
require_once "profPendentes.php"; }

elseif(isset($_SESSION['nomeProfessor'])){ 
    
require_once "listaAlunos.php";

    }else{ 
    if(filter_input(INPUT_POST, "btnColetar", FILTER_SANITIZE_STRING)){
         $_SESSION['pontuacao'] += 2;
         require_once "controller/AlunoController.php";
$alunoController = new AlunoController();

if (isset($_SESSION['pontuacao'])) {
    
    $alunoController->atualizarPontuacao($_SESSION['cod'], $_SESSION['pontuacao']);
}
    }
    
    ?>


            
<div class="row">
     <?php if(isset($_SESSION['nome'])){ ?>
                    <form method="post" action="" class="text-center">
                            <input type="submit" name="btnColetar" class="btnColetar" value="Clique aqui para coletar seus pontos!">
                    </form>
                <?php } ?>
    <div class="col-md-10 secaoLeft">
        <div class="row">
            <div class="col-md-8 instrucoes">Insira os valores no quadro verde à direita e escolha uma operação. Depois clique em "Calcular".
                
            </div>
        </div>
        
            

        <div class="abaco">
            
             <?php include('util/bolinhas.php'); ?>   
             <div class="txtResultado"></div>
        </div>
        
    </div>

    <div class="col-md-2 secaoRight">
        <div class="conta" style="background: #006666;">
            <input type="text" id="parcela1">
            
            <div class="botoes">
                <button type="button" class="btnAdicao bordaAzul">&plus;</button>
                <button type="button" class="btnSubtracao">&minus;</button>
            </div>
            <input type="text" id="parcela2">
           
            <button type="button" class="btn btn-default calcular">Calcular</button>
            <button type="button" class="btn btn-default apagarCampos">Apagar campos</button>
            <div class="msgConta"></div>
            
        </div>

        
        <?php if (isset($_SESSION['nome'])){ ?>
          <div class="pontuacao" style="background: lightcyan;">
              <span class=spPontuacao>Sua pontuação: <span class="pontos"><?= $_SESSION['pontuacao'] ?></span></span><br />
            <a href='?pagina=pontuacao'>Saiba mais</a>
          </div>  
        <?php }else{ ?>
        <span class="spPont bg-info">Faça login/nova conta acima para ter pontuação.</span>
        <?php } ?>
        

    </div>
</div>                 
       

<?php } ?>
