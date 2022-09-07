<?php
    include "../include/MySql.php";
    include "../include/functions.php";
    
    session_start();
    $_SESSION['nome_usu'] = "";
    $_SESSION['adm'] = "";

    $email_usu = $senha_usu = "";
    $email_usuErr = $senha_usuErr = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (empty($_POST['email_usu'])){
            $email_usuErr = "Email é obrigatório!";
        } else {
            $email_usu = test_input($_POST["email_usu"]);
        }

        if (empty($_POST['senha_usu'])){
            $senha_usuErr = "Senha é obrigatória!";
        } else {
            $senha_usu = test_input($_POST["senha_usu"]);
        }

        //código para consultar os dados no banco de dados
        $sql = $pdo->prepare("SELECT * FROM usuario
                                WHERE email_usu = ? AND senha_usu = ?");
        if ($sql->execute(array($email_usu,MD5($senha_usu)))){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            if (count($info) > 0){
                foreach($info as $key => $values){
                    $_SESSION['nome_usu'] = $values['nome_usu'];
                    $_SESSION['adm'] = $values['adm'];
                }
                header('location:../index.php');
            } else {
                echo '<h6>Email de usuário não cadastrado</h6>';
            }
        }
    }
?>
<head>
    <title>Login | UEDA</title>
</head>
<?php require("template/header2.php");?>
    <main>
    </main>
<?php require("template/footer2.php");?>