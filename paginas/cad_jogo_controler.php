<?php
    session_start();
    include_once "../include/MySql.php";
    include_once "../include/functions.php";
?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    } else{
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
                    header('location:cad_jogo.php?msgErr'.$msgErr);
                }
            } else {
                $msgErr = "Algum erro";
                header('location:cad_jogo.php?nome_jogoErr='.$nome_jogoErr.'&desc_jogoErr='.$desc_jogoErr.'&link_jogoErr='.$link_jogoErr.'&image_jogoErr='.$image_jogoErr);
            }
        } else {
            header("Location:n_adm_msg.php");
        }
    }
?>
