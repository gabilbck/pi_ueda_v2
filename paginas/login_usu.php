<?php require("../template/header.php");?>
<?php  
    $_SESSION['id_usu'] = "";
    $_SESSION['nome_usu'] = "";
    $_SESSION['adm'] = "";
    
    $email_usu = $senha_usu = $msgErr = "";
    $email_usuErr = $senha_usuErr = "";
    if(isset($_GET['msgErr'])){
        $msgErr = $_GET['msgErr'];
    }
?>
<head>
    <title>Login | UEDA</title>
</head>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>LOGIN</h1>
                <br>
                <form action="login_usu_controler.php" method="post">
                    <input name="email_usu" value="<?php echo $email_usu?>" type="email" placeholder="E-mail">
                    <br><br>
                    <input name="senha_usu" value="<?php echo $senha_usu?>" type="password" placeholder="Senha">
                    <br>
                    <span class="obrigatorio"><?php echo $msgErr ?></span>
                    <br><br>
                    <div class="final-cad">
                        <div class="final-cad-1">
                            <a href="cad_usu.php">Cadastre-se</a>
                        </div>
                        <div class="final-cad-2">
                            <a href="red_senha.php">Esqueci minha senha</a>
                        </div>
                    </div>
                    <div class="clear"></div> 
                    <br>
                    <button type="submit" name="submit">ENTRAR</button>
                    <br>   
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer.php");?>