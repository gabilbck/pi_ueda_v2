<?php 
    include "../include/MySql.php";
    include "../include/functions.php";
    if (isset($_GET['id_com'])){
        $id_com = $_GET['id_com'];
        $sql = $pdo->prepare("DELETE FROM comentario WHERE id_com=?");
        if ($sql->execute(array($id_com))){
            header('location:adm_lista_com.php');
        } else{
            echo "Erro: dados não foram excluídos.<br>";
            echo "comando: $sql. <br>";
        }
    }
?>