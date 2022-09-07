<?php
  include "../include/MySql.php";
  include "../include/functions.php";

  $nome_usu = $email_usu = $senha_usu = $nome_real_usu = $adm = "";
  $nome_usuErr = $email_usuErr = $senha_usuErr = $nome_real_usuErr = $admErr = $msgErr = "";

  if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
    if (empty($_POST['nome_usu'])){
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
    /*if (empty($_POST['administrador'])){
        $administrador = false;
    } else {
        $administrador = true;
    }*/

    if ($nome_usu && $email_usu && $senha_usu && $nome_real_usu){
      $sql = $pdo->prepare("SELECT * FROM usuario WHERE email_usu = ?");
      if ($sql->execute(array($email_usu))){
          if ($sql->rowCount() > 0){
              $msgErr = "E-mail já cadastrado";
          } else {
              //Inserir dados
              $sql = $pdo->prepare("INSERT INTO USUARIO (id_usu, nome_usu, email_usu, senha_usu, nome_real_usu, adm)
                                  VALUES (null, ?, ?, ?, ?, 0)");
              if ($sql->execute(array($nome_usu, $email_usu, MD5($senha_usu), $nome_real_usu))){
                  $msgErr = "Dados cadastrados com sucesso!";
                  header("location: ../index.php");
              } else {
                  $msgErr = "Dados não cadastrados!";
              }
          }   
      } else{
          $msgErr = "Erro no comando Select";
      }     
  } else {
      $msgErr = "Dados não informados!"; 
  }
}
?>
<head>
    <title>Cadastre-se | UEDA</title>
</head>
<?php require("template/header2.php");?>
    <main>
    </main>
<?php require("template/footer2.php");?>