<?php require("../template/header.php");?>
<?php 
    if(!array_key_exists("id_usu",$_SESSION) || $_SESSION['id_usu'] == ""){
        header("location:n_adm_msg.php");
        die;
    }
?>
<?php
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
            }
        } else{
            $msgErr = "Dados faltando!";
        }
    } else {
        $msgErr = "Dados não informados!"; 
    }
?>
<head>
    <title>Publicação No Fórum | UEDA</title>
</head>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>PUBLICAR FORUM</h1>
                <br>
                <form action="" method="post" enctype="multipart/form-data">
                    <input class="input-text" maxlength="30" name="titulo_publi" value="<?php echo $titulo_publi?>" type="text" placeholder="Nome do Título">
                    <span class="obrigatorio"><?php  echo '<br>'.$titulo_publiErr ?></span>
                    <br><br>
                    <textarea name="text_publi" maxlength="1000" type="text" placeholder="Texto para publicação"></textarea>
                    <span class="obrigatorio"><?php echo '<br>'.$text_publiErr ?></span>
                    <br><br>
                    <div class="escolha-imagem">
                        <label for="image">Selecione uma imagem (Opcional)</label>
                        <input type="file" id='image' name="image"/><br><br>
                    </div>
                    <div class="clear"></div>
                    <br>
                    <button type="submit" name="cadastro">ENVIAR</button>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer.php");?>
