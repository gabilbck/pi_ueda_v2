<?php 
    include "../include/MySql.php";
    include "../include/functions.php";
    if (isset($_GET['id_eti'])){
        $id_eti = $_GET['id_eti'];
        $sql = $pdo->prepare("DELETE FROM etiqueta_art WHERE id_eti=?");
        if ($sql->execute(array($id_eti))){
            header('location:adm_lista_eti.php');
        } else{
            echo "Erro: dados não foram excluídos.<br>";
            echo "comando: $sql. <br>";
        }
    }
?>