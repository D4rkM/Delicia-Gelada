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
      <div class="conteudo">
        <div class="faixaVertical">
          <div class="opcoes">
            <img src="img/conteudo.png" alt="opção">
            Home
          </div>
          <div class="opcoes">
            <img src="img/conteudo.png" alt="opção">
            Promocoes
          </div>
          <div class="opcoes">
            <img src="img/conteudo.png" alt="opção">
            Suco do Mês
          </div>
          <div class="opcoes">
            <img src="img/conteudo.png" alt="opção">
            Ambientes
          </div>
        </div>
        <div class="faixaVertical">
          <a href="importanciaSuco.php">
            <div class="opcoes">
              <img src="img/conteudo.png" alt="opção">
              importancia do suco
            </div>
          </a>
        </div>
      </div>
      <?php include('include/rodape.php'); ?>
    </div>
  </body>
</html>
