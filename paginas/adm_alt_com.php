<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<head>
    <title>Alterar Comentário (de uma publicação do fórum</title>
</head>
    <main>
        <div class="margem-lados">
        <center>
                <br><br>
                <h1>ALTERAR COMENTÁRIO</h1>
                <br>
                <h2>Implementação futura...</h2>
                <br><br>
            </center>
    </main>
<?php require("../template/footer.php");?>