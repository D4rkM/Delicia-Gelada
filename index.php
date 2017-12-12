<!DOCTYPE html>
<?php
  require_once("cms/include/conexao.php");
  $conn = conexao();

  $sql = "";

  if(isset($_GET['subCat'])){
    $subCod = $_GET['subCat'];
    $sql = "SELECT * FROM tbl_produto WHERE codsubcategoria = '$subCod' AND ativo = 1";

  }else if(isset($_GET['btn_pesquisar'])){

    $pesquisa = $_GET['txt_pesquisa'];

    $trySql = "SELECT * FROM tbl_produto WHERE nome LIKE '%$pesquisa%' AND ativo = 1;";
    addslashes($trySql);
    $try = mysqli_query($conn, $trySql);
    if(mysqli_num_rows($try) <= 0){
      $sql = "SELECT * FROM tbl_produto WHERE descricao LIKE '%$pesquisa%' AND ativo = 1;";
    }else{
      $sql = $trySql;
    }

  } else {
    $sql = "SELECT * FROM tbl_produto WHERE ativo = 1 ORDER BY RAND();";
  }

?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Delícia Gelada</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/asdf.css">
    <script src="js/jquery11.js"></script>
    <script src="js/Jcycle.js"></script>
    <script src="js/configSlider.js">
    </script>
    <script>
      $(document).ready(function() {

        $(".ver").click(function() {
          $(".modalContainer").slideToggle(2000);
        //slideToggle
        //toggle
        //FadeIn
        });
      });

        function Modal(idIten){
          $.ajax({
            type: "POST",
            url: "modalProduto.php",
            data: {id:idIten},
            success: function(dados){
              $('.modal').html(dados);
            }
          });
        }
    </script>
  </head>
  <body>
    <div class="modalContainer">
      <div class="modal">
      </div>
    </div>

    <script src="menusuperior.js"></script>
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
            $Catsql = "SELECT * FROM tbl_categoria WHERE ativo = 1;";
            $select = mysqli_query($conn, $Catsql);
              while($rs = mysqli_fetch_array($select)){

            ?>
            <div class="categorias">
              <h3><?php echo($rs['categoria']); ?></h3>
              <div class="subCategoria">
                <ul class="">
                  <?php
                    $sqlProd = "SELECT * FROM tbl_subcategoria WHERE ativo = 1 AND codCategoria =".$rs['codigo'];

                    $prodSelect = mysqli_query($conn, $sqlProd);

                    while ($prodRs = mysqli_fetch_array($prodSelect)) {

                  ?>
                  <li><a href="index.php?subCat=<?php echo($prodRs['codigo']);?>"><?php echo($prodRs['nome']); ?></a></li>
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
          $execute = $sql;
          // echo($execute);
          $select = mysqli_query($conn,$execute);
          if(mysqli_num_rows($select) > 0){
            // $lstProdutos = list($);
            // while($rs = mysqli_fetch_assoc($select)){
            //   $lstProdutos [] = $rs;


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
                   <img src="cms/<?php echo($rs['foto'])?>" alt="Produto"/>
                </div>
                <div class="info">
                  <ul>
                    <li>Nome: <?php echo($rs['nome']);  ?></li>
                    <li>Descrição: <?php echo($rs['descricao']); ?></li>
                    <li>Preço: <?php echo($rs['preco'])?></li>
                  </ul>
                 </div>
                 <div class="detalhes">
                   <a href="#" class="ver" onclick="Modal(<?php echo($rs["codigo"]);?>)">Detalhes</a>
                 </div>
               </div>
               <?php }
               $a = 0;?>
             </div>
          <?php
            // }
          }else {
            ?> <h2>OPS!... Nenhum produto Encontrado</h2> <?php
          }
             ?>
        </div>
      </div>
      <!-- RODAPÉ (INFORMAÇÕES E LINKS) -->
      <?php include "include/rodape.php"; ?>
    </div>
  </body>
</html>
