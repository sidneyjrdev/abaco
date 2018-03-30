<?php 
$res = "";
if (filter_input(INPUT_POST, "btnRepBug", FILTER_SANITIZE_STRING)) {
    
       $nome = filter_input(INPUT_POST, "txtNomeRepBug", FILTER_SANITIZE_STRING);
       $email = filter_input(INPUT_POST, "txtEmailRepBug", FILTER_SANITIZE_STRING); 
       $titulo = filter_input(INPUT_POST, "txtTituloBug", FILTER_SANITIZE_STRING); 
       $descricao = filter_input(INPUT_POST, "txtDescBug", FILTER_SANITIZE_STRING); 
        
       $subject = "Bug reportado no Portal do Ábaco - " . $titulo;
       $from = "contato@portaldoabaco.dx.am";
       $descricao = $descricao . ". \nE-mail do usuário: " . $email;
       $headers = "De:". $from;
 
$enviou = mail("sidneyjrdev@gmail.com", $subject, $descricao, $headers);
if($enviou){
    $res = "Mensagem enviada com sucesso!";
}else{
    $res = "Erro ao enviar mensagem.";
}
    }
?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1 class="tituloCad">Reportar bug</h1>
        <p>Se você percebeu algum mau funcionamento do ábaco, da multiplicação ou do quiz, conte-nos, preenchendo todos os campos do formulário abaixo. Descreva o bug o mais detalhadamente possível.</p>
        <p class="resultado"><b><?= $res ?></b></p>
        <form name="frmRepBug" method="post" id="frmRepBug" class="frmCadUsu" >

            <div class="form-group">
                <label for="txtNomeRepBug">Seu nome:</label>
                <input type="text" class="form-control" name="txtNomeRepBug" id="txtNomeRepBug" minlength="3" required="required" title="Preencha o campo, e com pelo menos 3 caracteres"/>
            </div>

            <div class="form-group">
                <label for="txtEmailRepBug">Seu e-mail:</label>
                <input type="email" class="form-control" name="txtEmailRepBug" id="txtEmailRepBug" />
            </div> 
            
            <div class="form-group">
                <label for="txtTituloBug">Título do bug:</label>
                <input type="text" class="form-control" name="txtTituloBug" id="txtTituloBug" minlength="7" required="required" title="Preencha o campo, e com pelo menos 7 caracteres"/>
            </div>
            
            <div class="form-group">
                <label for="txtDescBug">Descrição do bug:</label>
                <textarea class="form-control" name="txtDescBug" id="txtDescBug" minlength="15" required="required" title="Preencha o campo, e com pelo menos 15 caracteres"></textarea>
            </div>

            <input type="submit" name="btnRepBug" class="btn btn-success btnRepBug" value="Enviar"/>
        </form>
    </div>
</div>

