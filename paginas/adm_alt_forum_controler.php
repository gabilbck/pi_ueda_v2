<?php
    //Altera porém não aparece os spans
session_start();
include_once "../include/MySql.php";
include_once "../include/functions.php";
if($_SESSION['adm'] != 1){
    header("location:n_adm_msg.php");
    die;
} else{
    $id_publi = $id_usu = $titulo_publi = $text_publi = $img_publi = $imgContent = "";
    $titulo_publiErr = $text_publiErr = $msgErr = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["submit"])){
        if (isset($_POST['id_publi'])){
            $id_publi = $_POST['id_publi'];
        } 
        if (isset($_POST['id_usu'])){
            $id_usu = $_POST['id_usu'];
        }
        $tem_arquivo = false;
        if (!empty($_FILES["image"]["name"])){
            //Pegar informações
            $fileName = basename($_FILES["image"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            //Permitir somente alguns formatos
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)){
                $image = $_FILES['image']['tmp_name'];
                $imgContent = file_get_contents($image);
                $tem_arquivo = true;
            } else {
                $msgErr = "Desculpe, mas somente arquivos JPG, JPEG, PNG e GIF são permitidos";
            }
        }
            
        if (empty($_POST['titulo_publi'])){
            $titulo_publiErr = "Texto vazio";
        } else {
            $titulo_publi = $_POST['titulo_publi'];
        }
        if (empty($_POST['text_publi'])){
            $text_publiErr = "Texto vazio";
        } else {
            $text_publi = $_POST['text_publi'];
        }

        if ($tem_arquivo){
        //Gravar no banco
            $sql = $pdo->prepare("UPDATE publica_forum SET id_usu=?, titulo_publi=?, text_publi=?, img_publi=? WHERE id_publi=?");
            if ($sql->execute(array($id_usu, $titulo_publi, $text_publi, base64_encode($imgContent), $id_publi))){
                $msgErr = "Dados alterados com sucesso!";
                header('location: adm_lista_forum.php');
            } else{
                $id_publi = $_POST["id_publi"];
                $msgErr = "dados não alterados."; 
                header('location: adm_alt_forum.php?id_publi='.$id_publi.'&titulo_publiErr='.$titulo_publiErr.'&text_publiErr='.$text_publiErr);
            }
        } else{
            $sql = $pdo->prepare("UPDATE publica_forum SET id_usu=?, titulo_publi=?, text_publi=? WHERE id_publi=?");
            if ($sql->execute(array($id_usu, $titulo_publi, $text_publi, $id_publi))){
                $msgErr = "Dados alterados com sucesso!";
                header('location: adm_lista_forum.php');
            } else{
                $id_publi = $_POST["id_publi"];
                $msgErr = "dados não alterados."; 
                header('location: adm_alt_forum.php?id_publi='.$id_publi.'&titulo_publiErr='.$titulo_publiErr.'&text_publiErr='.$text_publiErr);
            }
        }
    } else{
        header('location: n_adm_msg.php');
    } 
}
?>