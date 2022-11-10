<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<?php
    $cod_jogo = $nome_jogo = $desc_jogo = $image_jogo = $imgContent = $link_jogo = $msgErr = "";
    $cod_jogoErr = $nome_jogoErr = $desc_jogoErr = $image_jogoErr = $link_jogoErr = "";

    if(isset($_GET['nome_jogoErr'])){
        $nome_jogoErr = $_GET['nome_jogoErr'];
    }
    if(isset($_GET['desc_jogoErr'])){
        $desc_jogoErr = $_GET['desc_jogoErr'];
    }
    if(isset($_GET['image_jogoErr'])){
        $image_jogoErr = $_GET['image_jogoErr'];
    }
    if(isset($_GET['link_jogoErr'])){
        $link_jogoErr = $_GET['link_jogoErr'];
    }
?>
<head>
    <title>Cadastro de jogos | UEDA</title>
</head>
<div class="margem-lados">
            <center>
                <br><br>
                <h1>PUBLIQUE SEU JOGO</h1>
                <form method="post" enctype="multipart/form-data" action="cad_jogo_controler.php">
                    <div><br><br>
                        <input name="nome_jogo" maxlength="255" value="<?php echo $nome_jogo?>" type="text" placeholder="Nome do jogo">
                        <span class="obrigatorio"><?php  echo '<br>'.$nome_jogoErr ?></span>
                        <br><br>
                        <textarea name="desc_jogo" maxlength="1000" type="text" placeholder="Descrição do jogo (max 255 caracteres)"><?php echo $desc_jogo?></textarea>
                        <span class="obrigatorio"><?php  echo '<br>'.$desc_jogoErr ?></span>
                        <br>
                        <encurtador>Antes de mandar seu link encurte-o <a  class="obrigatorio" target="_blank" href="https://9h.fit/?gclid=EAIaIQobChMIqueOoebu-gIVAuFcCh2YegCVEAAYAiAAEgI0BvD_BwE">aqui!</encurtador></a>
                        <br>
                        <input name="link_jogo" maxlength="1000" value="<?php  echo $link_jogo?>" type="text" placeholder="Link do jogo">
                        <span class="obrigatorio"><?php  echo '<br>'.$link_jogoErr ?></span>
                        <br><br>
                        <div class="escolha-imagem">
                            <label for="file">Selecione uma imagem</label>
                            <input type="file" id='file' name="image"/><br> <br>
                            <span class="obrigatorio"><?php echo $image_jogoErr ?></span> <br>   
                        </div>
                        
                        <div class="final-cad">
                            <div class="final-cad-jogo">
                                <button type="submit" name="cadastro">Salvar</button>
                            </div>
                        </div>
                        <div class="clear"></div>    
                    </div>
                </form>
                <br><br>
            </center>
        </div>
<?php require("../template/footer.php");?>