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
            $cod_jogo = $nome_jogo = $desc_jogo = $image_jogo = $link_jogo = $imgContent = "";
            $nome_jogoErr = $desc_jogoErr = $image_jogoErr = $link_jogoErr = $msgErr = "";
        
            if (isset($_GET['cod_jogo'])){
                $cod_jogo = $_GET['cod_jogo'];
                $sql = $pdo->prepare('SELECT * FROM jogos WHERE cod_jogo =?');
                if ($sql->execute(array($cod_jogo))){
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach($info as $key => $value){
                        $cod_jogo = $value['cod_jogo'];
                        $nome_jogo = $value['nome_jogo'];
                        $desc_jogo = $value['desc_jogo'];
                        $imgContent = $value['image_jogo'];
                        $link_jogo = $value['link_jogo'];
                    }
                }
            }

            if(isset($_GET['nome_jogoErr']) && !empty($_GET['nome_jogoErr'])){
                $nome_jogoErr = $_GET['nome_jogoErr'];
                $nome_jogo = "";
            }
            if(isset($_GET['desc_jogoErr']) && !empty($_GET['desc_jogoErr'])){
                $desc_jogoErr = $_GET['desc_jogoErr'];
                $desc_jogo = "";
            }
            if(isset($_GET['image_jogoErr']) && !empty($_GET['image_jogoErr'])){
                $image_jogoErr = $_GET['image_jogoErr'];
                $imgContent = "";
            }
            if(isset($_GET['link_jogoErr']) && !empty($_GET['link_jogoErr'])){
                $link_jogoErr = $_GET['link_jogoErr'];
                $link_jogo = "";
            }
            require("../template/header_s_php.php");
        }
    }
?>
<head>
    <title>Alterar Informações do Jogo</title>
</head>
    <main>
    <div class="margem-lados">
            <center>
                <br><br>
                <h1>ALTERAR JOGO</h1>
                <br>
                <form action="adm_alt_jogo_controler.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="cod_jogo" value="<?php echo $cod_jogo?>" readonly>
                    <span class="obrigatorio"></span>
                    <br><br>
                    <input name="nome_jogo" maxlength="255" value="<?php echo $nome_jogo?>" type="text" placeholder="Nome do jogo">
                    <span class="obrigatorio"><?php echo '<br>'.$nome_jogoErr ?></span>
                    <br><br>
                    <input name="desc_jogo" maxlength="1000" value="<?php echo $desc_jogo?>" type="text" placeholder="Descrição do jogo">
                    <span class="obrigatorio"><?php echo '<br>'.$desc_jogoErr ?></span>
                    <br><br>
                    <input name="link_jogo" maxlength="1000" value="<?php echo $link_jogo?>" type="text" placeholder="Link do jogo">
                    <span class="obrigatorio"><?php echo '<br>'.$link_jogoErr ?></span>
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
                        <label for="image">Selecione uma imagem</label>
                        <input type="file" id='image' name="image"/><br><br>
                        <span class="obrigatorio"><?php echo '<br>'.$image_jogoErr ?></span><br>
                    </div>
                    <div class="botoes-alt">
                        <button><a class="link-branco" href="adm_lista_jogo.php">VOLTAR</a></button>
                        <button type="submit" name="submit">ALTERAR</button>
                    </div>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer.php");?>