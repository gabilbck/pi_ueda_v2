<?php 
    include "../../include/MySql.php";
    include "../../include/functions.php";
    session_start();

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
        if (empty($_POST['senha_usu'])){
            $senha_usuErr = "Senha é obrigatório!";
        } else {
            $senha_usu = test_input($_POST["senha_usu"]);
        }
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
        if ($email_usu && $senha_usu && $nome_usu && $nome_real_usu){
            $sql = $pdo->prepare("SELECT * FROM USUARIO WHERE email_usu = ? AND id_usu <> ?");
            if ($sql->execute(array($email_usu, $id_usu))){
                if ($sql->rowCount() > 0){
                    $msgErr = "E-mail já cadastrado para outro usuário";
                } else {
                    $sql = $pdo->prepare("UPDATE usuario SET nome_usu=?, email_usu=?, senha_usu=?, nome_real_usu=?, adm=? WHERE id_usu=?");
                    if ($sql->execute(array($nome_usu, $email_usu, MD5($senha_usu), $nome_real_usu, $adm, $id_usu))){
                        $msgErr = "Dados alterados com sucesso!";
                        header('location: ../lista_usu.php');
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
<?php require("../../template/header3.php");?>
    <main>
    <div class="margem-lados">
            <center>
                <br><br>
                <h1>CADASTRE-SE</h1>
                <br>
                <form action="" method="post">
                    <input type="text" name="id_usu" value="<?php echo $id_usu?>" readonly>
                    <span class="obrigatorio" hidden>*</span>
                    <br><br>
                    <input name="nome_real_usu" value="<?php echo $nome_real_usu?>" type="text" placeholder="Nome Completo">
                    <span class="obrigatorio">* <?php  echo '<br>'.$nome_real_usuErr ?></span>
                    <br><br>
                    <input name="nome_usu" value="<?php echo $nome_usu?>" type="text" placeholder="Nome de Usuário">
                    <span class="obrigatorio">* <?php  echo '<br>'.$nome_usuErr ?></span>
                    <br><br>
                    <input name="email_usu" value="<?php echo $email_usu?>" type="email" placeholder="E-mail">
                    <span class="obrigatorio">* <?php  echo '<br>'.$email_usuErr ?></span>
                    <br><br>
                    <input class="adm-c" type="checkbox" name="adm" <?php if ($adm==1){?> checked="checked"<?php } ?>/> ADM
                    <br><br>
                    <button type="submit" name="cadastro">ALTERAR</button>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../../template/footer3.php");?>