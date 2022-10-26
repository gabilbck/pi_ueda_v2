<?php // ERRO NO SQL!!! ?>
<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<?php
    $id_art  = $titulo_art = $id_eti = $link_art = $resumo_art = $img_art = $intro_art = $des_art = $con_art = $ref_art = $imgContent = "";
    $id_artErr  = $titulo_artErr = $id_etiErr = $link_artErr = $resumo_artErr = $img_artErr = $intro_artErr = $des_artErr = $con_artErr = $ref_artErr = $msgErr = "";

    if (isset($_GET['id_art'])){
        $id_art = $_GET['id_art'];
        $sql = $pdo->prepare('SELECT * FROM artigo WHERE id_art =?');
        if ($sql->execute(array($id_art))){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($info as $key => $value){
                $id_art = $value['id_art'];
                $titulo_art = $value['titulo_art'];
                $id_eti = $value['id_eti'];
                $link_art = $value['link_art'];
                $resumo_art = $value['resumo_art'];
                $intro_art = $value['intro_art'];
                $des_art = $value['des_art'];
                $con_art = $value['con_art'];
                $ref_art = $value['ref_art'];
                $imgContent = $value['img_art'];
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

        if (empty($_POST['img_art'])){
            $img_artErr = "Texto vazio";
        } else {
            $img_art = $_POST['img_art'];
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

        if ($tem_arquivo){
            $sql = $pdo->prepare("UPDATE artigo SET titulo_art=?, id_eti=?, link_art=?, resumo_art=?, img_art=?, intro_art=?, des_art=?, con_art=?, ref_art=? WHERE id_art=?");
            if ($sql->execute(array($titulo_art, $id_eti, $link_art, $resumo_art, base64_encode($imgContent), $intro_art, $des_art, $con_art, $ref_art, $id_art))){
                $msgErr = "Dados alterados com sucesso!";
                header('location: adm_lista_art.php');
            } else{
                $msgErr = "dados não alterados."; 
            }
        } else{
            $sql = $pdo->prepare("UPDATE artigo SET titulo_art=?, id_eti=?, link_art=?, resumo_art=?, intro_art=?, des_art=?, con_art=?, ref_art=? WHERE id_art=?");
            if ($sql->execute(array($titulo_art, $id_eti, $link_art, $resumo_art, $intro_art, $des_art, $con_art, $ref_art, $id_art))){
                $msgErr = "Dados alterados com sucesso!";
                header('location: adm_lista_art.php');
            } else{
                $msgErr = "dados não alterados."; 
            }
        }
        //Gravar no bancob    ta dando erro
        
    }
?>
<head>
    <title>Alterar Publicação do Artigo</title>
</head>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>ALTERAR ARTIGO</h1>
                <br>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="id_art" value="<?php echo $id_art?>" readonly>
                    <span class="n-obrigatorio">*</span>
                    <br><br>
                    <input class="input-text" name="titulo_art" maxlength="30" value="<?php echo $titulo_art?>" type="text" placeholder="Nome do Título">
                    <span class="obrigatorio">* <?php  echo '<br>'.$titulo_artErr ?></span>
                    <br><br>
                    <input class="input-text" name="link_art" value="<?php  echo $link_art?>" type="text" placeholder="Link do Artigo (FORA DO SITE UEDA)"></textarea>
                    <span class="obrigatorio">* <?php  echo '<br>'.$link_artErr ?></span>
                    <br><br>
                    <textarea name="resumo_art" maxlength="2000" type="text" placeholder="Resumo do Texto"><?php  echo $resumo_art?></textarea>
                    <span class="obrigatorio">* <?php  echo '<br>'.$resumo_artErr ?></span>
                    <br><br>
                    <textarea name="intro_art" maxlength="2000" type="text" placeholder="Introdução do Texto"><?php  echo $intro_art?></textarea>
                    <span class="obrigatorio">* <?php  echo '<br>'.$intro_artErr ?></span>
                    <br><br>
                    <textarea name="des_art" maxlength="2000" type="text" placeholder="Desenvolvimento do Texto"><?php  echo $des_art?></textarea>
                    <span class="obrigatorio">* <?php  echo '<br>'.$des_artErr ?></span>
                    <br><br>
                    <textarea name="con_art" maxlength="2000" type="text" placeholder="Conclusão do Texto"><?php  echo $con_art?></textarea>
                    <span class="obrigatorio">* <?php  echo '<br>'.$con_artErr ?></span>
                    <br><br>
                    <textarea name="ref_art" maxlength="1000" type="text" placeholder="Referências do Texto"><?php  echo $ref_art?></textarea>
                    <span class="obrigatorio">* <?php  echo '<br>'.$ref_artErr ?></span>
                    <br><br>
                    <label>Etiquetas: </label>
                    <select name="id_eti"> <!-- Implementação futura: Etiquetas em foreach atualizadas com o banco de dados para serem cadastradas -->
                            <option value="">Selecione</option>
                            <option value="1" <?php if ($id_eti == 1){ ?> selected <?php } ?>>Notícia</option>
                            <option value="2" <?php if ($id_eti == 2){ ?> selected <?php } ?>>Art. Científico</option>
                            <option value="3" <?php if ($id_eti == 1){ ?> selected <?php } ?>>Art. de site </option>
                        </select>
                    <span class="obrigatorio">* <?php echo '<br>'.$id_etiErr ?></span>
                    <br><br>
                    <a>Imagem Atual:</a>
                    <br>
                    <?php 
                    if (!empty($imgContent)){ 
                        echo '<img width="150" src="data:image/jpg;charset=utf8;base64,'.($imgContent).'"/>';
                    } else{
                        echo '<center><i>(Não possui imagem)</i></center>';
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
                    <button><a class="link-branco" href="adm_lista_art.php">VOLTAR</a></button>
                    <button type="submit" name="submit">ALTERAR</button>
                    </div>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer.php");?>