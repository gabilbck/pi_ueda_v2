<?php require("../template/header.php");?>
<?php 
    if(!array_key_exists("id_usu",$_SESSION) || $_SESSION['id_usu'] == ""){
        header("location:n_adm_msg.php");
        die;
    } else{
        $id_publi = $_GET['id_publi'];
        $id_usu = $titulo_publi = $text_publi = $img_publi = $imgContent = "";
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
                    $sql = $pdo->prepare('SELECT nome_usu FROM usuario WHERE id_usu =?');
                    if($sql->execute(array($id_usu))){
                        $usuario = $sql->fetchAll(PDO::FETCH_ASSOC);
                        $nome_usu = $usuario[0]['nome_usu'];
                    }
                }
            }
        }
    }
?>
<head>
    <title><?php echo $titulo_publi?> | UEDA
    </title>
</head>
<body>
    <main>
        <div class="atencao">
            <center><h4>ATENÇÃO: Você NÃO poderá apagar NENHUMA publicação/comentário enviado no fórum do site!</h4></center>
        </div>
        <br><br>
        <div class="margem-lados">
            <center><h1 style="text-transform: uppercase;"><?php echo $titulo_publi?></h1></center>
            <br>
            <h3>Publicado por: @<?php echo $nome_usu ?></h3>
            <br>
            <p><?php echo $text_publi?></p>
            <br>
            <?php 
            if (!empty($imgContent)){ 
                echo '<img width="150" src="data:image/jpg;charset=utf8;base64,'.$imgContent.'"/>';
            }
            ?>
            <br><hr><br>
            <h2>Comentários</h2>
            <?php 
            // Mostrar comentários
            $sql = $pdo->prepare("SELECT * FROM `comentario` WHERE id_publi=?");
                if($sql->execute(array($_GET['id_publi']))){
                $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach($row as $key => $value){
                        $text_cmt = $value['text_cmt'];
                        $id_usu = $value['id_usu'];
                        $sql = $pdo->prepare('SELECT nome_usu FROM usuario WHERE id_usu =?');
                        if($sql->execute(array($id_usu))){
                            $usuario = $sql->fetchAll(PDO::FETCH_ASSOC);
                            $nome_usu = $usuario[0]['nome_usu'];
                        }
                        echo '<b>@'.$nome_usu.': </b>'.$text_cmt.'<br>';
                    }
                }
            $id_usu = $_SESSION['id_usu'];
            $id_publi = $value['id_publi'];
            $id_cmt = $text_cmt = "";
            $id_cmtErr = $text_cmtErr = $msgErr = "";
            ?>
            <form action="vizu_forum_controler.php" method="post">
                <br>
                <input type="hidden" name="id_publi" value="<?php echo $id_publi ?>">
                <input type="text" name="text_cmt" maxlength="200" placeholder="Deixe aqui seu comentário..." value="<?php echo $text_cmt ?>">
                <span class="obrigatorio"><?php echo $text_cmtErr ?></span>
                <br><br>
                <button type="submit" name="cadastro">ENVIAR</button>
            </form>
            <br><br>
            <?php if(isset($_GET['erro'])){
                echo $_GET['erro'];
                }
            ?>
        </div>
    </main>
<?php require("../template/footer.php");?>