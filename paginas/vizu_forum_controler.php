<?php
session_start();
include_once "../include/MySql.php";
include_once "../include/functions.php";
if(!array_key_exists("id_usu",$_SESSION) || $_SESSION['id_usu'] == ""){
    header("location:n_adm_msg.php");
    die;
} else{
    $id_usu = $_SESSION['id_usu'];
    $id_cmt = $text_cmt = "";
    $id_cmtErr = $text_cmtErr = $msgErr = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
        $id_publi = $_POST['id_publi'];
        if (empty($_POST['text_cmt'])){
            $text_cmtErr = "Você não pode fazer um comentário vazio!";
        } else {
            $text_cmt = test_input($_POST["text_cmt"]);
        }
        
        //Inserir dados
        if ($text_cmt){
            $sql = $pdo->prepare("INSERT INTO comentario (text_cmt, id_usu, id_publi)
                            VALUES (?, ?, ?)");
            if ($sql->execute(array($text_cmt, $id_usu, $id_publi))){
                $msgErr = "Mensagem enviada!";
                $actual_link = $_SERVER['HTTP_REFERER'];
                header("Location:$actual_link");
            } else {
                $msgErr = "Dados não cadastrados!";
                header("Location:vizu_forum.php?id_publi=$id_publi&erro=$msgErr");
            }
        } else{
            $msgErr = "Dados faltando!";
            header("Location:vizu_forum.php?id_publi=$id_publi&erro=$msgErr");
        }
    } else {
        header("Location:n_adm_msg.php");
    }
}
?>