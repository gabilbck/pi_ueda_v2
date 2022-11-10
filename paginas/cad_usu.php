<?php require("../template/header.php");?>
<?php
    $nome_usu = $email_usu = $senha_usu = $nome_real_usu = $adm = "";
    $nome_usuErr = $email_usuErr = $senha_usuErr = $nome_real_usuErr = $admErr = $msgErr = "";

    if(isset($_GET['nome_usuErr'])){
        $nome_usuErr = $_GET['nome_usuErr'];
    }
    if(isset($_GET['email_usuErr'])){
        $email_usuErr = $_GET['email_usuErr'];
    }
    if(isset($_GET['senha_usuErr'])){
        $senha_usuErr = $_GET['senha_usuErr'];
    }
    if(isset($_GET['nome_real_usuErr'])){
        $nome_real_usuErr = $_GET['nome_real_usuErr'];
    }
?>
<head>
    <title>Cadastre-se | UEDA</title>
</head>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>CADASTRE-SE</h1>
                <br>
                <form action="cad_usu_controler.php" method="post">
                    <input name="nome_real_usu" maxlength="200" value="<?php echo $nome_real_usu?>" type="text" placeholder="Nome Completo">
                    <span class="obrigatorio"><?php  echo '<br>'.$nome_real_usuErr ?></span>
                    <br><br>
                    <input name="nome_usu" maxlength="20" value="<?php  echo $nome_usu?>" type="text" placeholder="Nome de Usuário">
                    <span class="obrigatorio"><?php  echo '<br>'.$nome_usuErr ?></span>
                    <br><br>
                    <input name="email_usu" maxlength="255" value="<?php  echo $email_usu?>" type="email" placeholder="E-mail">
                    <span class="obrigatorio"><?php  echo '<br>'.$email_usuErr ?></span>
                    <br><br>
                    <input name="senha_usu" maxlength="40" value="<?php  echo $senha_usu?>" type="password" placeholder="Senha">
                    <span class="obrigatorio"><?php  echo '<br>'.$senha_usuErr ?></span>
                    <br><br>
                    <div class="final-cad">
                        <div class="final-cad-1">
                            <a href="login_usu.php">Entrar</a>
                        </div>
                        <div class="final-cad-2">
                            <a href="red_senha.php">Esqueci minha senha</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <br>
                    <button type="submit" name="cadastro">CADASTRAR-SE</button>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer.php");?>