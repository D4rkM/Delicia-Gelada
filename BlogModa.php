<!DOCTYPE html>
<?php

  $conn = mysqli_connect('localhost', 'root', 'bcd127', 'db_delicia_gelada');

  $sql = "SELECT * FROM tbl_modaVerao WHERE ativo =1;";

  $select = mysqli_query($conn, $sql);

  if($rs = mysqli_fetch_array($select)){
    $titulo = $rs['titulo'];
    $texto1 = $rs['texto1'];
    $texto2 = $rs['texto2'];
    $imagem = $rs['imagem'];

    $img = substr($imagem,strpos($imagem,'i'),80);

  }else{
    echo("Erro");
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

    <!-- Menu Superior -->
    <?php include "include/menu.php"; ?>

    <div class="main">
      <div class="conteudo">
        <div id="modaConteudo">
          <div class="modaFaixa1">
              <img src="cms/<?php echo($img); ?>" alt="">
          </div>
          <div class="modaFaixa2">
            <div class="modaTextos">
              <h1><?php echo($titulo); ?></h1>
              <p><?php echo($texto1); ?></p>
              <p><?php echo($texto2); ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include "include/rodape.php"; ?>
  </body>
</html>
