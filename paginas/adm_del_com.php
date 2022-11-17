<?php 
    include "../include/MySql.php";
    include "../include/functions.php";
    if (isset($_GET['id_cmt'])){
        $id_cmt = $_GET['id_cmt'];
        $sql = $pdo->prepare("DELETE FROM comentario WHERE id_cmt=?");
        if ($sql->execute(array($id_cmt))){
            header('location:adm_lista_com.php');
        } else{
            echo "Erro: dados não foram excluídos.<br>";
            echo "comando: $sql. <br>";
        }
    }
?>