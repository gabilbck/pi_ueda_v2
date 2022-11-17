<?php require("../template/header.php");?>
<?php
    $email_bug = $desc_bug = $cod_bug =  "";
    $email_bugErr = $desc_bugErr = $msgErr = "";
    
    if(isset($_GET['email_bugErr'])){
        $email_bugErr = $_GET['email_bugErr'];
    }
    if(isset($_GET['desc_bugErr'])){
        $desc_bugErr = $_GET['desc_bugErr'];
    }
?>
<head>
    <title>Reportar Erros | UEDA</title>
</head>
    <main>
        <div class="margem-lados">
        <br><br>
        <center>
            <h1>REPORTAR ERRO</h1>
        <br>
            <form method="post" action="bug_usu_controler.php">
                <h2>Encontrou algum erro?</h2>
                <h4>Reporte preenchendo às informações abaixo:</h4>
                <br>
                <input name="email_bug" maxlength="255" type="email" placeholder="E-mail">
                <span class="obrigatorio"><?php echo '<br>'.$email_bugErr ?></span>
                <br><br>
                <textarea name="desc_bug" maxlength="500" placeholder="Descreva o erro aqui"></textarea> 
                <span class="obrigatorio"><?php echo '<br>'.$desc_bugErr ?></span>
                <br><br>
                <button type="submit" name="submit">REPORTAR</button>
            </form>
        </div>
        </center>
        <br><br>
    </main>
<?php require("../template/footer.php");?>