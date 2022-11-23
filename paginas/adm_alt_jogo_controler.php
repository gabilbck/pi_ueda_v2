<?php
    //Altera porém não aparece os spans
    session_start();
    include_once "../include/MySql.php";
    include_once "../include/functions.php";
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    } else{
        $cod_jogo = $nome_jogo = $desc_jogo = $image_jogo = $link_jogo = $imgContent = "";
        $nome_jogoErr = $desc_jogoErr = $image_jogoErr = $link_jogoErr = $msgErr = "";

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
            if (isset($_POST['cod_jogo'])){
                $cod_jogo = $_POST['cod_jogo'];
            } 
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
            } else{
                $image_jogoErr = "A imagem não foi selecionada!";
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
                    $cod_jogo = $_POST['cod_jogo'];
                    $msgErr = "Dados não alterados.";
                    header('location: adm_alt_jogo.php?cod_jogo='.$cod_jogo.'&nome_jogoErr='.$nome_jogoErr.'&desc_jogoErr='.$desc_jogoErr.'&link_jogoErr='.$link_jogoErr.'&image_jogoErr='.$image_jogoErr);
                }
            } else{
                $sql = $pdo->prepare("UPDATE jogos SET nome_jogo=?, desc_jogo=?, link_jogo=? WHERE cod_jogo=?");
                if ($nome_jogo && $desc_jogo && $link_jogo && $cod_jogo){
                        if ($sql->execute(array($nome_jogo, $desc_jogo, $link_jogo, $cod_jogo))){
                        $msgErr = "Dados alterados com sucesso!";
                        header('location: adm_lista_jogo.php');
                    } 
                } else{
                    $cod_jogo = $_POST['cod_jogo'];
                    $msgErr = "Dados não alterados.";
                    header('location: adm_alt_jogo.php?cod_jogo='.$cod_jogo.'&nome_jogoErr='.$nome_jogoErr.'&desc_jogoErr='.$desc_jogoErr.'&link_jogoErr='.$link_jogoErr.'&image_jogoErr='.$image_jogoErr);
                }
            }
        } else {
            header('location: n_adm_msg.php');
        }
    }
?>