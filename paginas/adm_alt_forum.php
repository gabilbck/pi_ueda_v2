<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<?php
    $id_publi = $id_usu = $text_publi = $img_publi = $imgContent = "";
    $text_publiErr = $msgErr = "";

    if (isset($_GET['id_publi'])){
        $id_publi = $_GET['id_publi'];
        $sql = $pdo->prepare('SELECT * FROM publica_forum WHERE id_publi =?');
        if ($sql->execute(array($id_publi))){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($info as $key => $value){
                $id_publi = $value['id_publi'];
                $id_usu = $value['id_usu'];
                $text_publi = $value['text_publi'];
                $imgContent = $value['img_publi'];
            }
        }
    }
    
    if (isset($_POST["submit"])){

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
        } 
            
        if (isset($_POST['text_publi'])){
            $text_publi = $_POST['text_publi'];
        } else {
            $text_publiErr = "Texto vazio";
        }

        //Gravar no banco
        if ($nome && $descricao && $valor && $imgContent){
            $sql = $pdo->prepare("UPDATE publica_forum SET id_usu=?, text_publi=?, img_publi=? WHERE id_publi=?");
            if ($sql->execute(array($id_usu, $text_publi, $imgContent, $id_publisss))){
                $msgErr = "Dados alterados com sucesso!";
                    header('location: adm_lista_for.php');
            } else{
                $msgErr = "dados não alterados."; 
            }
        } else {
            $msgErr = "Informações incorretas, não preenchidas ou já cadastradas.";
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
                <h1>ALTERAR PUBLICAÇÃO DO FORUM</h1>
                <br>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="id_publi" value="<?php echo $id_publi?>" readonly>
                    <br><br>
                    <input type="text" name="id_usu" value="<?php echo $id_usu?>" readonly>
                    <br><br>
                    <textarea name="text_publi" type="text" placeholder="Texto para publicação" value="<?php echo $text_publi?>"></textarea>
                    <span class="obrigatorio">* <?php echo '<br>'.$text_publiErr ?></span>
                    <br><br>
                    <div class="escolha-imagem">
                        <label for="image">Selecione uma imagem (Opcional)</label>
                        <input type="file" id='image' name="image"/><br><br>
                    </div>
                    <div class="clear"></div>
                    <br>
                    <button type="submit" name="submit">ENVIAR</button>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer.php");?>