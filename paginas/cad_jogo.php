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


    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
        if (empty ($_POST['nome_jogo'])){
            $nome_jogoErr = "Nome do jogo é obrigatório!";
        } else {
            $nome_jogo = test_input($_POST["nome_jogo"]);
        }
        if (empty($_POST['desc_jogo'])){
            $desc_jogoErr = "Descrição é obrigatório!";
        } else {
            $desc_jogo = test_input($_POST["desc_jogo"]);
        }
        if (empty($_POST['link_jogo'])){
            $link_jogoErr = "Link é obrigatório!";
        } else {
            $link_jogo = test_input($_POST["link_jogo"]);
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
            } else {
                $msgErr = "Desculpe, mas somente arquivos JPG, JPEG, PNG e GIF são permitidos";
            }
        } else{
            $image_jogoErr = "Não foi enviada a imagem";
        }
        //Inserir dados
        if ($nome_jogo && $desc_jogo && $link_jogo && $imgContent){
            $sql = $pdo->prepare("INSERT INTO jogos (cod_jogo, nome_jogo, desc_jogo, link_jogo, image_jogo)
                            VALUES (null, ?,?,?,?)");
            if ($sql->execute(array($nome_jogo, $desc_jogo, $link_jogo, base64_encode($imgContent)))){
                $msgErr = "Dados cadastrados com sucesso!";
                header("location: menu_jogos.php");
            } else {
                $msgErr = "Dados não cadastrados!";
            }
        } else {
            $msgErr = "Algum erro";
        }
    } else {
        $msgErr = "Informações incorretas";
    }
?>
<head>
    <title>Cadastro de jogos | UEDA</title>
</head>
<div class="margem-lados">
            <center>
                <br><br>
                <h1>PUBLIQUE SEU JOGO</h1>
                <form method="post" enctype="multipart/form-data">
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