<?php
    session_start();
    include "../include/MySql.php";
    include "../include/functions.php";

    $id_art = $titulo_art = $id_eti = $link_art = $resumo_art = $data_art = $img_art = $intro_art = $des_art = $con_art = $ref_art = "";
    $titulo_artErr = $id_etiErr = $resumo_artErr = $img_artErr = $intro_artErr = $des_artErr = $con_artErr = $ref_artErr ="";
   

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
        if (empty ($_POST['titulo_art'])){
            $titulo_artErr = "Nome do título é obrigatório!";
        } else {
            $titulo_art = test_input($_POST["titulo_art"]);
        }
        if (empty($_POST['resumo_art'])){
            $resumo_artErr = "Resumo é obrigatório!";
        } else {
            $resumo_art = test_input($_POST["resumo_art"]);
        }
        if (empty($_POST['intro_art'])){
            $intro_artErr = " Intridução é obrigatória!";
        } else {
            $intro_art = test_input($_POST["intro_art"]);
        }
        if (empty($_POST['des_art'])){
            $des_artErr = " Desenvolvimento é obrigatório!";
        } else {
            $des_art = test_input($_POST["des_art"]);
        }
        if (empty($_POST['con_art'])){
            $con_artErr = " Conclusão é obrigatório!";
        } else {
            $con_art = test_input($_POST["con_art"]);
        }
        if (empty($_POST['ref_art'])){
            $ref_artErr = " Referências é obrigatório!";
        } else {
            $ref_art = test_input($_POST["ref_art"]);
        }
        // falta a a etiqueta de arte
        // codgo da imagem

        
                    //Inserir dados
                    $sql = $pdo->prepare("INSERT INTO ARTIGO (id_art, titulo_art, id_eti, link_art, resumo_art, data_art, img_art, intro_art, des_art, con_art, ref_art)
                                        VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    if ($sql->execute(array($id_art,$titulo_art, $id_eti, $link_art, $resumo_art, $data_art, $img_art, $intro_art, $des_art, $con_art, $ref_art))){
                        $msgErr = "Dados cadastrados com sucesso!";
                        header("location: ../index.php");
                    } else {
                        $msgErr = "Dados não cadastrados!";
                    }
    }
?>
<head>
    <title>Publicar artigo| UEDA</title>
</head>
<?php require("../template/header_login.php");?>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>PUBLICAR ARTIGO</h1>
                <br>
                <form action="" method="post">
                    <input name="titulo_art" value="<?php echo $titulo_art?>" type="text" placeholder="Nome do Título">
                    <span class="obrigatorio">* <?php  echo '<br>'.$titulo_artErr ?></span>
                    <br><br>
                    <input name="resumo_art" value="<?php  echo $resumo_art?>" type="text" placeholder="Resumo do Texto">
                    <span class="obrigatorio">* <?php  echo '<br>'.$resumo_artErr ?></span>
                    <br><br>
                    <input name="intro_art" value="<?php  echo $intro_art?>" type="text" placeholder="Introdução do Texto">
                    <span class="obrigatorio">* <?php  echo '<br>'.$intro_artErr ?></span>
                    <br><br>
                    <input name="des_art" value="<?php  echo $des_art?>" type="text" placeholder="Desenvolvimento do Texto">
                    <span class="obrigatorio">* <?php  echo '<br>'.$des_artErr ?></span>
                    <br><br>
                    <input name="con_art" value="<?php  echo $con_art?>" type="text" placeholder="Conclusão do Texto">
                    <span class="obrigatorio">* <?php  echo '<br>'.$con_artErr ?></span>
                    <br><br>
                    <input name="ref_art" value="<?php  echo $ref_art?>" type="text" placeholder="Referências do Texto">
                    <span class="obrigatorio">* <?php  echo '<br>'.$ref_artErr ?></span>
                    <br><br>
                    <div class="clear"></div>
                    <br>
                    <button type="submit" name="cadastro">ENVIAR</button>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer2.php");?>