<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<?php
    $id_art = $titulo_art = $id_eti = $link_art = $resumo_art = $img_art = $intro_art = $des_art = $con_art = $ref_art = $imgContent = "";
    $titulo_artErr = $id_etiErr = $link_artErr = $resumo_artErr = $img_artErr = $intro_artErr = $des_artErr = $con_artErr = $ref_artErr ="";
    $msgErr = "";

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
        if (empty($_POST['link_art'])){
            $link_artErr = "Resumo é obrigatório!";
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
            $id_etiErr = "Etiqueta é obrigatória!";
        } else {
            $id_eti = test_input($_POST["id_eti"]);
        }    
        
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
        }
        //Inserir dados
        $sql = $pdo->prepare("INSERT INTO ARTIGO (id_art, titulo_art, id_eti, link_art, resumo_art, img_art, intro_art, des_art, con_art, ref_art)
                            VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($sql->execute(array($titulo_art, $id_eti, $link_art, $resumo_art, base64_encode($imgContent), $intro_art, $des_art, $con_art, $ref_art))){
            $msgErr = "Dados cadastrados com sucesso!";
            header("location: menu_artigos.php");
        } else {
            $msgErr = "Dados não cadastrados!";
        }
    } else {
        $msgErr = "Informações incorretas";
    }            
?>
<head>
    <title>Publicar artigo | UEDA</title>
</head>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>PUBLICAR ARTIGO</h1>
                <br>
                <form action="" method="POST" enctype="multipart/form-data">
                <br><br>
                    <label>Etiquetas:</label>
                    <select name="id_eti" onchange="altera_form(this)"> <!-- Implementação futura: Etiquetas em foreach atualizadas com o banco de dados para serem cadastradas -->
                            <option value="">Sel ecione</option>
                            <option value="1">Notícia</option>
                            <option value="2">Art. Científico</option>
                            <option value="3">Art. de site </option>
                        </select> <br> <br>
                    <input class="input-text" maxlength="30" name="titulo_art" value="<?php echo $titulo_art?>" type="text" placeholder="Nome do Título">
                    <span class="obrigatorio"><?php  echo '<br>'.$titulo_artErr ?></span>
                    
                    <br><br>
                    <input class="input-text" id="link_art" name="link_art" value="<?php  echo $link_art?>" type="text" placeholder="Link do Artigo (FORA DO SITE UEDA)"></textarea>
                    <span class="obrigatorio"><?php  echo '<br>'.$link_artErr ?></span>
                    
                    <br><br>
                    <textarea maxlength="2000" name="resumo_art" value="<?php  echo $resumo_art?>" type="text" placeholder="Resumo do Texto"></textarea>
                    <span class="obrigatorio"><?php  echo '<br>'.$resumo_artErr ?></span>
                    
                    <br><br>
                    <textarea maxlength="2000" name="intro_art" id="intro_art" value="<?php  echo $intro_art?>" type="text" placeholder="Introdução do Texto"></textarea>
                    <span class="obrigatorio"><?php  echo '<br>'.$intro_artErr ?></span>
                    
                    <br><br>
                    <textarea maxlength="2000" name="des_art" id="desc_art" value="<?php  echo $des_art?>" type="text" placeholder="Desenvolvimento do Texto"></textarea>
                    <span class="obrigatorio"><?php  echo '<br>'.$des_artErr ?></span>
                    
                    <br><br>
                    <textarea maxlength="2000" name="con_art" id="con_art" value="<?php  echo $con_art?>" type="text" placeholder="Conclusão do Texto"></textarea>
                    <span class="obrigatorio"><?php  echo '<br>'.$con_artErr ?></span>
                    
                    <br name="ref_art"><br name="ref_art">
                    <textarea maxlength="1000" name="ref_art" id="ref_art" value="<?php  echo $ref_art?>" type="text" placeholder="Referências do Texto"></textarea>
                    <span class="obrigatorio"><?php  echo '<br>'.$ref_artErr ?></span>        
     
                    <br><br><br>
                    <div class="escolha-imagem">
                        <label style="width: 300px;" id="img_art" for="image">Selecione uma imagem (Opcional)</label>
                        <input type="file" id='image' name="image"/><br>
                    </div>
                    <br><br>
                    <div class="clear"></div>
                    <br>
                    <button type="submit" name="cadastro" value="cadastro">ENVIAR</button>
                </form>
                <br><br>
            </center>
        </div>
    </main>
    <script>
        const altera_form = function(element){
            const valor = element.value;
            console.log(valor);
                if(valor==1){
                    document.getElementById('ref_art').style.display='none';
                    document.getElementById('con_art').style.display='none';
                    document.getElementById('desc_art').style.display='none';
                    document.getElementById('intro_art').style.display='none';
                    document.getElementById('img_art').style.display='none';
            } else{
                document.getElementById('ref_art').style.display='block';
                document.getElementById('con_art').style.display='block';
                document.getElementById('desc_art').style.display='block';
                document.getElementById('intro_art').style.display='block';
                document.getElementById('img_art').style.display='block';
            }
            if(valor==2 || valor==3 ){
                    document.getElementById('link_art').style.display='none';
            } else{
                document.getElementById('link_art').style.display='block';
           }
        };
    </script>
<?php require("../template/footer.php");?>