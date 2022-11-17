<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    } else{
        $id_art = $titulo_art = $id_eti = $link_art = $resumo_art = $intro_art = $des_art = $con_art = $ref_art = $imgContent = "";
        $titulo_artErr = $id_etiErr = $link_artErr = $resumo_artErr = $image_artErr = $intro_artErr = $des_artErr = $con_artErr = $ref_artErr = "";
        $msgErr = "";    

        if(isset($_GET['titulo_artErr'])){
            $titulo_artErr = $_GET['titulo_artErr'];
        }
        if(isset($_GET['id_etiErr'])){
            $id_etiErr = $_GET['id_etiErr'];
        }
        if(isset($_GET['link_artErr'])){
            $link_artErr = $_GET['link_artErr'];
        }
        if(isset($_GET['resumo_artErr'])){
            $resumo_artErr = $_GET['resumo_artErr'];
        }
        if(isset($_GET['image_artErr'])){
            $image_artErr = $_GET['image_artErr'];
        }
        if(isset($_GET['intro_artErr'])){
            $intro_artErr = $_GET['intro_artErr'];
        }
        if(isset($_GET['des_artErr'])){
            $des_artErr = $_GET['des_artErr'];
        }
        if(isset($_GET['con_artErr'])){
            $con_artErr = $_GET['con_artErr'];
        }
        if(isset($_GET['ref_artErr'])){
            $ref_artErr = $_GET['ref_artErr'];
        }
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
                <br><br>
                <form action="cad_art_controler.php" method="POST" enctype="multipart/form-data">
                    <label>Etiquetas:</label>
                    <select name="id_eti" onchange="altera_form(this)"> <!-- Implementação futura: Etiquetas em foreach atualizadas com o banco de dados para serem cadastradas -->
                            <option value="">Selecione</option>
                            <option value="1">Notícia</option>
                            <option value="2">Art. Científico</option>
                            <option value="3">Art. de site </option>
                    </select> 
                    <span id="id_etiErr" class="obrigatorio"><?php echo '<br>'.$id_etiErr ?></span>
                    <br><br>
                    <input id="titulo_art" class="input-text" maxlength="255" name="titulo_art" value="<?php echo $titulo_art?>" type="text" placeholder="Nome do Título">
                    <span id="titulo_artErr" class="obrigatorio"><?php echo '<br>'.$titulo_artErr ?></span>
                    <br><br>
                    <input id="link_art" class="input-text" name="link_art" value="<?php echo $link_art?>" type="text" placeholder="Link do Artigo (FORA DO SITE UEDA)"></textarea>
                    <span id="link_artErr" class="obrigatorio"><?php echo '<br>'.$link_artErr ?></span>
                    <br><br>
                    <textarea id="resumo_art" maxlength="2000" name="resumo_art" value="<?php echo $resumo_art?>" type="text" placeholder="Resumo do Texto"></textarea>
                    <span id="resumo_artErr" class="obrigatorio"><?php echo '<br>'.$resumo_artErr ?></span>
                    <br><br>
                    <textarea id="intro_art" maxlength="2000" name="intro_art" value="<?php echo $intro_art?>" type="text" placeholder="Introdução do Texto"></textarea>
                    <span id="intro_artErr" class="obrigatorio"><?php echo '<br>'.$intro_artErr ?></span>
                    <br><br>
                    <textarea id="desc_art" maxlength="2000" name="des_art"value="<?php echo $des_art?>" type="text" placeholder="Desenvolvimento do Texto"></textarea>
                    <span id="des_artErr" class="obrigatorio"><?php echo '<br>'.$des_artErr ?></span>
                    <br><br>
                    <textarea id="con_art" maxlength="2000" name="con_art" value="<?php echo $con_art?>" type="text" placeholder="Conclusão do Texto"></textarea>
                    <span id="con_artErr" class="obrigatorio"><?php echo '<br>'.$con_artErr ?></span>
                    <br><br>
                    <textarea id="ref_art" maxlength="1000" name="ref_art" value="<?php echo $ref_art?>" type="text" placeholder="Referências do Texto"></textarea>
                    <span id="ref_artErr" class="obrigatorio"><?php echo '<br>'.$ref_artErr ?></span>        
                    <br><br><br>
                    <div id="image_art" class="escolha-imagem">
                        <label style="width: 300px;" for="image">Selecione uma imagem</label>
                        <input id='image' type="file" name="image"/><br><br>
                        <span id="image_artErr" class="obrigatorio"><?php echo $image_artErr ?></span> <br> 
                    </div>
                    <br><br>
                    <div class="clear"></div>
                    <button type="submit" name="cadastro">ENVIAR</button>
                </form>
                <br><br>
            </center>
        </div>
    </main>
    <script>
        const altera_form = function(element){
            const valor = element.value;
            console.log(valor);
            if(valor=='1'){
                document.getElementById('titulo_art').style.display='block'; // aparece -> block
                document.getElementById('link_art').style.display='block';
                document.getElementById('resumo_art').style.display='block';
                document.getElementById('intro_art').style.display='none'; //   não aparece -> none
                document.getElementById('desc_art').style.display='none';
                document.getElementById('con_art').style.display='none';
                document.getElementById('ref_art').style.display='none'; 
                document.getElementById('image_art').style.display='none';

                document.getElementById('titulo_artErr').style.display='block'; // aparece -> block
                document.getElementById('link_artErr').style.display='block';
                document.getElementById('resumo_artErr').style.display='block';
                document.getElementById('ref_artErr').style.display='none'; //     não aparece -> none
                document.getElementById('con_artErr').style.display='none';
                document.getElementById('des_artErr').style.display='none';
                document.getElementById('intro_artErr').style.display='none';
                document.getElementById('image_artErr').style.display='none';
            } else if ((valor=='2') || (valor=='3')){
                document.getElementById('titulo_art').style.display='block'; // aparece -> block
                document.getElementById('link_art').style.display='none'; //    não aparece -> none
                document.getElementById('resumo_art').style.display='block';
                document.getElementById('intro_art').style.display='block';
                document.getElementById('desc_art').style.display='block';
                document.getElementById('con_art').style.display='block';
                document.getElementById('ref_art').style.display='block';
                document.getElementById('image_art').style.display='block';

                document.getElementById('titulo_artErr').style.display='block'; // aparece -> block
                document.getElementById('link_artErr').style.display='none'; //    não aparece -> none
                document.getElementById('resumo_art').style.display='block';
                document.getElementById('intro_artErr').style.display='block';
                document.getElementById('des_artErr').style.display='block';
                document.getElementById('con_artErr').style.display='block';
                document.getElementById('ref_artErr').style.display='block';
                document.getElementById('image_artErr').style.display='block';
            } else{
                document.getElementById('titulo_art').style.display='block'; // aparece -> block
                document.getElementById('link_art').style.display='block';
                document.getElementById('resumo_art').style.display='block';
                document.getElementById('intro_art').style.display='block';
                document.getElementById('desc_art').style.display='block';
                document.getElementById('con_art').style.display='block';
                document.getElementById('ref_art').style.display='block';
                document.getElementById('image_art').style.display='block';

                document.getElementById('titulo_artErr').style.display='block'; // aparece -> block
                document.getElementById('link_artErr').style.display='block';
                document.getElementById('resumo_art').style.display='block';
                document.getElementById('intro_artErr').style.display='block';
                document.getElementById('des_artErr').style.display='block';
                document.getElementById('con_artErr').style.display='block';
                document.getElementById('ref_artErr').style.display='block';
                document.getElementById('image_artErr').style.display='block';
            }
        };
    </script>
<?php require("../template/footer.php");?>