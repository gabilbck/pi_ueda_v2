<?php require("../template/header.php");?>
<?php
    //Quando vazio, não funciona bem, mas altera se estiver tudo preenchido

    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    } else {
        $nome_usu = $email_usu = $senha_usu = $nome_real_usu = $adm = "";
        $nome_usuErr = $email_usuErr = $senha_usuErr = $nome_real_usuErr = $admErr = $msgErr = "";

        if (isset($_GET['id_usu'])){
            $id_usu = $_GET['id_usu'];
            $sql = $pdo->prepare('SELECT * FROM usuario WHERE id_usu =?');
            if ($sql->execute(array($id_usu))){
                $info = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($info as $key => $value){
                    $id_usu = $value['id_usu'];
                    $nome_usu = $value['nome_usu'];
                    $email_usu = $value['email_usu'];
                    $senha_usu = "";//$value['senha_usu'];
                    $nome_real_usu = $value['nome_real_usu'];
                    $adm = $value['adm'];
                }
            }
        }
        //Erros
        if(isset($_GET['nome_usuErr'])){
            $nome_usuErr = $_GET['nome_usuErr'];
            $nome_usu = "";
        }
        if(isset($_GET['email_usuErr'])){
            $email_usuErr = $_GET['email_usuErr'];
            $email_usu = "";
        }
        if(isset($_GET['nome_real_usuErr'])){
            $nome_real_usuErr = $_GET['nome_real_usuErr'];
            $nome_real_usu = "";
        }
    }             
?>
<head>
    <title>Alterar Informações do Usuário</title>
</head>
    <main>
    <div class="atencao">
        <center><h4>ATENÇÃO: Se você deixar algum input vazio e clicar em 'ALTERAR', o dado permanecerá como antes de ser enviado vazio.</h4></center>
    </div>
    <br><br>
    <div class="margem-lados">
            <center>
                <br><br>
                <h1>ALTERAR USUÁRIO</h1>
                <br>
                <form action="adm_alt_usu_controler.php" method="post">
                    <input type="text" name="id_usu" value="<?php echo $id_usu?>" readonly>
                    <span class="obrigatorio"></span>
                    <br><br>
                    <input name="nome_real_usu" maxlength="200" value="<?php echo $nome_real_usu?>" type="text" placeholder="Nome Completo">
                    <span class="obrigatorio"><?php echo '<br>'.$nome_real_usuErr ?></span>
                    <br>
                    <input name="nome_usu" maxlength="20" value="<?php echo $nome_usu?>" type="text" placeholder="Nome de Usuário">
                    <span class="obrigatorio"><?php echo '<br>'.$nome_usuErr ?></span>
                    <br>
                    <input name="email_usu" maxlength="255" value="<?php echo $email_usu?>" type="email" placeholder="E-mail">
                    <span class="obrigatorio"><?php echo '<br>'.$email_usuErr ?></span>
                    <br>
                    <input name="senha_usu" maxlength="40" type="password" placeholder="Senha">
                    <span class="obrigatorio"><?php echo '<br>'.$senha_usuErr ?></span>
                    <br><br>
                    <table>
                        <tr>
                            <td><input class="adm-c" type="checkbox" name="adm" <?php if ($adm==1){?> checked="checked"<?php } ?>/></td>
                            <td>ADM</td>
                        </tr>
                    </table>
                    <br><br>
                    <div class="botoes-alt">
                        <button><a class="link-branco" href="adm_lista_usu.php">VOLTAR</a></button>
                        <button type="submit" name="cadastro">ALTERAR</button>
                    </div>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer.php");?>