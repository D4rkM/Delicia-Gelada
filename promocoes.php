<!DOCTYPE html>
<?php
  $conn = mysqli_connect("localhost","root","bcd127","db_delicia_gelada");

?>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Delícia Gelada</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/master.css">
    <script src="js/jquery11.js" type="text/javascript"></script>
    <script src="js/Jcycle.js" type="text/javascript"></script>
  </head>
  <body>
    <!-- MENU SUPERIOR -->
    <?php include 'include/menu.php'; ?>
    <!-- SLIDER -->
    <div class="main">

      <header>
        <?php include "include/slider.php"; ?>
      </header>
      <!-- CONTEUDO -->
      <!-- Redes Sociais -->
      <div class="conteudo">
        <?php include "include/redesSociais.php" ?>
      <div class="promoConteudo">
        <h1>Aproveite nossas ultimas e fresquinhas promoções!!</h1>
        <?php
          $sql = "SELECT prod.*, promo.* FROM tbl_promocao AS promo
                  INNER JOIN tbl_produto AS prod
                  ON prod.codigo = promo.codProduto
                  WHERE promo.ativo=1";

          $select = mysqli_query($conn, $sql);

          while($rs = mysqli_fetch_array($select)){
          ?>
        <div class="ambConteudoFaixas">
          <div class="amb_Descricao">
              <h2><?php echo($rs['tituloPromocao']); ?></h2>
              <p><?php echo($rs['descricao']); ?></p>
          </div>
          <div class="amb_imagem">
            <img src="cms/<?php echo($rs['foto']); ?>" width="110"
            height="110" alt="img">
          </div>
        </div>
        <?php } ?>
      </div>
      </div>
    </div>
    <?php include "include/rodape.php"; ?>
  </body>
</html>
