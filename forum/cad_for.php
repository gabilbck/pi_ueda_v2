<?php
    session_start();
    include "../include/MySql.php";
    include "../include/functions.php";

    $text_publi = $img_usu = "";
    $text_publiErr = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
        if (empty ($_POST['text_publi'])){
            $text_publiErr = "Texto para pblicação é obrigatória!";
        } else {
            $text_publi = test_input($_POST["text_publi"]);
        }

        if ($nome_usu && $email_usu && $senha_usu && $nome_real_usu){
            $sql = $pdo->prepare("SELECT * FROM usuario WHERE email_usu = ?");
            if ($sql->execute(array($email_usu))){
                if ($sql->rowCount() > 0){
                    $msgErr = "E-mail já cadastrado";
                } else {
                    //Inserir dados
                    $sql = $pdo->prepare("INSERT INTO USUARIO (id_usu, nome_usu, email_usu, senha_usu, nome_real_usu, adm)
                                        VALUES (null, ?, ?, ?, ?, 0)");
                    if ($sql->execute(array($nome_usu, $email_usu, MD5($senha_usu), $nome_real_usu))){
                        $msgErr = "Dados cadastrados com sucesso!";
                        header("location: ../index.php");
                    } else {
                        $msgErr = "Dados não cadastrados!";
                    }
                }   
            } else{
                $msgErr = "Erro no comando Select";
            }     
        } else {
            $msgErr = "Dados não informados!"; 
        }
    }
?>
<head>
    <title>Cadastre Forum| UEDA</title>
</head>
<?php require("../template/header2.php");?>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>PUBLICAR FORUM</h1>
                <br>
                <form action="" method="post">
                    <input name="text_publi" value="<?php echo $text_publi?>" type="text" placeholder="Texto para publicação">
                    <span class="obrigatorio">* <?php  echo '<br>'.$text_publiErr ?></span>
                    <br><br>
                    
                    <div class="final-cad">
                        <div class="final-cad-1">
                            <a href="login.php">Entrar</a>
                        </div>
                        <div class="final-cad-2">
                            <a href="esqueci_senha.php">Esqueci minha senha</a>
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
<?php require("../template/footer2.php");?>