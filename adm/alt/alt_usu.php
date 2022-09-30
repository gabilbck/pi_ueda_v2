<?php 
    include "../../include/MySql.php";
    include "../../include/functions.php";
    session_start();

    $nome_usu = $email_usu = $senha_usu = $nome_real_usu = $adm = "";
    $nome_usuErr = $email_usuErr = $senha_usuErr = $nome_real_usuErr = $admErr = $msgErr = "";

    /*
    if (isset($_GET['id_usu'])){
        $id_usu = $_GET['id_usu'];
        $sql = $pdo->prepare('SELECT * FROM produto WHERE id_usu =?');
        if ($sql->execute(array($id_usu))){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($info as $key => $value){
                $codigo = $value['codigo'];
                $nome = $value['nome'];
                $descricao = $value['descricao'];
                $valor = $value['valor'];
                $imgContent = $value['imagem'];
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
            } else {
                $msgErr = "Desculpe, mas somente arquivos JPG, JPEG, PNG e GIF são permitidos";
            }
        } 
            
        if (isset($_POST['nome'])){
            $nome = $_POST['nome'];
        } else {
            $nomeErr = "Nome não informado";
        }
        if (isset($_POST['descricao'])){
            $descricao = $_POST['descricao'];
        } else {
            $descricaoErr = "Descrição não informada";
        }
        if (isset($_POST['valor'])){
            $valor = $_POST['valor'];
        } else {
            $valorErr = "Valor não informado";
        }

        //Gravar no banco
        if ($nome && $descricao && $valor && $imgContent){
            $sql = $pdo->prepare("UPDATE produto SET nome=?, descricao=?, valor=?, imagem=? WHERE codigo=?");
            if ($sql->execute(array($nome, $descricao, $valor, $imgContent, $codigo))){
                $msgErr = "Dados alterados com sucesso!";
                    header('location: listProduto.php');
            } else{
                $msgErr = "dados não alterados."; 
            }
        } else {
            $msgErr = "Informações incorretas, não preenchidas ou já cadastradas.<br>Caso persista o erro, tente enviar a imagem novamente.";
        }    
    }*/
?>
<head>
    <title>Alterar Informações do Usuário</title>
</head>
<?php require("../../template/header3.php");?>
    <main>

    </main>
<?php require("../../template/footer3.php");?>