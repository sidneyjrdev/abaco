<?php 

    
    if(filter_input(INPUT_POST, "btnColetarMultip", FILTER_SANITIZE_STRING)){
         $_SESSION['pontuacao'] += 3;
         require_once "controller/AlunoController.php";
$alunoController = new AlunoController();

if (isset($_SESSION['pontuacao'])) {
    
    $alunoController->atualizarPontuacao($_SESSION['cod'], $_SESSION['pontuacao']);
}
    }
    
 ?>
<div class="row">

    <div class="col-md-3 col-md-offset-2">
        <div class="instrucoesMultip">Clique no botão "Gerar conta" para começar o passo-a-passo.</div>
        
        <?php if (isset($_SESSION['nome'])){ ?>
            <form method="post" action="">
                <input type="submit" name="btnColetarMultip" class="btnColetar" value="Clique aqui para coletar seus pontos!" style="display: none;">
            </form>
            <?php } ?>
        
        <div class="contaMultip">
            <div class="row">
                <div class="col-md-2  col-md-offset-6 bolinhaMultip">
                   <input type="text" class="inputbolinha" disabled="disabled"/> 
                </div>
            </div>
            
            <div class="row">
                    <div class="col-md-2 col-md-offset-6 dezenasp1Multip">0</div>
                    <div class="col-md-2 unidadesp1Multip">0</div>
                
            </div>
            
            <div class="row linha3">
                    <div class="col-md-2  col-md-offset-4 sinalVezes">x</div>
                    <div class="col-md-2 dezenasp2Multip">0</div>
                    <div class="col-md-2 unidadesp2Multip">0</div>
                
            </div>
            
            <div class="row">
                <div class="col-md-2  col-md-offset-4 centenasp3Multip preencher">
                    <input type="text" class="inputcentenasp3" disabled="disabled"/>
                </div>
                <div class="col-md-2 dezenasp3Multip preencher">
                    <input type="text" class="inputdezenasp3" disabled="disabled"/>
                </div>
                <div class="col-md-2 unidadesp3Multip preencher">
                    <input type="text" class="inputunidadesp3" disabled="disabled"/>
                </div>
            </div>
            
            <div class="row linha5">
                <div class="col-md-2 sinalMais">+</div>
                <div class="col-md-2 milharp4Multip preencher">
                    <input type="text" class="inputmilharp4" disabled="disabled"/>
                </div>
                <div class="col-md-2 centenasp4Multip preencher">
                    <input type="text" class="inputcentenasp4" disabled="disabled"/>
                </div>
                <div class="col-md-2 dezenasp4Multip preencher">
                    <input type="text" class="inputdezenasp4" disabled="disabled"/>
                </div>
                <div class="col-md-2 zerop4Multip preencher">
                    <input type="text" class="inputZerop4" disabled="disabled" value="0"/>
                </div>
            </div>
           
            <div class="row">
                <div class="col-md-2  col-md-offset-2 milharResMultip preencher">
                    <input type="text" class="inputmilharRes" disabled="disabled"/>
                </div>
                <div class="col-md-2 centenasResMultip preencher">
                    <input type="text" class="inputcentenasRes" disabled="disabled"/>
                </div>
                <div class="col-md-2 dezenasResMultip preencher">
                    <input type="text" class="inputdezenasRes" disabled="disabled"/>
                </div>
                <div class="col-md-2 unidadesResMultip preencher">
                    <input type="text" class="inputunidadesRes" disabled="disabled"/>
                </div>
            </div>
        </div>
        <button class="btn btn-success pull-right btnGerarMultip">Gerar conta</button>
        
        <br />
        <?php if (isset($_SESSION['nome'])){ ?>
          <div class="pontuacaoMultip" style="background: lightcyan;">
            Sua pontuação: <?= $_SESSION['pontuacao'] ?> <br />
            <a href='?pagina=pontuacao'>Saiba mais</a>
          </div>  
        <?php }else{ ?>
        <span class="spPont bg-info">Faça login/nova conta acima para ter pontuação.</span>
        <?php } ?>
    </div>
    
    
    
    <div class="col-md-6 pull-right">
        
            <img src="img/tabuada-.png" class="imgTabuada" alt=""/><br /><br />
            <span class="obsMultip">Obs.: Qualquer número multiplicado por 0 dá 0.</span>
    </div>
</div>