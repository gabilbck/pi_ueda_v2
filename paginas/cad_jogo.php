<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<?php
    $msgErro = "";
    $nome_jogo = $desc_jogo = $link_jogo = "";

    if (isset($_POST["submit"])){
        if (!empty($_FILES["image_jogo"]["name"])){
            //Pegar informações
            $fileName = basename($_FILES["image_jogo"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            //Permitir somente alguns formatos
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

            if (in_array($fileType, $allowTypes)){
                $image_jogo = $_FILES['image_jogo']['tmp_name'];
                $imgContent = file_get_contents($image_jogo);

                if (isset($_POST['nome_jogo'])){
                    $nome_jogo = $_POST['nome_jogo'];
                } else {
                    $nome_jogo = "";
                }
                if (isset($_POST['desc_jogo'])){
                    $desc_jogo = $_POST['desc_jogo'];
                } else {
                    $desc_jogo = "";
                }
                if (isset($_POST['link_jogo'])){
                    $link_jogo = $_POST['link_jogo'];
                } else {
                    $link_jogo = "";
                }

                //Gravar no banco
                $sql = $pdo->prepare("INSERT INTO jogos (cod_jogo, nome_jogo, desc_jogo, link_jogo, image_jogo)
                                      VALUES (null, ?,?,?,?)");
                if ($sql->execute(array($nome_jogo, $desc_jogo, $link_jogo, base64_encode($imgContent)))){
                    $msgErro = "Dados cadastrados com sucesso!";
                    header('location: menu_jogos.php');
                } else {
                    $msgErro = "Dados não cadastrados!";
                }

            } else {
                $msgErro = "Desculpe, mas somente arquivos JPG, JPEG, PNG e GIF são permitidos";
            }
        } else {
            $msgErro = "Selecione uma imagem para upload";
        }
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
                        <span class="obrigatorio">* <?php  echo '<br>'.$msgErro ?></span>
                        <br><br>
                        <textarea name="desc_jogo" maxlength="1000" value="<?php  echo $desc_jogo?>" type="text" placeholder="Descrição do jogo (max 255 caracteres)"></textarea>
                        <span class="obrigatorio">* <?php  echo '<br>'.$msgErro ?></span>
                        <br>
                        <encurtador>Antes de mandar seu link encurte-o <a  class="obrigatorio" target="_blank" href="https://9h.fit/?gclid=EAIaIQobChMIqueOoebu-gIVAuFcCh2YegCVEAAYAiAAEgI0BvD_BwE">aqui!</encurtador></a>
                        <br>
                        <input name="link_jogo" maxlength="1000" value="<?php  echo $link_jogo?>" type="text" placeholder="Link do jogo">
                        <span class="obrigatorio">* <?php  echo '<br>'.$msgErro ?></span>
                        <br><br>
                        <div class="escolha-imagem">
                            <label for="file">Selecione uma imagem</label>
                            <input type="file" id='file' name="image_jogo"/><br> <br>
                            <span class="obrigatorio">* <?php echo $msgErro ?></span> <br>   
                        </div>
                        
                        <div class="final-cad">
                            <div class="final-cad-jogo">
                                <button type="submit" name="submit">Salvar</button>
                            </div>
                        </div>
                        <div class="clear"></div>    
                    </div>
                </form>
                <br>
            </center>
        </div>
<?php require("../template/footer.php");?>