<!DOCTYPE html>
<?php
  $map = null;
  $imgBackupMaps = null;
  $linkMaps = null;

  $conexao = mysqli_connect('localhost','root','bcd127','db_delicia_gelada');

//https://www.google.com/maps/d/embed?mid=1CYzUlr3su03f58pHZX1M_GOCPug

  $sql = "SELECT * FROM tbl_ambiente;";

  $select = mysqli_query($conexao, $sql);

    if ($rs = mysqli_fetch_array($select)){
      $linkMaps = $rs['linkMaps'];
      if (!$sock = @fsockopen($map, 8080, $num, $error, 5)){
        $map = "não foi possivel se conectar com o maps";
        }else{
        $map  = '<iframe src="'.$linkMaps.'" width="1200" height="480"></iframe>';
        return $map;
      }
    }


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
    <?php include "include/menu.php"; ?>
    <!-- SLIDER -->
    <div class="main">
        <!-- CONTEUDO -->
        <div class="conteudo">

          <!-- Espaço de ambientes -->
          <div class="ambConteudo">
            <div class="amb_imagem">
              <?php echo($map); ?>
            </div>
              <div class="amb_Descricao">
                  <!-- <h2>Sede da Empresa</h2>
                  <p>Proprietário - Sr. Woody WoodPecker </p>
                  <p>Cidade Praia Infernal - Av. Buz Buzzard, nº 666.</p> -->
                  <h2><?php echo($rs['nomeLocal']); ?></h2>
                  <p>Proprietário - <?php echo($rs['nomeProprietario']); ?></p>
                  <p><?php echo($rs['descLocal']); ?></p>
              </div>

          </div>


      </div>
    </div>
    <?php include "include/rodape.php"; ?>
  </body>
</html>
