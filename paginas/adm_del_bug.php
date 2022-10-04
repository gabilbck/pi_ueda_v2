<?php 
    include "../include/MySql.php";
    include "../include/functions.php";
    if (isset($_GET['cod_bug'])){
        $cod_bug = $_GET['cod_bug'];
        $sql = $pdo->prepare("DELETE FROM bug WHERE cod_bug=?");
        if ($sql->execute(array($cod_bug))){
            echo "Reporte excluido com sucesso!";
            header('location:adm_lista_bug.php');
        } else{
            echo "Erro: dados não foram excluídos.<br>";
            echo "comando: $sql. <br>";
        }
    }
?>