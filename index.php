<!DOCTYPE html>
<?php
require_once("cms/include/conexao.php");
$conn = conexao();

?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Delícia Gelada</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/asdf.css">
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
        <div class="imagemSlide">
          <img src="cms/img/produto/28f4e638fbcacc4dcf40a55c12a218d0.jpg" alt="imagem">
        </div>
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
            $select = mysqli_query($conn, $sql);
              while($rs = mysqli_fetch_array($select)){

            ?>
            <div class="categorias">
              <h3><?php echo($rs['categoria']); ?></h3>
              <div class="subCategoria">
                <ul class="">
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
            // $lstProdutos = list($);
            // while($rs = mysqli_fetch_assoc($select)){
            //   $lstProdutos [] = $rs;
            // }

            $i = 0;
            $a = 0;
            $faixas = mysqli_num_rows($select) / 3;

            // while ($i < $faixas && $rs = mysqli_fetch_array($select)) {
              # code...
              $i = $i + 1;
             ?>
             <div class="faixa_produto">
               <?php
               //Carregando produtos para o site
               while ($rs = mysqli_fetch_array($select)) {
                //  if($a >= 2){
                 //
                //   break;
                //  }
                // var_dump($lstProdutos);
                 $a = $a + 1;
               ?>

               <div class="produto">
                 <div class="img_produto">
                  <a href="#"><img src="cms/<?php echo($rs['foto'])?>" alt="Produto"/></a>
                </div>
                <div class="info">
                  <ul>
                    <li>Nome: <?php echo($rs['nome']);  ?></li>
                    <li>Descrição: <?php echo($rs['descricao']); ?></li>
                    <li>Preço: <?php echo($rs['preco'])?></li>
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
            // }
          }
             ?>
        </div>
      </div>
      <!-- RODAPÉ (INFORMAÇÕES E LINKS) -->
      <?php include "include/rodape.php"; ?>
    </div>
  </body>
</html>
