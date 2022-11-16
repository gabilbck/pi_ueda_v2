<?php
session_start();
include_once "../include/MySql.php";
include_once "../include/functions.php";

    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    } else{
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
            if (isset($_POST['id_eti'])){
                $id_eti = $_POST['id_eti'];
            } 
            if (empty($_POST['nome_eti'])){
                $nome_etiErr = "Nome é obrigatório!";
            } else {
                $nome_eti = test_input($_POST["nome_eti"]);
            }

            //Verificar se existe uma etiqueta
            if ($nome_eti){
                $sql = $pdo->prepare("SELECT * FROM etiqueta_art WHERE nome_eti=? AND id_eti <> ?");
                if ($sql->execute(array($nome_eti, $id_eti))){
                    if ($sql->rowCount() > 0){
                        $msgErr = "Nome já cadastrado para outra etiqueta";
                    } else {
                        $sql = $pdo->prepare("UPDATE etiqueta_art SET nome_eti=? WHERE id_eti=?");
                        if ($sql->execute(array($nome_eti, $id_eti))){
                            $msgErr = "Dados alterados com sucesso!";
                            header('location: adm_lista_eti.php');
                        } else{
                            $msgErr = "dados não alterados.";
                            header('location:adm_alt_eti?id_eti='.$id_eti.'&nome_etiErr='.$nome_etiErr);
                        }
                    }
                } else{
                    $id_eti = $_GET['id_eti']
                    header('location:adm_alt_eti?id_eti='.$id_eti.'&nome_etiErr='.$nome_etiErr);
                } 
            } else {
                $_GET['id_eti']
                $msgErr = "Dados não informados!"; 
                header('location:adm_alt_eti?id_eti='.$id_eti.'&nome_etiErr='.$nome_etiErr);
            }
        } else{
            header('location: n_adm_msg.php');
        }
    }
?>s