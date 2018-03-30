//multiplicação
$(document).ready(function () {
var p1, p2, p3, p4, res, bolinhap3, bolinhap4, unidadesp1, unidadesp2, unidadesp3, unidadesp4, unidadesRes, dezenasp1, dezenasp2, dezenasp3, dezenasp4, dezenasRes, centenasp1, centenasp2, centenasp3, centenasp4, centenasRes, milharp4, milharRes = 0;
var instrucoes = $(".instrucoesMultip");
var ehBolinhap4;


//função para sortear parcelas
function randomIntFromInterval(min, max)
{
    var retorno = Math.floor(Math.random() * (max - min + 1) + min);
    
    //Condição feita para evitar repetição de contas e consequente confusão no enetendimento
    if((parseInt(retorno) % 11) === 0){
        retorno++;
    }
    return retorno;
}

function terminarMultip(){
    $(".btnColetar").css("display", "block");
    $(".inputmilharRes").attr("disabled", "disabled");
    $(".milharResMultip").removeClass("bordaVerde");
    $(".milharResMultip").removeClass("bordaVermelha");
    
    instrucoes.text("Pronto, fizemos a multiplicação, cujo resultado é " + res + ". Você ganhou três pontos!(se estiver logado)");
    
}

function milharResFunc(){
    $(".inputcentenasRes").attr("disabled", "disabled");
    $(".centenasResMultip").removeClass("bordaVerde");
    $(".centenasResMultip").removeClass("bordaVermelha");
    
    $(".inputmilharRes").removeAttr("disabled").focus();
    $(".milharResMultip").addClass("bordaVerde");
    instrucoes.text("Agora, preencha o quadrado de borda verde de acordo com a soma. Se for vazio, insira 0.");
}

function centenasResFunc(){
   $(".inputdezenasRes").attr("disabled", "disabled");
    $(".dezenasResMultip").removeClass("bordaVerde");
    $(".dezenasResMultip").removeClass("bordaVermelha");
    
    $(".inputcentenasRes").removeAttr("disabled").focus();
    $(".centenasResMultip").addClass("bordaVerde");
    instrucoes.text("Agora, preencha o quadrado de borda verde de acordo com a soma.");
}

function dezenasResFunc(){
    $(".inputunidadesRes").attr("disabled", "disabled");
    $(".unidadesResMultip").removeClass("bordaVerde");
    $(".unidadesResMultip").removeClass("bordaVermelha");
    
    $(".inputdezenasRes").removeAttr("disabled").focus();
    $(".dezenasResMultip").addClass("bordaVerde");
    instrucoes.text("Agora, preencha o quadrado de borda verde de acordo com a soma.");
}

function unidadesResFunc(){
    $(".inputmilharp4").attr("disabled", "disabled");
    $(".milharp4Multip").removeClass("bordaVerde");
    $(".milharp4Multip").removeClass("bordaVermelha");
    
    $(".inputunidadesRes").removeAttr("disabled").focus();
    $(".unidadesResMultip").addClass("bordaVerde");
    instrucoes.text("Agora, preencha o quadrado de borda verde de acordo com a soma."); 
}

function milharp4Func(){
   $(".inputcentenasp4").attr("disabled", "disabled");
   $(".centenasp4Multip").removeClass("bordaVerde");
   $(".centenasp4Multip").removeClass("bordaVermelha");
   
   
   $(".inputmilharp4").removeAttr("disabled").focus();
   $(".milharp4Multip").addClass("bordaVerde");
   
   instrucoes.text("Agora, preencha o quadrado de borda verde com as dezenas(se não tiver, preencha com 0) de " + dezenasp1 + " x " + dezenasp2 + " mais " + bolinhap4 + " , olhando na tabuada, se precisar."); 
}

function centenasp4Func(){
   $(".inputbolinha").attr("disabled", "disabled");
   $(".bolinhaMultip").removeClass("bordaVerde");
   $(".bolinhaMultip").removeClass("bordaVermelha");
   
   $(".inputcentenasp4").removeAttr("disabled").focus();
   $(".centenasp4Multip").addClass("bordaVerde");
   
   instrucoes.text("Agora, preencha o quadrado de borda verde com as unidades de " + dezenasp1 + " x " + dezenasp2 + " mais " + bolinhap4 + " , olhando na tabuada, se precisar.");  
}

function bolinhap4Func(){
    $(".inputdezenasp4").attr("disabled", "disabled");
    $(".dezenasp4Multip").removeClass("bordaVerde");
    $(".dezenasp4Multip").removeClass("bordaVermelha");
    
    $(".inputbolinha").removeAttr("disabled").focus();
    $(".bolinhaMultip").addClass("bordaVerde");
    $(".inputbolinha").val("");
    instrucoes.text("Agora, preencha a bolinha com as dezenas de " + unidadesp1 + " x " + dezenasp2 + " (se não tiver, preencha com 0), olhando na tabuada, se precisar."); 
}

function dezenasp4Func(){
   $(".unidadesp2Multip").removeClass("letraAzul");
   $(".dezenasp2Multip").addClass("letraAzul");
    
   $(".inputcentenasp3").attr("disabled", "disabled");
   $(".centenasp3Multip").removeClass("bordaVerde");
   $(".centenasp3Multip").removeClass("bordaVermelha");
   
   $(".inputdezenasp4").removeAttr("disabled").focus();
   $(".dezenasp4Multip").addClass("bordaVerde");
   
   instrucoes.text("Agora, façamos a operação em azul. Preencha o quadrado de borda verde com as unidades de " + unidadesp1 + " x " + dezenasp2 + " , olhando na tabuada, se precisar.");  
}

function centenasp3Func(){
   $(".inputdezenasp3").attr("disabled", "disabled");
   $(".dezenasp3Multip").removeClass("bordaVerde");
   $(".dezenasp3Multip").removeClass("bordaVermelha");
   
   
   $(".inputcentenasp3").removeAttr("disabled").focus();
   $(".centenasp3Multip").addClass("bordaVerde");
   
   instrucoes.text("Agora, preencha os quadrados de borda verde com as dezenas(se não tiver, preencha com 0) de " + dezenasp1 + " x " + unidadesp2 + " mais " + bolinhap3 + " , olhando na tabuada, se precisar."); 
}

function dezenasp3Func(){
   ehBolinhap4 = true;
   
   $(".inputbolinha").attr("disabled", "disabled");
   $(".bolinhaMultip").removeClass("bordaVerde");
   $(".bolinhaMultip").removeClass("bordaVermelha");
   
   $(".inputdezenasp3").removeAttr("disabled").focus();
   $(".dezenasp3Multip").addClass("bordaVerde");
   
   instrucoes.text("Agora, preencha o quadrado de borda verde com as unidades de " + dezenasp1 + " x " + unidadesp2 + " mais " + bolinhap3 + " , olhando na tabuada, se precisar."); 
}

function bolinhap3Func(){
    $(".inputunidadesp3").attr("disabled", "disabled");
    $(".unidadesp3Multip").removeClass("bordaVerde");
    $(".unidadesp3Multip").removeClass("bordaVermelha");
    
    $(".inputbolinha").removeAttr("disabled").focus();
    $(".bolinhaMultip").addClass("bordaVerde");
    instrucoes.text("Agora, preencha a bolinha com as dezenas de " + unidadesp1 + " x " + unidadesp2 + " (se não tiver, preencha com 0), olhando na tabuada, se precisar."); 
}

function unidadesp3Func(){
   $(".inputunidadesp3").removeAttr("disabled").focus();
   $(".sinalVezes, .unidadesp1Multip, .dezenasp1Multip, .unidadesp2Multip").addClass("letraAzul");
   $(".unidadesp3Multip").addClass("bordaVerde");
   instrucoes.text("Comecemos pela operação em azul. Preencha o quadrado de borda verde com as unidades de " + unidadesp1 + " x " + unidadesp2 + " , olhando na tabuada, se precisar."); 
   
}

//clicou em gerar conta
$(".btnGerarMultip").click(function(){
    $(".contaMultip input[type='text']").val("");
    $(".contaMultip .inputZerop4").val("0");
    p1 = parseInt(randomIntFromInterval(10, 99));
    p2 = parseInt(randomIntFromInterval(10, 99)); 
    res = parseInt(p1 * p2);
    ehBolinhap4 = false;
    
    
    unidadesp1 = parseInt(p1 % 10);
    $(".unidadesp1Multip").text(unidadesp1);
    dezenasp1 = parseInt((p1 / 10)) % 10;
    $(".dezenasp1Multip").text(dezenasp1);
    unidadesp2 = parseInt(p2 % 10);
    $(".unidadesp2Multip").text(unidadesp2);
    dezenasp2 = parseInt((p2 / 10)) % 10; 
    $(".dezenasp2Multip").text(dezenasp2);
    
    p3 = parseInt(p1 * unidadesp2);
    p4 = parseInt(p1 * dezenasp2 * 10);
    
    unidadesp3 = parseInt(p3 % 10);
    dezenasp3 = parseInt((p3 / 10)) % 10;
    centenasp3 = parseInt((p3 / 100)) % 10;
    dezenasp4 = parseInt((p4 / 10)) % 10;
    centenasp4 = parseInt((p4 / 100)) % 10;
    milharp4 = parseInt((p4 / 1000)) % 10;
    unidadesRes = parseInt(res % 10);
    dezenasRes = parseInt((res / 10)) % 10;
    centenasRes = parseInt((res / 100)) % 10;
    milharRes = parseInt((res / 1000)) % 10;
    
    bolinhap3 = parseInt((unidadesp1 * unidadesp2 / 10) % 10);
    bolinhap4 = parseInt((unidadesp1 * dezenasp2 / 10) % 10);
   
    unidadesp3Func();
    
});

$(".inputunidadesp3").keyup(function(){
    if($(this).val() == unidadesp3 && $(this).val() != ""){
       bolinhap3Func(); 
    }else{
       $(".unidadesp3Multip").removeClass("bordaVerde");
       $(".unidadesp3Multip").addClass("bordaVermelha");
       instrucoes.text("Valor inserido incorreto. Verifique a tabuada e tente de novo.");
    }
 });
 
 $(".inputbolinha").keyup(function(){ 
    if(ehBolinhap4){
      if($(this).val() == bolinhap4 && $(this).val() != ""){
       centenasp4Func(); 
    }else{
       $(".bolinhaMultip").removeClass("bordaVerde");
       $(".bolinhaMultip").addClass("bordaVermelha");
       instrucoes.text("Valor inserido incorreto. Verifique a tabuada e tente de novo.");
    }  
    }else{
      if($(this).val() == bolinhap3 && $(this).val() != ""){
       dezenasp3Func(); 
    }else{
       $(".bolinhaMultip").removeClass("bordaVerde");
       $(".bolinhaMultip").addClass("bordaVermelha");
       instrucoes.text("Valor inserido incorreto. Verifique a tabuada e tente de novo.");
    }  
    } 
    
 });
 
$(".inputdezenasp3").keyup(function(){
    if($(this).val() == dezenasp3 && $(this).val() != ""){
        
                centenasp3Func(); 
          
    }else{
       $(".dezenasp3Multip").removeClass("bordaVerde");
       $(".dezenasp3Multip").addClass("bordaVermelha");
       instrucoes.text("Valor inserido incorreto. Verifique a tabuada e tente de novo.");
       
    }
 });
 
$(".inputcentenasp3").keyup(function(){
    
    if($(this).val() == centenasp3 && $(this).val() != ""){
            
                dezenasp4Func(); 
           
    }else{
       $(".centenasp3Multip").removeClass("bordaVerde"); 
       $(".centenasp3Multip").addClass("bordaVermelha");
       instrucoes.text("Valor inserido incorreto. Verifique a tabuada e tente de novo.");
       
    }
 });
 
$(".inputdezenasp4").keyup(function(){
    if($(this).val() == dezenasp4 && $(this).val() != ""){
            bolinhap4Func(); 
    }else{
        $(".dezenasp4Multip").removeClass("bordaVerde");
       $(".dezenasp4Multip").addClass("bordaVermelha");
       instrucoes.text("Valor inserido incorreto. Verifique a tabuada e tente de novo.");
    }
 });
 
$(".inputcentenasp4").keyup(function(){
    if($(this).val() == centenasp4 && $(this).val() != ""){
       milharp4Func(); 
    }else{
       $(".centenasp4Multip").removeClass("bordaVerde");
       $(".centenasp4Multip").addClass("bordaVermelha");
       instrucoes.text("Valor inserido incorreto. Verifique a tabuada e tente de novo.");
    }
 });
 
$(".inputmilharp4").keyup(function(){
    if($(this).val() == milharp4 && $(this).val() != ""){
       unidadesResFunc(); 
    }else{
       $(".milharp4Multip").removeClass("bordaVerde");
       $(".milharp4Multip").addClass("bordaVermelha");
       instrucoes.text("Valor inserido incorreto. Verifique a tabuada e tente de novo.");
    }
 });
 
$(".inputunidadesRes").keyup(function(){
    if($(this).val() == unidadesRes && $(this).val() != ""){
       dezenasResFunc(); 
    }else{
       $(".unidadesResMultip").removeClass("bordaVerde");
       $(".unidadesResMultip").addClass("bordaVermelha");
       instrucoes.text("Valor inserido incorreto. Verifique a soma e tente de novo.");
    }
 });
 
$(".inputdezenasRes").keyup(function(){
    if($(this).val() == dezenasRes && $(this).val() != ""){
       centenasResFunc(); 
    }else{
       $(".dezenasResMultip").removeClass("bordaVerde");
       $(".dezenasResMultip").addClass("bordaVermelha");
       instrucoes.text("Valor inserido incorreto. Verifique a soma e tente de novo.");
    }
 });
 
$(".inputcentenasRes").keyup(function(){
    if($(this).val() == centenasRes && $(this).val() != ""){
       milharResFunc(); 
    }else{
       $(".centenasResMultip").removeClass("bordaVerde");
       $(".centenasResMultip").addClass("bordaVermelha");
       instrucoes.text("Valor inserido incorreto. Verifique a soma e tente de novo.");
    }
 });
 
$(".inputmilharRes").keyup(function(){
    if($(this).val() == milharRes && $(this).val() != ""){
       terminarMultip(); 
    }else{
       $(".milharResMultip").removeClass("bordaVerde");
       $(".milharResMultip").addClass("bordaVermelha");
       instrucoes.text("Valor inserido incorreto. Verifique a soma e tente de novo.");
    }
 });
});
