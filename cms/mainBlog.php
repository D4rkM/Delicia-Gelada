<!DOCTYPE html>

<?php

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="css/cms.css">
    <title>CMS - Sistema de Gerenciamento do Site</title>
  </head>
  <body>
    <div class="main">
      <?php include('include/cabecalho.php'); ?>
      <?php include('include/menu.php'); ?>
      <div class="subMenu">
        <a href="main.php">
          <img src="#" alt="Retornar">
        </a>
      </div>
      <div class="conteudo">
        <div class="faixaVertical">
          <a href="listaImportancia.php">
          <div class="opcoes">
            <img src="img/conteudo.png" alt="opção">
            A importância do Suco
          </div>
          </a>
          <a href="listaModaVerao.php">
          <div class="opcoes">
            <img src="img/conteudo.png" alt="opção">
            A moda do Verão
          </div>
          </a>
        </div>
      </div>
      <?php include('include/rodape.php'); ?>
    </div>
  </body>
</html>
