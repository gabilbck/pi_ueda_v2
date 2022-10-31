<?php // ARRUMAR IGUAL NAS OUTRAS?>
<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<?php
    $id_publi = $id_usu = $titulo_publi = $text_publi = $img_publi = $imgContent = "";
    $titulo_publiErr = $text_publiErr = $msgErr = "";

    if (isset($_GET['id_publi'])){
        $id_publi = $_GET['id_publi'];
        $sql = $pdo->prepare('SELECT * FROM publica_forum WHERE id_publi =?');
        if ($sql->execute(array($id_publi))){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($info as $key => $value){
                $id_publi = $value['id_publi'];
                $id_usu = $value['id_usu'];
                $titulo_publi = $value['titulo_publi'];
                $text_publi = $value['text_publi'];
                $imgContent = $value['img_publi'];
            }
        }
    }
    
    if (isset($_POST["submit"])){
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
                $msgErr = "dados não alterados."; 
            }
        } else{
            $sql = $pdo->prepare("UPDATE publica_forum SET id_usu=?, titulo_publi=?, text_publi=? WHERE id_publi=?");
            if ($sql->execute(array($id_usu, $titulo_publi, $text_publi, $id_publi))){
                $msgErr = "Dados alterados com sucesso!";
                    header('location: adm_lista_forum.php');
            } else{
                $msgErr = "dados não alterados."; 
            }
        }
    }
?>
<head>
    <title>Alterar Publicação do Fórum</title>
</head>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>ALTERAR PUBLICAÇÃO DO FÓRUM</h1>
                <br>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="id_publi" value="<?php echo $id_publi?>" readonly>
                    <span class="n-obrigatorio">*</span>
                    <br><br>
                    <input type="text" name="id_usu" value="<?php echo $id_usu?>" readonly>
                    <span class="n-obrigatorio">*</span>
                    <br><br>
                    <input type="text" name="titulo_publi" maxlength="30" value="<?php echo $titulo_publi?>">
                    <span class="obrigatorio"><?php echo '<br>'.$titulo_publiErr ?></span>
                    <br><br>
                    <textarea type="text" name="text_publi" maxlength="1000" placeholder="Texto para publicação"><?php echo $text_publi?></textarea>
                    <span class="obrigatorio"><?php echo '<br>'.$text_publiErr ?></span>
                    <div class="clear"></div>
                    <br>
                    <a>Imagem Atual:</a>
                    <br>
                    <?php 
                    if (!empty($imgContent)){ 
                        echo '<img width="150" src="data:image/jpg;charset=utf8;base64,'.$imgContent.'"/>';
                    } else{
                        echo '<br><i>(Não possui imagem)</i><br>';
                    }    
                    ?>
                    <br><br>
                    <div class="escolha-imagem">
                        <label for="image">Selecione uma imagem (Opcional)</label>
                        <input type="file" id='image' name="image"/><br><br>
                    </div>
                    <div class="clear"></div>
                    <br>
                    <div class="botoes-alt">
                    <button><a class="link-branco" href="adm_lista_forum.php">VOLTAR</a></button>
                    <button type="submit" name="submit">ALTERAR</button>
                    </div>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer.php");?>