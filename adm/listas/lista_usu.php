<?php 
    include "../../include/MySql.php";
    include "../../include/functions.php";
    session_start();
?>
<head>
    <title>Listagem de Usuários</title>
</head>
<?php require("../../template/header3.php");?>
    <main>
        <style>
        tr:nth-child(even) {
            background:lightgray;
        }

        table{
            background: #f2f2f2;
        }
        </style>
        <table>
            <tr>
                <th>abc</th>
                <th>abc</th>
                <th>abc</th>
            </tr>
            <tr>
                <td>abc</td>
                <td>abc</td>
                <td>abc</td>
            </tr>
            <tr>
                <td>abc</td>
                <td>abc</td>
                <td>abc</td>
            </tr>
            <tr>
                <td>abc</td>
                <td>abc</td>
                <td>abc</td>
            </tr>

        </table>

    </main>
<?php require("../../template/footer3.php");?>