<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<?php 
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

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
        if (isset($_POST['id_usu'])){
            $id_usu = $_POST['id_usu'];
        } 
        if (empty($_POST['nome_usu'])){
            $nome_usuErr = "Nome é obrigatório!";
        } else {
            $nome_usu = test_input($_POST["nome_usu"]);
        }
        if (empty($_POST['email_usu'])){
            $email_usuErr = "Email é obrigatório!";
        } else {
            $email_usu = test_input($_POST["email_usu"]);
        }
        $senha_usu = test_input($_POST["senha_usu"]);
        if (empty($_POST['nome_real_usu'])){
            $nome_real_usuErr = "Telefone é obrigatório!";
        } else {
            $nome_real_usu = test_input($_POST["nome_real_usu"]);
        }
        if (empty($_POST['adm'])){
            $adm = false;
        } else {
            $adm = true;
        }

        //Verificar se existe um usuario
        if ($email_usu && $nome_usu && $nome_real_usu){
            $sql = $pdo->prepare("SELECT * FROM usuario WHERE email_usu = ? AND id_usu <> ?");
            if ($sql->execute(array($email_usu, $id_usu))){
                if ($sql->rowCount() > 0){
                    $msgErr = "E-mail já cadastrado para outro usuário";
                } else {
                    $sql = $pdo->prepare("UPDATE usuario SET nome_usu=?, email_usu=?, nome_real_usu=?, adm=? WHERE id_usu=?");
                    if ($sql->execute(array($nome_usu, $email_usu, $nome_real_usu, $adm, $id_usu))){
                        if(!empty($senha_usu)){
                            $sql = $pdo->prepare("UPDATE usuario SET senha_usu=? WHERE id_usu=?");
                            $sql->execute(array(md5($senha_usu), $id_usu));
                        }
                        $msgErr = "Dados alterados com sucesso!";
                        header('location: adm_lista_usu.php');
                    } else{
                        $msgErr = "dados não alterados.";
                    }
                }
            }

        } else {
            $msgErr = "Dados não informados!"; 
        }
    }                    
?>
<head>
    <title>Alterar Informações do Usuário</title>
</head>
    <main>
    <div class="margem-lados">
            <center>
                <br><br>
                <h1>ALTERAR USUÁRIO</h1>
                <br>
                <form action="" method="post">
                    <input type="text" name="id_usu" value="<?php echo $id_usu?>" readonly>
                    <span class="n-obrigatorio">*</span>
                    <br><br>
                    <input name="nome_real_usu" maxlength="200" value="<?php echo $nome_real_usu?>" type="text" placeholder="Nome Completo">
                    <span class="obrigatorio"><?php  echo '<br>'.$nome_real_usuErr ?></span>
                    <br>
                    <input name="nome_usu" maxlength="20" value="<?php echo $nome_usu?>" type="text" placeholder="Nome de Usuário">
                    <span class="obrigatorio"><?php  echo '<br>'.$nome_usuErr ?></span>
                    <br>
                    <input name="email_usu" maxlength="255" value="<?php echo $email_usu?>" type="email" placeholder="E-mail">
                    <span class="obrigatorio"><?php  echo '<br>'.$email_usuErr ?></span>
                    <br>
                    <input name="senha_usu" maxlength="40" type="password" placeholder="Senha">
                    <span class="obrigatorio"><?php  echo '<br>'.$senha_usuErr ?></span>
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