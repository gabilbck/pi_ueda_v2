<?php
    session_start();
    include_once "../include/MySql.php";
    include_once "../include/functions.php";
?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    } else{
        $id_usu = $_SESSION['id_usu'];
        
        $id_publi = $titulo_publi = $text_publi = $img_publi = $imgContent = "";
        $titulo_publiErr = $text_publiErr = $msgErr = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){

            if (empty($_POST['titulo_publi'])){
                $titulo_publiErr = "Título para publicação é obrigatória!";
            } else {
                $titulo_publi = test_input($_POST["titulo_publi"]);
            }

            if (empty($_POST['text_publi'])){
                $text_publiErr = "Texto para publicação é obrigatória!";
            } else {
                $text_publi = test_input($_POST["text_publi"]);
            }

            if ($_FILES["image"]["name"]){
                //Pegar informações
                $fileName = basename($_FILES["image"]["name"]);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                //Permitir somente alguns formatos
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

                if (in_array($fileType, $allowTypes)){
                    $image = $_FILES['image']['tmp_name'];
                    $imgContent = file_get_contents($image);
                } else {
                    $msgErr = "Desculpe, mas somente arquivos JPG, JPEG, PNG e GIF são permitidos";
                }
            } 
            
            //Inserir dados
            if ($titulo_publi && $text_publi){
                $sql = $pdo->prepare("INSERT INTO publica_forum (id_publi, id_usu, titulo_publi, text_publi, img_publi) 
                                VALUES (null, ?, ?, ?, ?)");
                if ($sql->execute(array($id_usu, $titulo_publi, $text_publi, base64_encode($imgContent)))){
                    $msgErr = "Dados cadastrados com sucesso!";
                    header("location: menu_forum.php");
                } else {
                    $msgErr = "Dados não cadastrados!";
                    header('location:cad_for.php?msgErr'.$msgErr);
                }
            } else{
                $msgErr = "Dados faltando!";
                header('location:cad_for.php?titulo_publiErr='.$titulo_publiErr.'&text_publiErr='.$text_publiErr);
            }
        } else {
            header("Location:n_adm_msg.php");
        }
    }
?>