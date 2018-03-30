//ábaco
$(document).ready(function () {

    var soma, diferenca, p1, p2, op="adição", a, u, d, c, trocouUnidades, trocouDezenas, i, restantes, faltaram, executandop2, unidadesp1, dezenasp1, centenasp1, unidadesp2, dezenasp2, centenasp2, ativas;
    var instrucoes = $(".instrucoes");
    var msgConta = $(".msgConta");
    var txtResultado = $(".txtResultado");
    
    
    function terminarAbaco() {
        $(".centenas button").each(function () {
            $(this).removeClass("bordaAzul");
        });


        if (op === "adição") {
            var unidadesSoma = parseInt(soma) % 10;
            var dezenasSoma = parseInt((soma / 10)) % 10;
            var centenasSoma = parseInt((soma / 100)) % 10;

            if (unidadesSoma !== 0) {
                for (i = 1; i <= unidadesSoma; i++) {
                    $("#" + i).addClass("bordaAzul");
                }
            }

            if (dezenasSoma !== 0) {
                for (i = 1; i <= dezenasSoma; i++) {
                    var id = i + 10;
                    $("#" + id).addClass("bordaAzul");
                }
            }

            if (centenasSoma !== 0) {
                for (i = 1; i <= centenasSoma; i++) {
                    var id = i + 20;
                    $("#" + id).addClass("bordaAzul");
                }
            }
            setTimeout(function(){
                instrucoes.text("Pronto! A soma é " + soma + " , que está representada pelas bolinhas em destaque em cada casa. Você ganhou 2 pontos!(se estiver logado)");
                txtResultado.text(soma);
                $(".btnColetar").css("display", "block");
            }, 600);
            
        } else {
            var unidadesSub = parseInt(diferenca) % 10;
            var dezenasSub = parseInt((diferenca / 10)) % 10;
            var centenasSub = parseInt((diferenca / 100)) % 10;

            if (unidadesSub !== 0) {
                for (i = 1; i <= unidadesSub; i++) {
                    $("#" + i).addClass("bordaAzul");
                }
            }

            if (dezenasSub !== 0) {
                for (i = 1; i <= dezenasSub; i++) {
                    var id = i + 10;
                    $("#" + id).addClass("bordaAzul");
                }
            }

            if (centenasSub !== 0) {
                for (i = 1; i <= centenasSub; i++) {
                    var id = i + 20;
                    $("#" + id).addClass("bordaAzul");
                }
            }
            setTimeout(function(){
                instrucoes.html("Pronto! A diferença é " + diferenca + " , que está representada pelas bolinhas em destaque em cada casa. Você ganhou 2 pontos!(se estiver logado)");
                txtResultado.text(diferenca);
                $(".btnColetar").css("display", "block");
            }, 600);
            
        }
        $(".calcular, .btnAdicao, .btnSubtracao").removeAttr("disabled");
        var pontuacao = parseInt($('.pontos').text());
        pontuacao += 2;
        $(".pontos").text(pontuacao);
        
    }

    function trocarUnidades() {
        if(op==="adição"){
        faltaram = unidadesp2 - restantes;
        $("#1").removeAttr("disabled");

        $(".unidades button").each(function () {
            $(this).removeClass("bordaAzul");
        });
       
        for (i = 1; i <= faltaram; i++) {

            $("#" + i).addClass("bordaAzul");

        }
        if(faltaram !== 0){
         instrucoes.text("Faltaram " + faltaram + " bolinhas vermelhas. Então vamos abaixá-las. Clique nelas, de baixo para cima.");
        }else{
            $("#" + d).removeAttr("disabled");
            iniciarDezenasp2();  
        }
    }else{
       faltaram = unidadesp2 - parseInt(ativas);
        $("#10").removeAttr("disabled");

        $(".unidades button").each(function () {
            $(this).removeClass("bordaAzul");
        });
        
        
        for (i = 10; i > 10 - faltaram; i--) {
            
            $("#" + i).addClass("bordaAzul");

        }
        if(faltaram !== 0){
         instrucoes.text("Faltaram " + faltaram + " bolinhas vermelhas. Então vamos subi-las. Clique nelas, de cima para baixo.");
        }else{
            var id = d - 1;
            $("#" + id).removeAttr("disabled");
            iniciarDezenasp2();  
        } 
    }

    }

    function trocarDezenas() {
        if(op==="adição"){
        faltaram = dezenasp2 - restantes;
        $("#11").removeAttr("disabled");
        
        $(".dezenas button").each(function () {
            $(this).removeClass("bordaAzul");
        });
        for (i = 1; i <= faltaram; i++) {
            var id = i + 10;
            $("#" + id).addClass("bordaAzul");
            
        }
        if(faltaram !== 0){
         instrucoes.text("Faltaram " + faltaram + " bolinhas amarelas. Então vamos abaixá-las. Clique nelas, de baixo para cima.");
        }else{
            $("#" + c).removeAttr("disabled");
            iniciarCentenasp2();  
        }
    }else{
        faltaram = dezenasp2 - parseInt(ativas);
        $("#20").removeAttr("disabled");

        $(".dezenas button").each(function () {
            $(this).removeClass("bordaAzul");
        });
        for (i = 20; i > 20 - faltaram; i--) {
            
            $("#" + i).addClass("bordaAzul");

        }
        if(faltaram !== 0){
         instrucoes.text("Faltaram " + faltaram + " bolinhas amarelas. Então vamos subi-las. Clique nelas, de cima para baixo.");
        }else{
            var id = c - 1;
            $("#" + id).removeAttr("disabled");
            iniciarCentenasp2();  
        } 
    }

    }

    function iniciarDezenasp1() {
        $(".unidades button").each(function () {
                $(this).removeClass("bordaAzul");
            });
        if (dezenasp1 !== 0) {

            
            $("#11").removeAttr("disabled");

            for (i = 1; i <= dezenasp1; i++) {

                var id = i + 10;
                $("#" + id).addClass("bordaAzul");

            }
            instrucoes.text("Agora, vamos para a casa das dezenas, que é " + dezenasp1 + ". Clique nas " + dezenasp1 + " bolinhas amarelas que estão indicadas no ábaco, de baixo para cima");

        } else {
            instrucoes.text("Como a casa das dezenas é 0, vamos direto pro próximo passo...");
            setTimeout(function(){
                iniciarCentenasp1();
            }, 3200);
        }
    }

    function iniciarCentenasp1() {
        $(".dezenas button").each(function () {
                $(this).removeClass("bordaAzul");
            });
        if (centenasp1 !== 0) {
            var limite = centenasp1;
            
            $("#21").removeAttr("disabled");
            if (trocouDezenas) {
                limite++;
            }
            for (i = 1; i <= limite; i++) {

                var id = i + 20;
                $("#" + id).addClass("bordaAzul");

            }
            instrucoes.text("Finalmente, vamos para a casa das centenas, que é " + centenasp1 + ". Clique nas " + centenasp1 + " bolinhas verdes que estão indicadas no ábaco, de cima para baixo");

        } else {
            instrucoes.text("Como a parcela não possui a casa das centenas, vamos direto pro próximo passo...");
            setTimeout(function(){
                iniciarUnidadesp2();
            }, 2600);
            
        }
    }

    function iniciarUnidadesp2() {
        executandop2 = true;
         $(".centenas button").each(function () {
                        $(this).removeClass("bordaAzul");
                    });
        if (unidadesp2 !== 0) {
            switch (op) {
                case 'adição':

                    if ((parseInt(u) + parseInt(unidadesp2)) > 11) {
                        restantes = 11 - u;

                        for (i = 1; i <= restantes; i++) {

                            var id = parseInt(i) + (u - 1);
                            $("#" + id).addClass("bordaAzul");

                        }

                        instrucoes.text("Vamos somar a segunda parcela à primeira. Iniciemos pela sua casa das unidades, que é " + unidadesp2 + ". Perceba que não há bolinhas vermelhas suficientes para representar essa quantidade. Então primeiro vamos abaixar as " + restantes + " bolinhas restantes, de baixo para cima. Note que depois disso uma bolinha amarela descerá para que as dez vermelhas subam.");

                    } else {

                        instrucoes.text("Vamos somar a segunda parcela à primeira. Iniciemos pela sua casa das unidades, que é " + unidadesp2 + ". Clique nas " + unidadesp2 + " bolinhas vermelhas que estão indicadas no ábaco, de baixo para cima");
                        for (i = 1; i <= unidadesp2; i++) {

                            var id = parseInt(i) + (u - 1);
                            $("#" + id).addClass("bordaAzul");

                        }
                    }



                    break;
                case 'subtração':
                
                    ativas = u - 1;
                    $("#" + ativas).removeAttr("disabled");
                    
                    
                    
                    if ((ativas < unidadesp2)) {
                        

                        for (i = 1; i <= ativas; i++) {

                            
                            $("#" + i).addClass("bordaAzul");

                        }
                        
                        
                        //se unidadesp1 for zero
                        if(u === 1){
                         instrucoes.text("Vamos diminuir a segunda parcela da primeira. Iniciemos pela sua casa das unidades, que é " + unidadesp2 + ". Perceba que não há bolinhas vermelhas para representar essa quantidade. Note que uma bolinha amarela subirá para que as dez vermelhas desçam.");   
                                $(".unidades > div").animate({top: '+=120px'}, 500);
                                d--;
                                $("#dezenas" + d).animate({top: '-=120px'}, 500);
                                trocouUnidades = true;
                                u = 11;
                                
                         setTimeout(function(){
                              trocarUnidades();
                         },3500);
                        }else{
                        instrucoes.text("Vamos diminuir a segunda parcela da primeira. Iniciemos pela sua casa das unidades, que é " + unidadesp2 + ". Perceba que não há bolinhas vermelhas suficientes para representar essa quantidade. Então primeiro vamos subir as " + ativas + " bolinhas abaixadas, de cima para baixo. Note que depois disso uma bolinha amarela subirá para que as dez vermelhas desçam.");
                }
                    } else {

                        instrucoes.text("Vamos diminuir a segunda parcela da primeira. Iniciemos pela sua casa das unidades, que é " + unidadesp2 + ". Clique nas " + unidadesp2 + " bolinhas vermelhas que serão indicadas no ábaco, de cima para baixo");
                        var limite = ativas - unidadesp2;
                        for (i = ativas; i > limite; i--) {

                            
                            $("#" + i).addClass("bordaAzul");

                        }
                    }
                    break;
            }
        } else {
            if(op==='adição'){
            instrucoes.text("Vamos somar a segunda parcela à primeira. Como a casa das unidades é 0, vamos direto pro próximo passo...");
            setTimeout(function(){
                iniciarDezenasp2();
            }, 3200);
        }else{
            instrucoes.text("Vamos diminuir a segunda parcela da primeira. Como a casa das unidades é 0, vamos direto pro próximo passo...");
            setTimeout(function(){
                iniciarDezenasp2();
            }, 3200);
        }
        }
    }

    function iniciarDezenasp2() {
        $(".unidades button").each(function () {
                       $(this).removeClass("bordaAzul");
                    });
                    
        if(op==='subtração' && dezenasp1 === 0 && trocouUnidades && a===false){
                        a = true;
                instrucoes.text("Perceba que a bolinha amarela nao pôde subir pois não havia nenhuma abaixada dessa casa. Então serão abaixadas as dez amarelas para que uma possa subir. Note que depois disso uma verde subirá em substituição às dez amarelas.");
                            d = 20;
                            var id = c - 1;
                            c --;
                            trocouDezenas = true;
                            faltaram = dezenasp2 + 1;
                            
                            setTimeout( function(){
                            $(".dezenas > div").animate({top: '+=120px'}, {duration: 500, easing:'swing', queue: true});
                            $("#" + id).parent().animate({top: '-=120px'}, {duration: 500,easing:'swing', queue: true});
                            $("#20").parent().animate({top: '-=120px'}, {duration: 500,easing:'swing', queue: true}); 
                             
                                iniciarDezenasp2();
                            }, 7000);
                             
                             return;
        }
        
        if (dezenasp2 !== 0) {
            switch (op) {
                case 'adição':
                    if(dezenasp1 === 0){
                        $("#11").removeAttr("disabled");
                    }
                 if (parseInt(d) + dezenasp2 > 21) {
                        restantes = 21 - d;
                        if(restantes === 0){
                            instrucoes.text("Agora, vamos para a casa das dezenas, que é " + dezenasp2 + ". Perceba que não há bolinhas amarelas para representar essa quantidade. Então vamos pro próximo passo. Note que uma bolinha verde descerá para que as dez amarelas subam.");
                            setTimeout(function(){
                                $(".dezenas > div").animate({top: '-=120px'}, 500);
                                $("#centenas" + c).animate({top: '+=120px'}, 500);
                                c++;
                                trocouDezenas = true;
                                d = 11;
                                trocarDezenas();
                            }, 5000);
                            return;
                        }
                        for (i = 1; i <= restantes; i++) {

                            var id = parseInt(i) + parseInt(d) - 1;
                            $("#" + id).addClass("bordaAzul");
                        }
                        instrucoes.text("Agora, vamos para a casa das dezenas, que é " + dezenasp2 + ". Perceba que não há bolinhas amarelas suficientes para representar essa quantidade. Então primeiro vamos abaixar as " + restantes + " bolinhas restantes, de baixo para cima. Note que depois disso uma bolinha verde descerá para que as dez amarelas subam.");

                    } else {
                        for (i = 1; i <= dezenasp2; i++) {

                            var id = parseInt(i) + parseInt(d) - 1;
                            $("#" + id).addClass("bordaAzul");
                        }
                        instrucoes.text("Agora, vamos para a casa das dezenas, que é " + dezenasp2 + ". Clique nas " + dezenasp2 + " bolinhas amarelas que serão indicadas no ábaco, de baixo para cima");
                    }


                    break;
                case 'subtração':
                    
        
                    ativas = d - 11;
                    var id = d - 1;
                    $("#" + id).removeAttr("disabled");
                   
                    if ((ativas < dezenasp2)) {
                        

                        for (i = 11; i <= parseInt(ativas) + 10; i++) {

                            
                            $("#" + i).addClass("bordaAzul");

                        }
                        if(d === 11){
                           instrucoes.text("Vamos agora para a casa das dezenas, que é " + dezenasp2 + ". Perceba que não há bolinhas amarelas para representar essa quantidade. Note que uma bolinha verde subirá para que as dez amarelas desçam.");;
                           $(".dezenas > div").animate({top: '+=120px'}, 500);
                           var id = c - 1;
                           $("#centenas" + id).animate({top: '-=120px'}, 500);
                            c--;
                            trocouDezenas = true;
                            d = 21;
                            setTimeout(function(){
                              trocarDezenas();
                            },3500);
                        }else{
                             instrucoes.text("Vamos agora para a casa das dezenas, que é " + dezenasp2 + ". Perceba que não há bolinhas amarelas suficientes para representar essa quantidade. Então primeiro vamos subir as " + ativas + " bolinhas abaixadas, de cima para baixo. Perceba que depois disso uma bolinha verde subirá para que as dez amarelas desçam.");
                        
                        }
                    } else {

                        instrucoes.text("Vamos agora para a casa das dezenas, que é " + dezenasp2 + ". Clique nas " + dezenasp2 + " bolinhas amarelas que serão indicadas no ábaco, de cima para baixo");
                        var limite = ativas - dezenasp2;
                        
                        for (i = ativas; i > limite; i--) {
                            var id = i + 10;
                            $("#" + id).addClass("bordaAzul");

                        }
                    }
                    break;
            }

        } else {
            if(d===21){
                $(".dezenas > div").animate({top: '-=120px'}, 500);
                    $("#centenas" + c).animate({top: '+=120px'}, 500);
                     c++;
                     trocouDezenas = true;
                     $("#" + c).removeAttr("disabled");
             
            }
            instrucoes.text("Como a casa das dezenas é 0, vamos direto pro próximo passo...");
            setTimeout(function(){
                iniciarCentenasp2();
            }, 3200);
        }
    }

    function iniciarCentenasp2() {
        $(".dezenas button").each(function () {
                        $(this).removeClass("bordaAzul");
                    });
        if (centenasp2 !== 0) {
            switch (op) {
                case 'adição':
                    if(centenasp1 === 0){
                        $("#21").removeAttr("disabled");
                    }
                    instrucoes.text("Finalmente, vamos para a casa das centenas, que é " + centenasp2 + ". Clique nas " + centenasp2 + " bolinhas verdes que estão indicadas no ábaco, de baixo para cima");
                     for (i = 1; i <= centenasp2; i++) {

                        var id = parseInt(i) + parseInt(c) - 1;

                        $("#" + id).addClass("bordaAzul");
                    }

                    break;
                case 'subtração':
                   ativas = c - 20; 
                   var id = c - 1; 
                    $("#" + id).removeAttr("disabled");
                    
                        instrucoes.text("Finalmente, vamos para a casa das centenas, que é " + centenasp2 + ". Clique nas " + centenasp2 + " bolinhas verdes que estão indicadas no ábaco, de cima para baixo");
                        var limite = ativas - centenasp2; 
                        for (i = ativas; i > limite; i--) {
                            var id = parseInt(i) + 19;
                            
                            $("#" + id).addClass("bordaAzul");

                        }
                   
                    break;
            }

        } else {
            instrucoes.text("Como a parcela não possui a casa das centenas, vamos direto pro próximo passo...");
            setTimeout(function(){
                terminarAbaco();
            }, 2600);
        }
    }


    function iniciarAbaco() {
        unidadesp1 = parseInt(p1) % 10;
        dezenasp1 = parseInt((p1 / 10)) % 10;
        centenasp1 = parseInt((p1 / 100)) % 10;
        unidadesp2 = parseInt(p2) % 10;
        dezenasp2 = parseInt((p2 / 10)) % 10;
        centenasp2 = parseInt((p2 / 100)) % 10;
        
        
        $(".calcular, .btnAadicao, .btnSubtracao").attr("disabled", "disabled");
        $(".unidades button, .dezenas button, .centenas button").each(function () {
            $(this).attr("disabled", "disabled");
        });
        $("#1").removeAttr("disabled");

        if (unidadesp1 === 0) {
            instrucoes.text("Vamos representar a primeira parcela no ábaco. Como a casa das unidades é 0, vamos direto pro próximo passo...");
            setTimeout(function(){
                iniciarDezenasp1();
            }, 3200);
        }else{
        
        instrucoes.text("Vamos representar a primeira parcela no ábaco. Iniciemos pela sua casa das unidades, que é " + unidadesp1 + ". Clique nas " + unidadesp1 + " bolinhas vermelhas que estão indicadas no ábaco, de baixo para cima");

        for (i = 1; i <= unidadesp1; i++) {


            $("#" + i).addClass("bordaAzul");

        }

        }
    }


    //clica em calcular
    $(".calcular").click(function () {
        p1 = parseInt($('#parcela1').val());
        p2 = parseInt($('#parcela2').val());
        u = 1;
        d = 11;
        c = 21;
        a = false;
        trocouUnidades = false;
        trocouDezenas = false;
        executandop2 = false;
        msgConta.text("");
        txtResultado.text("");
        
        
        $(".abaco button").each(function(){
            if($(this).hasClass("bordaAzul")){
                $(this).removeClass("bordaAzul");
                $(this).parent().animate({top: '-=120px'}, 200);
            }
        });

        if ($("#parcela1").val() === "" || $("#parcela2").val() === "") {
            msgConta.text("Insira as duas parcelas.").css("color", "white");
            return;
        }
        if ($(".btnAdicao").hasClass("bordaAzul")) {
            op = "adição";
            soma = p1 + p2;
            if (soma >= 0 && soma <= 999 && p1 >= 0 & p2 >= 0) {
                   iniciarAbaco();
            } else {
                msgConta.text("Insira parcelas positivas cuja soma seja de, no máximo, três algarismos.").css("color", "white");
                return;
            }
        } else if ($(".btnSubtracao").hasClass("bordaAzul")) {
            op = "subtração";
            diferenca = p1 - p2;

            if (p2 <= p1 && diferenca < 999 && p1 >= 0 && p2 >= 0 ) {
                iniciarAbaco();
            } else {
                msgConta.text("Insira parcelas positivas de, no máximo, três algarismos, tais que a primeira seja maior que a segunda").css("color", "white");
                return;
            }
        }
    });
    
    /*clicou em unidades*/
    $(".unidades").click(function () {
        if(op === "subtração" && executandop2){
            var id = parseInt(u) - 1;
            $("#" + id).attr("disabled", "disabled");
            $("#unidades" + id).animate({top: '-=120px'}, 500);
            id--;
            $("#" + id).removeAttr("disabled");
            
            u--; 
         
        if (u === 1 && unidadesp2 > unidadesp1 && executandop2) {
            $(".unidades > div").animate({top: '+=120px'}, 500);
            d--;
            $("#dezenas" + d).animate({top: '-=120px'}, 500);
            trocouUnidades = true;
            u = 11;
            trocarUnidades();
            return;
        }
            
        if (u === (unidadesp1 - unidadesp2 + 1)) {
            iniciarDezenasp2();
            return;
        }  
        
        if (u === 10 - parseInt(faltaram) + 1 && trocouUnidades) {
            var id = d - 1;
            $("#" + id).removeAttr("disabled");
            iniciarDezenasp2();
            return;
        }
            
        }else{
        $("#" + u).attr("disabled", "disabled");
        var id = parseInt(u) + 1;
        $("#" + id).removeAttr("disabled");
        $("#unidades" + u).animate({top: '+=120px'}, 500);
        u++;
    

        if (u === 11) {
            $(".unidades > div").animate({top: '-=120px'}, 500);
            $("#dezenas" + d).animate({top: '+=120px'}, 500);
            d++;
            trocouUnidades = true;
            u = 1;
            if (unidadesp1 + unidadesp2 !== 10){
            trocarUnidades();
             }else{
                 $("#" + d).removeAttr("disabled");
                    iniciarDezenasp2();
             }
            return;
        }

        if (u > (unidadesp1 + unidadesp2) && executandop2) {
            iniciarDezenasp2();
            return;
        }

        if (u > faltaram && trocouUnidades) {
            $("#" + d).removeAttr("disabled");
            iniciarDezenasp2();
            return;
        }

        if (u > unidadesp1 && !executandop2) {
            iniciarDezenasp1();
            return;
        }
        }
    });
    
    //clica em dezenas
    $(".dezenas").click(function () {
        if(op === "subtração" && executandop2){
            var id = parseInt(d) - 1;
            $("#" + id).attr("disabled", "disabled");
            $("#dezenas" + id).animate({top: '-=120px'}, 500);
            id--;
            $("#" + id).removeAttr("disabled");
            
            d--; 
            
        if (d === 11 & dezenasp2 > dezenasp1 && executandop2) {
            $(".dezenas > div").animate({top: '+=120px'}, 500);
            var id = c - 1;
            $("#centenas" + id).animate({top: '-=120px'}, 500);
            c--;
            trocouDezenas = true;
            d = 21;
            trocarDezenas();
            return;
        }

            
        if (trocouUnidades) {
            if (d === dezenasp1 - dezenasp2 + 10 && executandop2) {
                iniciarCentenasp2();
                return;
            }
        } else {
            if (d === dezenasp1 - dezenasp2 + 11 && executandop2) {
                iniciarCentenasp2();
                return;
            }
        } 
        
        if (d === 21 - parseInt(faltaram) && trocouDezenas) {
            var id = c - 1;
            $("#" + id).removeAttr("disabled");
            iniciarCentenasp2();
            return;
        }
            
        }else{
        $("#" + d).attr("disabled", "disabled");
        var id = parseInt(d) + 1;
        $("#" + id).removeAttr("disabled");
        $('#dezenas' + d).animate({top: '+=120px'}, 500);
        d++;
        if (d === 21) {
            $(".dezenas > div").animate({top: '-=120px'}, 500);
            $("#centenas" + c).animate({top: '+=120px'}, 500);
            c++;
            trocouDezenas = true;
            d = 11;
            if (!(trocouUnidades && dezenasp1 + dezenasp2 === 9) || (dezenasp1 + dezenasp2 === 10)){
                trocarDezenas();
             }else{
                $("#" + c).removeAttr("disabled");
                iniciarCentenasp2(); 
             }
            return;
        }
        
       
        if (trocouUnidades) {
            if (d > dezenasp1 + dezenasp2 + 11 && executandop2) {
              iniciarCentenasp2();
                return;
            }
        } else {
            if (d > dezenasp1 + dezenasp2 + 10 && executandop2) {
              iniciarCentenasp2();
                return;
            }
        }

        if ((parseInt(d)-10) > faltaram && trocouDezenas) {
            $("#" + c).removeAttr("disabled");
            iniciarCentenasp2();
            return;
        }

        if ((parseInt(d) - 10) > dezenasp1 && !executandop2) {
            iniciarCentenasp1();
            return;
        }
    }
    });

    $(".centenas").click(function () {
        if(op === "subtração" && executandop2){
            var id = parseInt(c) - 1;
            $("#" + id).attr("disabled", "disabled");
            $("#centenas" + id).animate({top: '-=120px'}, 500);
            id--;
            $("#" + id).removeAttr("disabled");
            
            c--; 
            
        if (trocouDezenas) {
            if (c === (centenasp1 - centenasp2 + 20) && executandop2) {
                terminarAbaco();
                return;
            }
        } else {
            if (c === (centenasp1 - centenasp2 + 21) && executandop2) {
                terminarAbaco();
                return;
            }
        }   
        
        if (d === 10 - parseInt(faltaram) + 21 && trocouDezenas) {
            terminarAbaco();
            return;
        }
            
        }else{
        $("#" + c).attr("disabled", "disabled");
        var id = parseInt(c) + 1;
        $("#" + id).removeAttr("disabled");
        $('#centenas' + c).animate({top: '+=120px'}, 500);
        c++;

        if (trocouDezenas) {
            if (c > (centenasp1 + centenasp2 + 21) && executandop2) {
                terminarAbaco();
                return;
            }
        } else {
            if (c > (centenasp1 + centenasp2 + 20) && executandop2) {
                terminarAbaco();
                return;
            }
        }

        if ((parseInt(c) - 20) > centenasp1 && !executandop2) {
            iniciarUnidadesp2();
            return;
        }
    }
    });

    $(".btnAdicao").click(function () {
        op = 'adição';
        $(".btnSubtracao").removeClass("bordaAzul");
        $(this).addClass("bordaAzul");

    });

    $(".btnSubtracao").click(function () {
        op = 'subtração';
        $(".btnAdicao").removeClass("bordaAzul");
        $(this).addClass("bordaAzul");

    });
    
    $(".conta .apagarCampos").click(function(){
        $("#parcela1, #parcela2").val("");
    });

   
});
