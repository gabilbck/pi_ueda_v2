<?php
    session_start();
    include_once "../include/MySql.php";
    include_once "../include/functions.php";
?>
<?php
    $email_bug = $desc_bug = $cod_bug =  "";
    $email_bugErr = $desc_bugErr = $msgErr = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
        if (empty($_POST['email_bug'])){
            $email_bugErr = "O E-mail é obrigatório!";
        } else {
            $email_bug = test_input($_POST["email_bug"]);
        }
        if (empty($_POST['desc_bug'])){
            $desc_bugErr = "Você não pode enviar um texto vazio!";
        } else {
            $desc_bug = test_input($_POST["desc_bug"]);
        }

        //Verificar se o usuário existe
        if ($email_bug && $desc_bug) {
                    //Inserir no banco de dados
            $sql = $pdo->prepare("INSERT INTO bug (cod_bug, email_bug, desc_bug)
                                VALUES (null, ?, ?)");
            if ($sql->execute(array($email_bug, $desc_bug))){
                $msgErr = "Erro reportado com sucesso!";  
                header('location:home.php');
            } else {
                $msgErr = "Erro não reportado!";
                header('location:bug.php?email_bugErr='.$email_bugErr.'&desc_bugErr='.$desc_bugErr);
            }
        }else {
            $msgErr = "Erro no comando Select";
            header('location:bug.php?email_bugErr='.$email_bugErr.'&desc_bugErr='.$desc_bugErr);
        }
    } else{
        header("Location:n_adm_msg.php");
    }
?>