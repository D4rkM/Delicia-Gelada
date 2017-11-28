<!DOCTYPE html>
<?php


  require_once("cms/include/conexao.php");
  $conn = conexao();


  $sql = "SELECT promo.*, prod.foto
  FROM tbl_promocao AS promo
  INNER JOIN tbl_produto AS prod
  ON promo.codProduto = prod.codigo
  WHERE promo.promoMes = 1 AND promo.ativo = 1;";

  $select = mysqli_query($conn, $sql);

  // if(){
    $rs = mysqli_fetch_array($select);
  // }else{
    // header('location:index.php');
  // }
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
      <div class="sucoMesPromo">
        <div class="imagemCentral">
          <img src="cms/<?php echo($rs['foto']);?>" alt="foto">
        </div>
        <div class="textoPrimario">
          <h3><?php echo($rs['tituloPromocao']); ?></h3>
          <p><?php echo("descricao"); ?></p>
        </div>
      </div>
      <!-- CONTEUDO -->
      <?php include "include/rodape.php"; ?>
    </div>
  </body>
</html>
