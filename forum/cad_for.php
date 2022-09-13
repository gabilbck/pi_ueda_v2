<?php
    session_start();
    include "../include/MySql.php";
    include "../include/functions.php";

    $id_publica = $id_usu = $text_publica = $img_publica = $curtida_publica = $imgContent = "";
    $text_publiErr = $msgErr = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
        
        if (empty ($_POST['text_publi'])){
            $text_publiErr = "Texto para pblicação é obrigatória!";
        } else {
            $text_publi = test_input($_POST["text_publi"]);
        }

        if (isset($_POST["submit"])){
            if (!empty($_FILES["image"]["name"])){
                //Pegar informações
                $fileName = basename($_FILES["image"]["name"]);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                //Permitir somente alguns formatos
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    
                if (in_array($fileType, $allowTypes)){
                    $img_publica = $_FILES['image']['tmp_name'];
                    $imgContent = file_get_contents($img_publica);
                } else {
                    $msgErr = "Desculpe, mas somente arquivos JPG, JPEG, PNG e GIF são permitidos";
                }
            } else {
                $msgErr = "Informações incorretas";
            }
        }

        //Inserir dados
        $sql = $pdo->prepare("INSERT INTO PUBLICA_FORUM (id_publica, id_usu, text_publica, img_publica, curtida_publica)
                            VALUES (null, ?, ?, ?, ?, ?, ?)");
        if ($sql->execute(array($id_usu, $text_publica, $img_publica, $curtida_publica, $imgContent))){
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
                <form action="" method="post">
                    <input name="text_publi" value="<?php $text_publi?>" type="text" placeholder="Texto para publicação">
                    <span class="obrigatorio">* <?php echo '<br>'.$text_publiErr ?></span>
                    <br><br>
                    <label for="img_publi">Inserir imagem da sua escolha:</label><br>
                    <input type="file" name="image" value="<?php echo base64_encode($img_publi)?>"/><br><br>
                    
                   
                    <div class="clear"></div>
                    <br>
                    <button type="submit" name="cadastro">ENVIAR</button>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer2.php");?>
