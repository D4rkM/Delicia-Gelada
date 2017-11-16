<!DOCTYPE html>
<?php
  $conn = mysqli_connect("localhost","root","bcd127","db_delicia_gelada");


 ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Delícia Gelada</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/master.css">
    <script src="js/jquery11.js" type="text/javascript"></script>
    <script src="js/Jcycle.js" type="text/javascript"></script>
    <script src="js/configSlider.js" type="text/javascript">
    </script>
  </head>
  <body>
    <script type="text/javascript" src="menusuperior.js"></script>
    <?php include "include/menu.php"; ?>
    <div class="main">
      <header>
        <?php include("include/slider.php") ?>
      </header>
      <!-- CONTEUDO -->
      <div class="conteudo">
        <?php include "include/redesSociais.php" ?>
        <!-- MENU LATERAL -->
        <div id="menu_lateral">
          <nav>
            <h2>Categorias</h2>
            <?php
            // Lógica para passar dados do banco para o site SIMULAÇÃO
            $sql = "SELECT * FROM tbl_categoria WHERE ativo = 1;";
            $select  = mysqli_query($conn, $sql);
              while($rs = mysqli_fetch_array($select)){

            ?>
            <div class="categorias">
              <h3><?php echo($rs['categoria']); ?></h3>
                <ul>
                  <?php
                    $sqlProd = "SELECT * FROM tbl_subCategoria WHERE ativo = 1 AND codCategoria =".$rs['codigo'];

                    $prodSelect = mysqli_query($conn, $sqlProd);

                    while ($prodRs = mysqli_fetch_array($prodSelect)) {

                  ?>
                  <li><a href="#"><?php echo($prodRs['nome']); ?></a></li>
                  <?php
                    }
                  ?>
                </ul>
            </div>
            <?php
            }
            ?>
          </nav>
        </div>
        <!-- PRODUTOS -->
        <div id="conteudo">
          <?php
          //lógica para passar produtos para o site
          $sql = "SELECT * FROM tbl_produto WHERE ativo = 1 ORDER BY RAND();";

          $select = mysqli_query($conn,$sql);
          if(mysqli_num_rows($select) > 0){
            $lstProdutos = array();
            while($rs = mysqli_fetch_assoc($select)){
              $lstProdutos [] = $rs;
            }

            $i = 0;
            $a = 0;
            while ($i < mysqli_num_rows($select)) {
              # code...
              $i = $i + 1;
             ?>
             <div class="faixa_produto">
               <?php
               while () {
                 if($a >= 2){

                  break;
                 }
                 $a = $a + 1;
               ?>
               <div class="imgProduto">

               </div>
               <div class="produto">
                 <div class="img_produto">
                  <a href="#"><img src="img/promo.jpeg" alt="Produto"/></a>
                </div>
                <div class="info">
                  <ul>
                    <li>Nome: <?php echo("Suco");  ?></li>
                    <li>Descrição: <?php echo("Bebida gelada"); ?></li>
                    <li>Preço: <?php echo("$$$")?></li>
                  </ul>
                 </div>
                 <div class="detalhes">
                   <a href="#">Detalhes</a>
                 </div>
               </div>
               <?php }
               $a = 0;?>
             </div>
          <?php
            }
          }
             ?>
        </div>
      </div>
      <!-- RODAPÉ (INFORMAÇÕES E LINKS) -->
      <?php include "include/rodape.php"; ?>
    </div>
  </body>
</html>
