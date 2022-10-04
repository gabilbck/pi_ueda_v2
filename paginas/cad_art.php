<?php
    session_start();
    include "../include/MySql.php";
    include "../include/functions.php";

    $id_art = $titulo_art = $id_eti = $link_art = $resumo_art = $data_art = $img_art = $intro_art = $des_art = $con_art = $ref_art = $imgContent = "";
    $titulo_artErr = $id_etiErr = $resumo_artErr = $img_artErr = $intro_artErr = $des_artErr = $con_artErr = $ref_artErr ="";
    $msgErr = "";
    $id_usu = $_SESSION['id_usu'];

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
        if (empty ($_POST['titulo_art'])){
            $titulo_artErr = "Nome do título é obrigatório!";
        } else {
            $titulo_art = test_input($_POST["titulo_art"]);
        }
        if (empty($_POST['resumo_art'])){
            $resumo_artErr = "Resumo é obrigatório!";
        } else {
            $resumo_art = test_input($_POST["resumo_art"]);
        }
        if (empty($_POST['intro_art'])){
            $intro_artErr = " Intridução é obrigatória!";
        } else {
            $intro_art = test_input($_POST["intro_art"]);
        }
        if (empty($_POST['des_art'])){
            $des_artErr = " Desenvolvimento é obrigatório!";
        } else {
            $des_art = test_input($_POST["des_art"]);
        }
        if (empty($_POST['con_art'])){
            $con_artErr = " Conclusão é obrigatório!";
        } else {
            $con_art = test_input($_POST["con_art"]);
        }
        if (empty($_POST['ref_art'])){
            $ref_artErr = " Referências é obrigatório!";
        } else {
            $ref_art = test_input($_POST["ref_art"]);
        }
        if (($_POST['id_eti']) == 1){
            $id_etiErr = "Etiqueta é obrigatória!";
        } else {
            $id_eti = test_input($_POST["id_eti"]);
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
        
                //Inserir dados
                $sql = $pdo->prepare("INSERT INTO ARTIGO (id_art, titulo_art, id_eti, link_art, resumo_art, data_art, img_art, intro_art, des_art, con_art, ref_art)
                                    VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if ($sql->execute(array($titulo_art, $id_eti, $link_art, $resumo_art, $data_art, base64_encode($imgContent), $intro_art, $des_art, $con_art, $ref_art))){
                    $msgErr = "Dados cadastrados com sucesso!";
                    header("location: home.php");
                } else {
                    $msgErr = "Dados não cadastrados!";
                }
            } else {
                $msgErr = "Desculpe, mas somente arquivos JPG, JPEG, PNG e GIF são permitidos";
            }
        } else {
            $msgErr = "Informações incorretas";
        }            
}
echo "Mensagem: ".$msgErr;
?>
<head>
    <title>Publicar artigo| UEDA</title>
</head>
<?php require("../template/header.php");?>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>PUBLICAR ARTIGO</h1>
                <br>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input class="input-text"  name="titulo_art" value="<?php echo $titulo_art?>" type="text" placeholder="Nome do Título">
                    <span class="obrigatorio">* <?php  echo '<br>'.$titulo_artErr ?></span>
                    <br><br>
                    <textarea name="resumo_art" value="<?php  echo $resumo_art?>" type="text" placeholder="Resumo do Texto"></textarea>
                    <span class="obrigatorio">* <?php  echo '<br>'.$resumo_artErr ?></span>
                    <br><br>
                    <textarea name="intro_art" value="<?php  echo $intro_art?>" type="text" placeholder="Introdução do Texto"></textarea>
                    <span class="obrigatorio">* <?php  echo '<br>'.$intro_artErr ?></span>
                    <br><br>
                    <textarea name="des_art" value="<?php  echo $des_art?>" type="text" placeholder="Desenvolvimento do Texto"></textarea>
                    <span class="obrigatorio">* <?php  echo '<br>'.$des_artErr ?></span>
                    <br><br>
                    <textarea name="con_art" value="<?php  echo $con_art?>" type="text" placeholder="Conclusão do Texto"></textarea>
                    <span class="obrigatorio">* <?php  echo '<br>'.$con_artErr ?></span>
                    <br><br>
                    <textarea name="ref_art" value="<?php  echo $ref_art?>" type="text" placeholder="Referências do Texto"></textarea>
                    <span class="obrigatorio">* <?php  echo '<br>'.$ref_artErr ?></span>
                    <br><br>
                    <label>Etiquetas:</label>
                    <select name="id_eti" value="<?php echo $id_eti?>">
                            <option value="">>>Selecione</option>
                            <option value="1">Notícia</option>
                            <option value="2">Art. Científico</option>
                            <option value="3">Art. de site </option>
                        </select>
                    <span class="obrigatorio">* <?php  echo '<br>'.$id_etiErr ?></span>
                    <br><br>
                    <label for="image">Inserir imagem da sua escolha:</label><br>
                    <input type="file" id="image" name="image"/><br><br>
                    <br><br>
                    <div class="clear"></div>
                    <br>
                    <button type="submit" name="cadastro" value="cadastro">ENVIAR</button>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer.php");?>