<?php
session_start();
include_once "../include/MySql.php";
include_once "../include/functions.php";
header('location:n_adm_msg.php');
/*FAZER PHP E CONFIGURAÇÃO*/
/*
    $email_usu = "";
    $email_usuErr = $msgErr = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (empty($_POST['email_usu'])){
            $email_usuErr = "Email está incorreto.";
        } else {
            $email_usu = test_input($_POST["email_usu"]);
        }
    } if ($email_usu){
        //código para consultar os dados no banco de dados
        $sql = $pdo->prepare("SELECT * FROM usuario WHERE email_usu = ?");
        if ($sql->execute(array($email_usu))){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            if (count($info) > 0){
                foreach($info as $key => $values){
                    $_SESSION['id_usu'] = $values['id_usu'];
                    $_SESSION['nome_usu'] = $values['nome_usu'];
                    $_SESSION['adm'] = $values['adm'];
                }
                header('location:sus_log_usu.php');
            } else {
                $msgErr = '* Credenciais incorretas ou não informadas.';
                header('location:login_usu.php?msgErr='.$msgErr);
            }
        }
    }*/
?>