<?php require("../template/header.php");?>
<?php  
    $_SESSION['id_usu'] = "";
    $_SESSION['nome_usu'] = "";
    $_SESSION['adm'] = "";
    
    $email_usu = $senha_usu = $msgErr = "";
    $email_usuErr = $senha_usuErr = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (empty($_POST['email_usu'])){
            $email_usuErr = "Email está incorreto.";
        } else {
            $email_usu = test_input($_POST["email_usu"]);
        }
        if (empty($_POST['senha_usu'])){
            $senha_usuErr = "Senha está incorreta.!";
        } else {
            $senha_usu = test_input($_POST["senha_usu"]);
        }

        if ($email_usu && $senha_usu){
            //código para consultar os dados no banco de dados
            $sql = $pdo->prepare("SELECT * FROM usuario WHERE email_usu = ? AND senha_usu = ?");
            if ($sql->execute(array($email_usu, MD5($senha_usu)))){
                $info = $sql->fetchAll(PDO::FETCH_ASSOC);
                
                if (count($info) > 0){
                    foreach($info as $key => $values){
                        $_SESSION['id_usu'] = $values['id_usu'];
                        $_SESSION['nome_usu'] = $values['nome_usu'];
                        $_SESSION['adm'] = $values['adm'];
                    }
                    header('location:sus_log_usu.php');
                } else {
                    $msgErr = 'Credenciais incorretas ou não informadas.';
                }
            }
        }
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
                <form action="" method="post">
                    <input name="email_usu" value="<?php echo $email_usu?>" type="email" placeholder="E-mail">
                    <br><br>
                    <input name="senha_usu" value="<?php echo $senha_usu?>" type="password" placeholder="Senha">
                    <br><br>
                    <span class="obrigatorio"><?php echo "* ".$msgErr ?></span>
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