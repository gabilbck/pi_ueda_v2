<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<?php 
    $cod_Jogo = $nome_jogo = $desc_jogo = $image_jogo = $link_jogo = $imgContent = "";
    $nome_jogoErr = $desc_jogoErr = $image_jogoErr = $link_jogoErr = $msgErr = "";

    if (isset($_GET['cod_Jogo'])){
        $codigo = $_GET['cod_Jogo'];
        $sql = $pdo->prepare('SELECT * FROM jogos WHERE cod_Jogo = ?');
        if ($sql->execute(array($codigo))){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($info as $key => $value){
                $cod_Jogo = $value['cod_Jogo'];
                $nome_jogo = $value['nome_jogo'];
                $desc_jogo = $value['desc_jogo'];
                $image_jogo = $value['image_jogo'];
                $link_jogo = $value['link_jogo'];
            }
        }
    }

    if (isset($_POST["submit"])){
        if (!empty($_FILES["image"]["name"])){
            //Pegar informações
            $fileName = basename($_FILES["image"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            //Permitir somente alguns formatos
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

            if (in_array($fileType, $allowTypes)){
                $image = $_FILES['image']['tmp_name'];
                $imgContent = file_get_contents($image);

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

                $sql = $pdo->prepare("UPDATE jogos SET nome_jogo=?, desc_jogo=?, link_jogo=?, image_jogo=? WHERE cod_Jogo=?");
                if ($sql->execute(array($nome_jogo, $desc_jogo, $link_jogo, base64_encode($imgContent)))){
                   $msgErr = "Dados alterados com sucesso!";
                    header('location: adm_lista_jogo.php');
                } else{
                    $msgErr = "Dados não alterados.";
                    
                }

           } else {
               $msgErr = "Desculpe, mas somente arquivos JPG, JPEG, PNG e GIF são permitidos";
           }
       } else {
           $msgErr = "Informações incorretas";
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
                <h1>ALTERAR</h1>
                <br>
                <form action="" method="post">
                    <input type="text" name="cod_Jogo" value="<?php echo $cod_Jogo?>" readonly>
                    <span class="n-obrigatorio">*</span>
                    <br><br>
                    <input name="nome_jogo" value="<?php echo $nome_jogo?>" type="text" placeholder="Nome do jogo">
                    <span class="obrigatorio">*</span>
                    <br><br>
                    <input name="desc_jogo" value="<?php echo $desc_jogo?>" type="text" placeholder="Descrição do jogo">
                    <span class="obrigatorio">*</span>
                    <br><br>
                    <input name="link_jogo" value="<?php echo $link_jogo?>" type="text" placeholder="Link do jogo">
                    <span class="obrigatorio">*</span>
                    <br><br>
                    <label for="imagem">Imagem: </label>
                    <input type="file" name="imagem" value="<?php echo $imagem?>"/><br><br>
                    <div class="botoes-alt">
                        <button type="submit" name="cadastro">ALTERAR</button>
                        <button><a class="link-branco" href="adm_lista_eti.php">VOLTAR</a></button>
                    </div>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer.php");?>

