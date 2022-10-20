<?php // PERMITIR CADASTRAR SEM UMA NOVA IMAGEM OU MANTER A MESMA JÁ CADASTRADA?>
<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<?php 
    $cod_jogo = $nome_jogo = $desc_jogo = $image_jogo = $link_jogo = $imgContent = "";
    $nome_jogoErr = $desc_jogoErr = $image_jogoErr = $link_jogoErr = $msgErr = "";

    if (isset($_GET['cod_jogo'])){
        $codigo = $_GET['cod_jogo'];
        $sql = $pdo->prepare('SELECT * FROM jogos WHERE cod_jogo =?');
        if ($sql->execute(array($codigo))){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($info as $key => $value){
                $cod_jogo = $value['cod_jogo'];
                $nome_jogo = $value['nome_jogo'];
                $desc_jogo = $value['desc_jogo'];
                $image_jogo = $value['image_jogo'];
                $link_jogo = $value['link_jogo'];
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

        if (!empty($_POST['nome_jogo'])){
            $nome_jogo = $_POST['nome_jogo'];
        } else {
            $nome_jogoErr = "Erro no nome do jogo";
        }
        if (!empty($_POST['desc_jogo'])){
            $desc_jogo = $_POST['desc_jogo'];
        } else {
            $desc_jogoErr = "Erro na descrição do jogo";
        }
        if (!empty($_POST['link_jogo'])){
            $link_jogo = $_POST['link_jogo'];
        } else {
            $link_jogoErr = "Erro no link do jogo";
        }

        if ($tem_arquivo){
            $sql = $pdo->prepare("UPDATE jogos SET nome_jogo=?, desc_jogo=?, link_jogo=?, image_jogo=? WHERE cod_jogo=?");
            if ($sql->execute(array($nome_jogo, $desc_jogo, $link_jogo, base64_encode($imgContent), $cod_jogo))){
                $msgErr = "Dados alterados com sucesso!";
                header('location: adm_lista_jogo.php');
            } else{
                $msgErr = "Dados não alterados.";
            }
        } else{
            $sql = $pdo->prepare("UPDATE jogos SET nome_jogo=?, desc_jogo=?, link_jogo=?, WHERE cod_jogo=?");
            if ($sql->execute(array($nome_jogo, $desc_jogo, $link_jogo, $cod_jogo))){
                $msgErr = "Dados alterados com sucesso!";
                header('location: adm_lista_jogo.php');
            } else{
                $msgErr = "Dados não alterados.";
            }
        }
        

    } else {
        $msgErr = "Desculpe, mas somente arquivos JPG, JPEG, PNG e GIF são permitidos";
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
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="cod_jogo" value="<?php echo $cod_jogo?>" readonly>
                    <span class="n-obrigatorio">*</span>
                    <br><br>
                    <input name="nome_jogo" value="<?php echo $nome_jogo?>" type="text" placeholder="Nome do jogo">
                    <span class="obrigatorio">* <?php echo '<br>'.$nome_jogoErr ?></span>
                    <br><br>
                    <input name="desc_jogo" value="<?php echo $desc_jogo?>" type="text" placeholder="Descrição do jogo">
                    <span class="obrigatorio">* <?php echo '<br>'.$desc_jogoErr ?></span>
                    <br><br>
                    <input name="link_jogo" value="<?php echo $link_jogo?>" type="text" placeholder="Link do jogo">
                    <span class="obrigatorio">* <?php echo '<br>'.$link_jogoErr ?></span>
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
                    <div class="botoes-alt">
                        <button type="submit" name="submit">ALTERAR</button>
                        <button><a class="link-branco" href="adm_lista_jogo.php">VOLTAR</a></button>
                    </div>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer.php");?>