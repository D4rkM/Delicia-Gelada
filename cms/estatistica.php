<!DOCTYPE html>
<?php
  require_once("include/conexao.php");
  $conn = conexao();

  $corAnterior = 0;
  $cor = array( '#CFF', '#9FF', '#600', '#FF0', '#C69', '#0F0' );
  $max = count( $cor ) - 1;

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
        <div class="faixavertical">
          <h2>Produtos mais Visualizados</h2>
          <div id="grafico">
            <?php

            $sqlTotal = "SELECT SUM(qtdCliques) FROM tbl_produto;";
            $selectTotal = mysqli_query($conn, $sqlTotal);
            $totalCliques = "";
            if($rsCalc = mysqli_fetch_array($selectTotal)){
              $totalCliques = $rsCalc['SUM(qtdCliques)'];
            }

            $sql = "SELECT * FROM tbl_produto ORDER BY qtdCliques DESC";

            // echo $sql;
            $select= mysqli_query($conn, $sql);
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
              if($rs['qtdCliques'] > 0){
                $click = ($rs['qtdCliques'] * 100)/$totalCliques;
              }else{
                $click = 0;
              }
              $aleatorio = rand( $corAnterior?1:0, $max );
              if( $aleatorio >= $corAnterior ) $aleatorio++;
              $corAnterior = $aleatorio;

               echo($rs['nome']); ?>
              <div class="prodGraf" <?php echo ('style=" width:'.$click.'%;"'); ?>></div>

            <?php
              $cont++;
            }
            ?>
          </div>
        </div>
        <!-- submenus -->

      </div>
      <?php include('include/rodape.php'); ?>
    </div>
  </body>
</html>
