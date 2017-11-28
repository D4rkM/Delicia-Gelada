<!DOCTYPE html>
<?php
//conexao com banco
  require_once("include/conexao.php");
  $conn = conexao();
  // verifica a opção selecinada

  if(isset($_GET['modo'])){
    $modo = $_GET['modo'];

    if($modo == "excluir"){

      $sql = "DELETE FROM tbl_NivelDeUsuario WHERE codNivel=".$_GET['codigo'];
      //deleta o arquivo
      if(mysqli_query($conn, $sql)){
        ?><script>alert("O nível foi deletado!");</script><?php
      }

    }
  }

?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="css/cms.css">
    <link rel="stylesheet" href="css/style.css">
    <title>CMS - Adm. Níveis</title>
    <script type="text/javascript" src="js/jquery.js"></script>
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
            url: "modalNivel.php",
            data: {id:idIten},
            success: function(dados){
              $('.modal').html(dados);
            }
          });
        }
    </script>
  </head>
  <body>
    <!-- JANELA MODAL -->
    <div class="modalContainer">
      <div class="modal">

      </div>
    </div>
    <div class="main">
      <!-- INCLUDES -->
      <?php include('include/cabecalho.php'); ?>
      <?php include('include/menu.php'); ?>
      <div class="subMenu">
        <a href="mainUsuario.php">
          <img src="#" alt="retornar">
        </a>
        <a href="cadNivel.php">
          <img src="#" alt="Adicionar">
        </a>
      </div>
      <div class="conteudoFaleConosco">
        <div class="faixaHorizontal">
          <div class="info">
            Nivel
          </div>
        </div>
        <?php
        //select do nivel de ususario
            $sql = "SELECT * FROM tbl_NivelDeUsuario;";

            $select = mysqli_query($conn, $sql);

            while ($rs = mysqli_fetch_array($select)) {

              ?>
            <div class="faixaHorizontal">
              <!-- &nbsp; - tag de espaço do HTML -->
              <div class="valores2">
                <p><?php echo($rs['nivel']); ?></p>
              </div>

              <div class="valores2">
                <a class="ver" href="#" onclick="Modal(<?php echo($rs["codNivel"]);?>)">

                <img src="icones/Modify16.png" alt="Ver">

                </a>

                <a onClick="return confirm('Deseja realmente este nível?');" href="admNivel.php?modo=excluir&codigo=<?php echo($rs['codNivel']); ?>" > |

                  <img src="icones/Delete16.png" alt="Excluir">

                </a>
              </div>
            </div>
        <?php } ?>

      </div>
      <?php include('include/rodape.php'); ?>
    </div>
  </body>
</html>
