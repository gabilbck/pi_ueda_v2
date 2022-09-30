<?php
    session_start();
    include "../include/MySql.php";
    include "../include/functions.php";

    $id_publica = $id_usu = $text_publica = $img_publi = $imgContent = "";
    $text_publiErr = $msgErr = "";
    $id_usu = $_SESSION['id_usu'];

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
        
        if (empty ($_POST['text_publi'])){
            $text_publiErr = "Texto para pblicação é obrigatória!";
        } else {
            $text_publica = test_input($_POST["text_publi"]);
        }

        if (!empty($_FILES["image"]["name"])){
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
        } else {
            $msgErr = "Informações incorretas";
        }
        
        //Inserir dados
        $sql = $pdo->prepare("INSERT INTO PUBLICA_FORUM (id_publi, id_usu, text_publi, img_publi)
                            VALUES (null, ?, ?, ?, ?)");
        if ($sql->execute(array($id_usu, $text_publica, base64_encode($imgContent)))){
            $msgErr = "Dados cadastrados com sucesso!";
            header("location: ../index.php");
        } else {
            $msgErr = "Dados não cadastrados!";
        }
    } else {
        $msgErr = "Dados não informados!"; 
    }
?>
<head>
    <title>Cadastre Forum| UEDA</title>
</head>
<?php require("../template/header2.php");?>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>PUBLICAR FORUM</h1>
                <br>
                <form action="" method="post" enctype="multipart/form-data">
                    <textarea name="text_publi" type="text" placeholder="Texto para publicação"></textarea>
                    <span class="obrigatorio">* <?php echo '<br>'.$text_publiErr ?></span>
                    <br><br>
                    <label for="image">Inserir imagem da sua escolha:</label>
                    <input type="file" id="image" name="image"/><br><br>  
                    <div class="clear"></div>
                    <br>
                    <button type="submit" name="cadastro">ENVIAR</button>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer2.php");?>
