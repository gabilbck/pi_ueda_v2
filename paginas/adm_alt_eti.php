<?php 
    include "../include/MySql.php";
    include "../include/functions.php";
    session_start();

    $id_eti = $nome_eti = "";
    $id_etiErr = $nome_etiErr = $msgErr = "";

    if (isset($_GET['id_eti'])){
        $id_eti = $_GET['id_eti'];
        $sql = $pdo->prepare('SELECT * FROM etiqueta_art WHERE id_eti =?');
        if ($sql->execute(array($id_eti))){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($info as $key => $value){
                $id_eti = $value['id_eti'];
                $nome_eti = $value['nome_eti'];
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
        if (isset($_POST['id_eti'])){
            $id_eti = $_POST['id_eti'];
        } 
        if (empty($_POST['nome_eti'])){
            $nome_etiErr = "Nome é obrigatório!";
        } else {
            $nome_eti = test_input($_POST["nome_eti"]);
        }
    
        //Verificar se existe um usuario
        if ($nome_eti){
            $sql = $pdo->prepare("SELECT * FROM etiqueta_art WHERE nome_eti = ? AND id_eti <> ?");
            if ($sql->execute(array($nome_eti, $id_eti))){
                if ($sql->rowCount() > 0){
                    $msgErr = "Nome já cadastrado para outra etiqueta";
                } else {
                    $sql = $pdo->prepare("UPDATE etiqueta_art SET nome_eti=? WHERE id_eti=?");
                    if ($sql->execute(array($nome_eti, $id_eti))){
                        $msgErr = "Dados alterados com sucesso!";
                        header('location: adm_lista_eti.php');
                    } else{
                        $msgErr = "dados não alterados.";
                    }
                }
            }
        } else {
            $msgErr = "Dados não informados!"; 
        }
    }                    
?>
<head>
    <title>Alterar Informações do Usuário</title>
</head>
<?php require("../template/header.php");?>
    <main>
    <div class="margem-lados">
            <center>
                <br><br>
                <h1>CADASTRE-SE</h1>
                <br>
                <form action="" method="post">
                    <input type="text" name="id_usu" value="<?php echo $id_eti?>" readonly>
                    <span class="n-obrigatorio">*</span>
                    <br><br>
                    <input name="nome_real_usu" value="<?php echo $nome_eti?>" type="text" placeholder="Nome Completo">
                    <span class="obrigatorio">* <?php  echo '<br>'.$nome_etiErr ?></span>
                    <br><br>
                    <div class="botoes-alt">
                        <button type="submit" name="cadastro">ALTERAR</button>
                        <button><a class="link-branco" href="adm_lista_eti.php">VOLTAR</a></button>
                    </div>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer.php");?>