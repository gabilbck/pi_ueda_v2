<?php require("../template/header.php");?>
<?php 
    if(!array_key_exists("id_usu",$_SESSION) || $_SESSION['id_usu'] == ""){
        header("location:n_adm_msg.php");
        die;
    } else{
        $id_usu = $_SESSION['id_usu'];
    
        $id_publi = $titulo_publi = $text_publi = $img_publi = $imgContent = "";
        $titulo_publiErr = $text_publiErr = $msgErr = "";
    
        if(isset($_GET['titulo_publiErr'])){
            $titulo_publiErr = $_GET['titulo_publiErr'];
        }
        if(isset($_GET['text_publiErr'])){
            $text_publiErr = $_GET['text_publiErr'];
        }
    }
?>
<head>
    <title>Publicação No Fórum | UEDA</title>
</head>
    <main>
        <div class="atencao">
            <center><h4>ATENÇÃO: Você NÃO poderá apagar NENHUMA publicação/comentário enviado no fórum do site!</h4></center>
        </div>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>PUBLICAR FÓRUM</h1>
                <br>
                <form action="cad_for_controler.php" method="post" enctype="multipart/form-data">
                    <input class="input-text" maxlength="30" name="titulo_publi" value="<?php echo $titulo_publi?>" type="text" placeholder="Nome do Título">
                    <span class="obrigatorio"><?php echo '<br>'.$titulo_publiErr ?></span>
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
