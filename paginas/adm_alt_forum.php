<?php
session_start();
include_once "../include/MySql.php";
include_once "../include/functions.php";

    if(!array_key_exists("id_usu",$_SESSION) || $_SESSION['id_usu'] == ""){
        header("location:n_adm_msg.php");
        die;
    } else{
        if($_SESSION['adm'] != 1){
            header("location:n_adm_msg.php");
            die;
        } else{
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
            //Erros
            if(isset($_GET['titulo_publiErr']) && !empty($_GET['titulo_publiErr'])){
                $titulo_publiErr = $_GET['titulo_publirr'];
                $titulo_publi = "";
            }
            if(isset($_GET['text_publiErr']) && !empty($_GET['text_publiErr'])){
                $text_publiErr = $_GET['text_publiErr'];
                $text_publi = "";
            }
            require("../template/header_s_php.php");
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
                <form action="adm_alt_forum_controler.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="id_publi" value="<?php echo $id_publi?>" readonly>
                    <br><br>
                    <input type="text" name="id_usu" value="<?php echo $id_usu?>" readonly>
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