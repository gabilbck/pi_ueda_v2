<?php
session_start();
include_once "../include/MySql.php";
include_once "../include/functions.php";

$id_art = $titulo_art = $id_eti = $link_art = $resumo_art = $img_art = $intro_art = $des_art = $con_art = $ref_art = $imgContent = "";
$titulo_artErr = $id_etiErr = $link_artErr = $resumo_artErr = $image_artErr = $intro_artErr = $des_artErr = $con_artErr = $ref_artErr = "";
$msgErr = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
    if (empty ($_POST['titulo_art'])){
        $titulo_artErr = "Título é obrigatório!";
    } else {
        $titulo_art = test_input($_POST["titulo_art"]);
    }
    if (empty($_POST['resumo_art'])){
        $resumo_artErr = "Resumo é obrigatório!";
    } else {
        $resumo_art = test_input($_POST["resumo_art"]);
    }
    if (empty($_POST['link_art'])){
        $link_artErr = "Link é obrigatório!";
    } else {
        $link_art = test_input($_POST["link_art"]);
    }
    if (empty($_POST['intro_art'])){
        $intro_artErr = "Introdução é obrigatória!";
    } else {
        $intro_art = test_input($_POST["intro_art"]);
    }
    if (empty($_POST['des_art'])){
        $des_artErr = "Desenvolvimento é obrigatório!";
    } else {
        $des_art = test_input($_POST["des_art"]);
    }
    if (empty($_POST['con_art'])){
        $con_artErr = "Conclusão é obrigatório!";
    } else {
        $con_art = test_input($_POST["con_art"]);
    }
    if (empty($_POST['ref_art'])){
        $ref_artErr = "Referências é obrigatório!";
    } else {
        $ref_art = test_input($_POST["ref_art"]);
    }
    if (($_POST['id_eti']) == ""){
        $id_etiErr = "Selecione uma das etiquetas antes de cadastrar um artigo!";
    } else {
        $id_eti = test_input($_POST["id_eti"]);
    }
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

    //Inserir dados
    if ($id_eti == 1){
        if ($titulo_art && $id_eti && $link_art && $resumo_art){
            $sql = $pdo->prepare("INSERT INTO ARTIGO (id_art, titulo_art, id_eti, link_art, resumo_art, img_art, intro_art, des_art, con_art, ref_art)
                                VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($sql->execute(array($titulo_art, $id_eti, $link_art, $resumo_art, base64_encode($imgContent), $intro_art, $des_art, $con_art, $ref_art))){
                $msgErr = "Dados cadastrados com sucesso!";
                header("location: menu_artigos.php");
            } else {
                $msgErr = "Dados não cadastrados!";
                header('location: cad_art.php?msgErr='.$msgErr);
            }
        } else {
            $msgErr = "Faltam dados. Informações não cadastradas!";
            header('location: cad_art.php?titulo_artErr='.$titulo_artErr.'&id_etiErr='.$id_etiErr.'&link_artErr='.$link_artErr.'&resumo_artErr='.$resumo_artErr);
        }
    } else if (($id_eti == 2) || ($id_eti == 3)){
        if ($titulo_art && $id_eti && $resumo_art && $imgContent && $intro_art && $des_art && $con_art && $ref_art){
            $sql = $pdo->prepare("INSERT INTO ARTIGO (id_art, titulo_art, id_eti, link_art, resumo_art, img_art, intro_art, des_art, con_art, ref_art)
                                VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($sql->execute(array($titulo_art, $id_eti, $link_art, $resumo_art, base64_encode($imgContent), $intro_art, $des_art, $con_art, $ref_art))){
                $msgErr = "Dados cadastrados com sucesso!";
                header("location: menu_artigos.php");
            } else {
                $msgErr = "Dados não cadastrados!";
                header('location:cad_art.php?msgErr='.$msgErr);
            }
        } else {
            $msgErr = "Dados não cadastrados!";
            header('location:cad_art.php?titulo_artErr='.$titulo_artErr.'&id_etiErr='.$id_etiErr.'&resumo_artErr='.$resumo_artErr.'&image_artErr='.$image_artErr.'&intro_artErr='.$intro_artErr.'&des_artErr='.$des_artErr.'&con_artErr='.$con_artErr.'&ref_artErr='.$ref_artErr);
        }
    } else{
        $msgErr = "O valor da etiqueta não é válido!";
        header('location:cad_art.php?msgErr='.$msgErr.'&id_etiErr='.$id_etiErr);
    }
} else {
    header("location: n_adm_msg.php");
}            
?>