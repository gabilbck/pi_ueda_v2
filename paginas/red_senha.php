<?php require("../template/header.php");?>
<?php
    // FAZER PHP E CONFIGURAÇÃO!!!
    $email_usu = "";
    $email_usuErr = $msgErr = "";

    if(isset($_GET['email_usuErr'])){
        $email_usuErr = $_GET['email_usuErr'];
    }
?>
<head>
    <title>Esqueci Minha Senha</title>
</head>
    <main>
    <div class="margem-lados">
        <!-- 
<center>
                <br><br>
                <h1>RECUPERAR SENHA</h1>
                <br>
                <form action="red_senha_controler.php" method="post">
                    <input name="email_usu" maxlength="255" value="<?php echo $email_usu?>" type="email" placeholder="E-mail">
                    <span class="obrigatorio"><?php echo $email_usuErr ?></span>
                    <br><br>
                    <button type="submit" name="submit">ENVIAR CÓDIGO DE VERIFICAÇÃO</button>
                    <br><br>  
                    <div class="final-cad">
                        <div class="final-cad-1">
                            <a href="cad_usu.php">Cadastre-se</a>
                        </div>
                        <div class="final-cad-2">
                            <a href="login_usu.php">Entrar</a>
                        </div>
                    </div>
                    <br><br>
                </form>
                <br><br>
            </center>
         -->
         <center>
            <br><br>
            <h1>RECUPERAR SENHA</h1>
            <br>
            <h2>Implementação futura...</h2>
            <br><br>
        </center>
        </div>
    </main>
<?php require("../template/footer.php");?>