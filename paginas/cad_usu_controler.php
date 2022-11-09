<?php
    session_start();
    include_once "../include/MySql.php";
    include_once "../include/functions.php";
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
        if (empty ($_POST['nome_usu'])){
            $nome_usuErr = "Nome Completo é obrigatório!";
        } else {
            $nome_usu = test_input($_POST["nome_usu"]);
        }
        if (empty($_POST['email_usu'])){
            $email_usuErr = "E-mail é obrigatório!";
        } else {
            $email_usu = test_input($_POST["email_usu"]);
        }
        if (empty($_POST['senha_usu'])){
            $senha_usuErr = "Senha é obrigatória!";
        } else {
            $senha_usu = test_input($_POST["senha_usu"]);
        }
        if (empty($_POST['nome_real_usu'])){
            $nome_real_usuErr = "Nome de Usuário é obrigatório!";
        } else {
            $nome_real_usu = test_input($_POST["nome_real_usu"]);
        }

        if ($nome_usu && $email_usu && $senha_usu && $nome_real_usu){
            $sql = $pdo->prepare("SELECT * FROM usuario WHERE email_usu = ? OR nome_usu = ? LIMIT 1");
            if ($sql->execute(array($email_usu, $nome_usu))){
                if ($sql->rowCount() > 0){
                    $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
                    if($dados[0]['nome_usu'] == $nome_usu){
                        $nome_usuErr = "Nome de usuário já cadastrado";
                    }
                    if($dados[0]['email_usu'] == $email_usu){
                        $email_usuErr = "E-mail já cadastrado";
                    }
                } else {
                    //Inserir dados
                    $sql = $pdo->prepare("INSERT INTO USUARIO (id_usu, nome_usu, email_usu, senha_usu, nome_real_usu, adm)
                                        VALUES (null, ?, ?, ?, ?, 0)");
                    if ($sql->execute(array($nome_usu, $email_usu, MD5($senha_usu), $nome_real_usu))){
                        $msgErr = "Dados cadastrados com sucesso!";
                        header("location: sus_cad_usu.php");
                    } else {
                        $msgErr = "Dados não cadastrados!";
                        header('location:cad_usu.php?msgErr='.$msgErr);
                    }
                }   
            } else{
                $msgErr = "Já Existe Usuário!";
                header('location:cad_usu.php?msgErr='.$msgErr);
            }     
        } else {
            $msgErr = "Dados não informados!"; 
            header('location:cad_usu.php?nome_usuErr='.$nome_usuErr.'&email_usuErr='.$email_usuErr.'&senha_usuErr='.$senha_usuErr.'&nome_real_usuErr='.$nome_real_usuErr);
        }
    } else{
        header("Location:n_adm_msg.php");
    }
?>