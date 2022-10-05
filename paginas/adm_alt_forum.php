<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<head>
    <title>Alterar Publicação do Fórum</title>
</head>
    <main>

    </main>
<?php require("../template/footer.php");?>