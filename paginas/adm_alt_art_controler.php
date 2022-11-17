<?php
session_start();
include_once "../include/MySql.php";
include_once "../include/functions.php";
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    } else{
        $id_art  = $titulo_art = $id_eti = $link_art = $resumo_art = $img_art = $image_art = $intro_art = $des_art = $con_art = $ref_art = $imgContent = "";
        $id_artErr  = $titulo_artErr = $id_etiErr = $link_artErr = $resumo_artErr = $img_artErr = $image_artErr = $intro_artErr = $des_artErr = $con_artErr = $ref_artErr = $msgErr = "";

        if (isset($_POST["submit"])){
            if ($id_art != 1){
                if (!empty($_FILES["image"]["name"])){
                    //Pegar informações
                    $fileName = basename($_FILES["image"]["name"]);
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                    //Permitir somente alguns formatos
                    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'jfif');
            
                    if (in_array($fileType, $allowTypes)){
                        $image = $_FILES['image']['tmp_name'];
                        $imgContent = file_get_contents($image);
                    } else {
                        $msgErr = "Desculpe, mas somente arquivos JPG, JPEG, PNG e GIF são permitidos";
                    }
                } else{
                    $image_artErr = "Não foi selecionada nenhuma imagem!";
                }
            } else{
                $image_artErr = "Artigos do tipo <i>notícia</i> não precisam de imagem.";
            }
            /*
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
            } */
                
            if (empty($_POST['titulo_art'])){
                $titulo_artErr = "Texto vazio";
            } else {
                $titulo_art = $_POST['titulo_art'];
            }
    
            if (empty($_POST['id_eti'])){
                $id_etiErr = "Etiqueta não selecionada vazio";
            } else {
                $id_eti = $_POST['id_eti'];
            }
    
            if (empty($_POST['link_art'])){
                $link_artErr = "Texto vazio";
            } else {
                $link_art = $_POST['link_art'];
            }
    
            if (empty($_POST['resumo_art'])){
                $resumo_artErr = "Texto vazio";
            } else {
                $resumo_art = $_POST['resumo_art'];
            }
    
            if (empty($_POST['intro_art'])){
                $intro_artErr = "Texto vazio";
            } else {
                $intro_art = $_POST['intro_art'];
            }
    
            if (empty($_POST['des_art'])){
                $des_artErr = "Texto vazio";
            } else {
                $des_art = $_POST['des_art'];
            }
    
            if (empty($_POST['con_art'])){
                $con_artErr = "Texto vazio";
            } else {
                $con_art = $_POST['con_art'];
            }
            if (empty($_POST['ref_art'])){
                $ref_artErr = "Texto vazio";
            } else {
                $ref_art = $_POST['ref_art'];
            }
    
            if ($id_eti == 1){
                if ($titulo_art && $id_eti && $link_art && $resumo_art){
                    $sql = $pdo->prepare("UPDATE artigo SET titulo_art=?, id_eti=?, link_art=?, resumo_art=? WHERE id_art=?");
                    if ($sql->execute(array($titulo_art, $id_eti, $link_art, $resumo_art, $id_art))){
                        $msgErr = "Dados alterados com sucesso!";
                        header('location:adm_lista_art.php');
                        // $actual_link = $_SERVER['HTTP_REFERER'];
                        // header("Location:$actual_link");
                    } else{
                        $msgErr = "erro na execução de dados"; 
                        header('location:adm_alt_art.php?msgErr='.$msgErr.'&titulo_artErr='.$titulo_artErr.'&id_etiErr='.$id_etiErr.'&link_artErr='.$link_artErr.'&resumo_artErr='.$resumo_artErr);
                    }
                } else{
                    $msgErr = "Faltam informações para serem preenchidas!";
                    header('location:adm_alt_art.php?msgErr='.$msgErr.'&titulo_artErr='.$titulo_artErr.'&id_etiErr='.$id_etiErr.'&link_artErr='.$link_artErr.'&resumo_artErr='.$resumo_artErr);
                }
            } else if (($id_eti == 2) || ($id_eti == 3)){
                if ($titulo_art && $id_eti && $resumo_art && $imgContent && $intro_art && $des_art && $con_art && $ref_art){
                    $sql = $pdo->prepare("UPDATE artigo SET titulo_art=?, id_eti=?, resumo_art=?, img_art=?, intro_art=?, des_art=?, con_art=?, ref_art=? WHERE id_art=?");
                    if ($sql->execute(array($titulo_art, $id_eti, $resumo_art, base64_encode($imgContent), $intro_art, $des_art, $con_art, $ref_art, $id_art))){
                        $msgErr = "Dados alterados com sucesso!";
                        header('location:adm_lista_art.php');
                    } else{
                        $msgErr = "erro na execução de dados";
                        header('location:adm_alt_art?titulo_artErr='.$titulo_artErr.'&id_etiErr='.$id_etiErr.'&resumo_artErr='.$resumo_artErr.'&image_artErr='.$image_artErr.'&intro_artErr='.$intro_artErr.'&des_artErr='.$des_artErr.'&con_artErr='.$con_artErr.'&ref+_artErr='.$ref_artErr);
                    }
                } else{
                    $msgErr = "O valor da etiqueta não é válido!";
                    header('location:adm_alt_art?titulo_artErr='.$titulo_artErr.'&id_etiErr='.$id_etiErr.'&resumo_artErr='.$resumo_artErr.'&image_artErr='.$image_artErr.'&intro_artErr='.$intro_artErr.'&des_artErr='.$des_artErr.'&con_artErr='.$con_artErr.'&ref+_artErr='.$ref_artErr);
                }   
            } else{
                $msgErr = "Não foi selecionada nenhuma etiqueta!";
                header('location:adm_alt_art?titulo_artErr='.$titulo_artErr.'&id_etiErr='.$id_etiErr.'&resumo_artErr='.$resumo_artErr.'&image_artErr='.$image_artErr.'&intro_artErr='.$intro_artErr.'&des_artErr='.$des_artErr.'&con_artErr='.$con_artErr.'&ref+_artErr='.$ref_artErr);
            }
        } else{
            header('location: n_adm_msg.php');
        }
    }
?>