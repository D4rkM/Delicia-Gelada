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
      <!-- Include dos menus -->
      <?php include('include/cabecalho.php'); ?>
      <?php include('include/menu.php'); ?>
      <div class="conteudo">
        <!-- submenus -->
        <div class="faixaVertical">
          <a href="#">
            <div class="opcoes">
              <img src="img/conteudo.png" alt="opção">
              Home
            </div>
          </a>
          <a href="mainBlog.php">
            <div class="opcoes">
              <img src="img/conteudo.png" alt="opção">
              Blog
            </div>
          </a>
          <a href="listaPromo.php">
            <div class="opcoes">
              <img src="img/conteudo.png" alt="opção">
              Promoções
            </div>
          </a>
          <a href="listaAmbiente.php">
            <div class="opcoes">
              <img src="img/conteudo.png" alt="opção">
              Ambientes
            </div>
          </a>

        </div>

        <div class="faixaVertical">
          <a href="#">
            <div class="opcoes">
              <img src="img/conteudo.png" alt="opção">
              Slider
            </div>
          </a>
          <a href="#">
            <div class="opcoes">
              <img src="img/conteudo.png" alt="opção">
              Redes Sociais
            </div>
          </a>
          <a href="#">
            <div class="opcoes">
              <img src="img/conteudo.png" alt="opção">
              Rodapé
            </div>
          </a>

        </div>

      </div>
      <?php include('include/rodape.php'); ?>
    </div>
  </body>
</html>
