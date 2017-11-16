<!DOCTYPE html>
<?php

  $conn = mysqli_connect('localhost', 'root', 'bcd127', 'db_delicia_gelada');

  $sql = "SELECT * FROM tbl_importanciaSuco WHERE ativo = 1;";

  $select = mysqli_query($conn, $sql);

  if($select){
    if($rs = mysqli_fetch_array($select)){
      $titulo = $rs['titulo'];
      $txt1 = $rs['texto1'];
      $txt2 = $rs['texto2'];
      $txt3 = $rs['texto3'];
      $txt4 = $rs['texto4'];
      $subTitulo =$rs['subtitulo'];
      $subTexto = $rs['subtexto'];
      $imagem = $rs['imagem'];

      $img = substr($imagem,strpos($imagem,'i'),80);

  } else{
    header('location:index.php');
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
      <div class="conteudo">

        <div id="modaConteudo">
          <div class="modaFaixa1">
            <div class="textoPrimario">
              <h1><?php echo($titulo); ?></h1>
              <p><?php echo($txt1); ?></p>
            </div>
            <div class="modaTextos">
              <div class="textos">
                <p><?php echo($txt2); ?></p>
              </div>
              <div class="textos">
                <p><?php echo($txt3); ?></p>
              </div>
              <div class="textos">
                <p><?php echo($txt4); ?></p>
              </div>
            </div>
          </div>
          <div class="modaFaixa2">
            <div class="textoSecundario">
              <h3><?php echo($subTitulo); ?></h3>
              <p><?php echo($subTexto); ?></p>
            </div>
            <div id="moda_img">
              <img src="cms/<?php echo($img); ?>" alt="Imagem">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- RODAPÉ (INFORMAÇÕES E LINKS) -->
    <?php include "include/rodape.php"; ?>
  </body>
</html>
