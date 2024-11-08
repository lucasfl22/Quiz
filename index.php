<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="components/topo/styles.css">
    <link rel="stylesheet" href="temas/tecnologia/tecnologia.css">
    <link rel="stylesheet" href="components/conteudo/conteudo.css">
    <link rel="stylesheet" href="temas/tecnologia/php/css/style.css">
    <link rel="stylesheet" href="components/rodape/rodape.css">
    <title>Quiz</title>
</head>
<body>
<?php 

    include_once("components/topo/topo.php");

    if (empty($_SERVER["QUERY_STRING"])) {
        $var = "components/conteudo/conteudo.php";
        include_once("$var");
    } else {
        $pg = $_GET['pg'];
        include_once("$pg.php");
    }

    include_once("components/rodape/rodape.php");

?>