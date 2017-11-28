<!DOCTYPE html>
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
          <a href="listaCategorias.php">
            <div class="opcoes">
              <img src="img/conteudo.png" alt="opção">
              Categorias
            </div>
          </a>
          <a href="listaSubCategorias.php">
            <div class="opcoes">
              <img src="img/conteudo.png" alt="opção">
              SubCategorias
            </div>
          </a>
          <a href="listaProdutos.php">
            <div class="opcoes">
              <img src="img/conteudo.png" alt="opção">
              Produtos
            </div>
          </a>
        </div>

      </div>
      <?php include('include/rodape.php'); ?>
    </div>
  </body>
</html>
