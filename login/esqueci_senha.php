<?php
    session_start();
    include "../include/MySql.php";
    include "../include/functions.php";
?>
<head>
    <title>Esqueci Minha Senha</title>
</head>
<?php require("../template/header_login.php");?>
    <main>
    <div class="margem-lados">
            <center>
                <br><br>
                <h1>RECUPERAR SENHA</h1>
                <br>
                <form action="" method="post">
                    <input name="email_usu" value="<?php echo $email_usu?>" type="email" placeholder="E-mail">
                    <span class="obrigatorio">* <?php echo $email_usuErr ?></span>
                    <br><br>
                    <input name="senha_usu" value="<?php echo $senha_usu?>" type="password" placeholder="Nova Senha">
                    <span class="obrigatorio">* <?php echo $email_usuErr ?></span>
                    <br><br>
                    <div class="final-cad">
                        <div class="final-cad-1">
                            <a href="cadastro.php">Cadastre-se</a>
                        </div>
                        <div class="final-cad-2">
                            <a href="login.php">Entrar</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <br>
                    <button type="submit" name="submit">ENVIAR CÓDIGO DE VERIFICAÇÃO</button>
                    <br>   
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer2.php");?>