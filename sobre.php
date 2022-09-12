<?php
    session_start();
    include "include/MySql.php";
    include "include/functions.php";
?>
<head>
    <title>Sobre | UEDA</title>
</head>
<?php require("template/header1.php");?>
    <main>
        <br><br>
        <center>
            <h1 style=" font-weight: 100;" class="h1_título_topo">Projeto Integrador</h1>
        </center>
        <br><br>
        <div class="subtitulo-sobre">
            <h1 style=" font-weight: 100;">O que é?</h1>
        </div>
        <div class="sobre-txtprincipal">
            <h1 style=" font-weight: 100;">O Projeto Integrador (PI) é uma Unidade Curricular, baseada na metodologia de ação-reflexão-ação, que se constitui na proposição de situações desafiadoras a serem cumpridas pelo aluno.</h1>
        </div>
        <br><br>
        <center>
        <div class="titulo-img-sobre">
            <h1 style=" font-weight: 100;">Esta unidade curricular é obrigatória nos cursos de:</h1>
        </div>    
        </center>
        <br><br>

            <div class="container_images_sobre"> 
                <div class="imgs-sobre">
                    <img src="./images/sobre_img1.png" style="width:30%">
                    <p style="text-align: center; font-size: 20px;">Aprendizagem Comercial</p>
                </div>
                <div class="imgs-sobre">
                    <img src="./images/sobre_img2.png" style="width:30%">
                    <p style="text-align: center; font-size: 20px;">Qualificação Profissional</p>
                </div>
                <div class="imgs-sobre">
                    <img src="./images/sobre_img3.png" style="width:30%">
                    <p style="text-align: center; font-size: 20px;">Cursos Técnicos</p>
                </div>
            </div>
                

        <br><br><br><br><br>
        <div class="obj-sobre">
            <img style="width: 350px;" src="./images/slogan_azul.png" alt="">
            <h1 style=" font-weight: 100; font-size: 20px;">O planejamento e execução do Projeto Integrador propiciam a articulação das competências previstas no perfil profissional de conclusão do curso, pois apresenta ao aluno situações que estimulam o seu desenvolvimento profissional ao ter que decidir, opinar e debater com o grupo a resolução de problemas a partir do tema gerador, portanto, o aluno poderá demonstrar sua atuação profissional pautada pelas marcas formativas do Senac, uma vez que permite o trabalho em equipe e o exercício da ética, da responsabilidade social e da atitude empreendedora.</h1>
        </div>
        <div class="margem-lados">
        </div>
        <div class="div-developers">
        <img style="width: 50%;" src="./images/bg-developers.png" alt=""> <img style="width: 50%;" src="./images/bg-developers.png" alt="">            
        </div>

        <div class="desenvolvedores">
            <h1 style="font-weight: 100; font-size: 1.3rem">Adriano Ramos | Felipe Gabriel Schmitt | Gabrieli Eduarda Lembeck | Lucas Inacio Diomario Coelho | Nina Carolina Lima Barater</h1>
        </div>
    </main>
<?php require("template/footer1.php");?>