<?php
    session_start();
    include "../include/MySql.php";
    include "../include/functions.php";
    
    $email_bug = $desc_bug = $cod_bug =  "";
    $email_bugErr = $desc_bugErr = $msgErr = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
        if (empty($_POST['email_bug'])){
            $email_bugErr = "Email é obrigatório!";
        } else {
            $email_bug = test_input($_POST["email_bug"]);
        }
        if (empty($_POST['desc_bug'])){
            $desc_bugErr = "Ter uma descrição é obrigatório!";
        } else {
            $desc_bug = test_input($_POST["desc_bug"]);
        }

        //Verificar se o usuário existe
        if ($email_bug && $desc_bug) {
                    //Inserir no banco de dados
            $sql = $pdo->prepare("INSERT INTO bug (cod_bug, email_bug, desc_bug)
                                VALUES (null, ?, ?)");
            if ($sql->execute(array($email_bug, $desc_bug))){
                $msgErr = "Erro reportado com sucesso!";  
                header('location:home.php');
            } else {
                $msgErr = "Erro não reportado!";
            }
        }else {
            $msgErr = "Erro no comando Select";
        }
    } else{
        echo $msgErr;
    }
 
    
?>
<head>
    <title>Reportar Erros | UEDA</title>
</head>
<?php require("../template/header.php");?>
    <main>
        <div class="margem-lados">
        <br><br>
        <center>
            <h1>REPORTAR ERRO</h1>
        <br>
            <form method="post" action="">
                <h2>Encontrou algum erro?</h2>
                <h4>Preencha seu E-mail e reporte preenchendo às informações abaixo:</h4>
                <br>
                <input name="email_bug" type="email" placeholder="E-mail">
                <span class="obrigatorio">* <?php echo '<br>'.$email_bugErr ?></span>
                <br><br>
                <textarea name="desc_bug" placeholder="Descreva o erro aqui"></textarea> 
                <span class="obrigatorio">* <?php echo '<br>'.$desc_bugErr ?></span>
                <br><br>
                <button type="submit" name="submit">REPORTAR</button>
            </form>
        </div>
        </center>
        <br><br>
    </main>
<?php require("../template/footer.php");?>