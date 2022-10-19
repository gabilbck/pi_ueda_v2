<?php require("../template/header.php");?>
<?php 
    if(!array_key_exists("id_usu",$_SESSION) || $_SESSION['id_usu'] == ""){
        header("location:n_adm_msg.php");
        die;
    }
?>
<?php
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
?>
<head>
    <title><?php echo $titulo_publi?> | UEDA
    </title>
</head>
<body>
    <br><br>
    <main>
        <div class="margem-lados">
            <center><h1 style="text-transform: uppercase;"><?php echo $titulo_publi?></h1></center>
            <br>
            <b>@<?php echo $id_usu //$nome_usu?></b>
            <br><br>
            <p><?php echo $text_publi?></p>
            <br>
            <?php 
            if (!empty($imgContent)){ 
                echo '<img width="150" src="data:image/jpg;charset=utf8;base64,'.$imgContent.'"/>';
            }
            ?>
            <br>
            <hr>
            <br><br><br>
            <h2>Comentários</h2>
            <?php 
            // NADA FUNCIONA
            $sql = $pdo->prepare("SELECT * FROM `comentario`");
                if($sql->execute()){
                $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach($row as $key => $value){
                        $text_cmt = $text_cmt['text_cmt'];
                        $id_usu = $id_usu['id_usu'];

                        echo '<p>'.$text_cmt['text_cmt'].'</p>';
                    }
                }
            ?>

            <?php
            // comentario não funciona
            $id_usu = $_SESSION['id_usu'];
            $id_publi = $value['id_publi'];
            $id_cmt = $text_cmt = "";
            $id_cmtErr = $text_cmtErr = $msgErr = "";
        
            if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
        
                if (empty($_POST['text_cmt'])){
                    $text_cmtErr = "Você não pode fazer um comentário vazio!";
                } else {
                    $text_cmt = test_input($_POST["text_cmt"]);
                }
                
                //Inserir dados
                if ($text_cmt){
                    $sql = $pdo->prepare("INSERT INTO comentario (id_cmt, text_cmt, id_usu, id_publi)
                                    VALUES (null, ?, ?, ?)");
                    if ($sql->execute(array($id_cmt, $text_cmt, $id_usu, $id_publi))){
                        $msgErr = "Mensagem não enviada!";
                        header("location: vizu_forum.php?id_publi=$id_publi");
                    } else {
                        $msgErr = "Dados não cadastrados!";
                    }
                } else{
                    $msgErr = "Dados faltando!";
                }
            } else {
                $msgErr = "Dados não informados!"; 
            }
            ?>
            <form action="" method="post">
                <input type="text" name="text_cmt" placeholder="Deixe aqui seu comentário..." value="<?php echo $text_cmt ?>">
                <span class="obrigatorio"><?php echo $text_cmtErr ?></span>
                <br><br>
                <button type="submit" name="cadastro">ENVIAR</button>
            </form>
            <br><br>
        </div>
    </main>
<?php require("../template/footer.php");?>