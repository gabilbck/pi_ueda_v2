<?php
    session_start();
    include_once "../include/MySql.php";
    include_once "../include/functions.php";
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    } else{
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
            if (isset($_POST['id_usu'])){
                $id_usu = $_POST['id_usu'];
            } 
            if (empty($_POST['nome_usu'])){
                $nome_usuErr = "Nome é obrigatório!";
            } else {
                $nome_usu = test_input($_POST["nome_usu"]);
            }
            if (empty($_POST['email_usu'])){
                $email_usuErr = "Email é obrigatório!";
            } else {
                $email_usu = test_input($_POST["email_usu"]);
            }
            $senha_usu = test_input($_POST["senha_usu"]);
            if (empty($_POST['nome_real_usu'])){
                $nome_real_usuErr = "Telefone é obrigatório!";
            } else {
                $nome_real_usu = test_input($_POST["nome_real_usu"]);
            }
            if (empty($_POST['adm'])){
                $adm = false;
            } else {
                $adm = true;
            }

            //Verificar se existe um usuario
            if ($email_usu && $nome_usu && $nome_real_usu){
                $sql = $pdo->prepare("SELECT * FROM usuario WHERE email_usu = ? AND id_usu <> ?");
                if ($sql->execute(array($email_usu, $id_usu))){
                    if ($sql->rowCount() > 0){
                        $msgErr = "E-mail já cadastrado para outro usuário";
                    } else {
                        $sql = $pdo->prepare("UPDATE usuario SET nome_usu=?, email_usu=?, nome_real_usu=?, adm=? WHERE id_usu=?");
                        if ($sql->execute(array($nome_usu, $email_usu, $nome_real_usu, $adm, $id_usu))){
                            if(!empty($senha_usu)){
                                $sql = $pdo->prepare("UPDATE usuario SET senha_usu=? WHERE id_usu=?");
                                $sql->execute(array(md5($senha_usu), $id_usu));
                            }
                            $msgErr = "Dados alterados com sucesso!";
                            header('location: adm_lista_usu.php');
                        } else{
                            $msgErr = "dados não alterados.";
                            header('location: adm_lista_usu.php?msgErr='.$msgErr);
                        }
                    }
                } else{
                    header('location: adm_lista_usu.php?email_usuErr='.$email_usuErr.'&nome_usuErr='.$nome_usuErr.'&nome_real_usuErr='.$nome_real_usuErr);
                }
            } else {
                $msgErr = "Dados não informados!";
                header('location: adm_lista_usu.php?email_usuErr='.$email_usuErr.'&nome_usuErr='.$nome_usuErr.'&nome_real_usuErr='.$nome_real_usuErr);
            }
        } else{
            header('location: n_adm_msg.php');
        }  
    }
?>