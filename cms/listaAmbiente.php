<!DOCTYPE html>

<?php
  require_once("include/conexao.php");
  $conn = conexao();

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="css/cms.css">
    <title>CMS - Importância do Suco Natural</title>
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
      //Função para executar o Modal
    	function Modal(idIten){
    		$.ajax({
    			type: "POST",
    			url: "modalAmbiente.php",
    			data: {id:idIten},
    			success: function(dados){
    				$('.modal').html(dados);
    			}
    		});
    	}
    </script>
  </head>
  <body>

    <div class="main">
      <?php include('include/cabecalho.php'); ?>
      <?php include('include/menu.php'); ?>
      <!-- JANELA MODAL -->
      <div class="modalContainer">
        <div class="modal" >

        </div>
      </div>
      <!-- Submenu de opçoes -->
      <div class="subMenu">
        <a href="main.php">
          <img src="#" alt="Retornar">
        </a>
        <a href="cadAmbiente.php">
          <img src="#" alt="Adicionar">
        </a>
      </div>
      <div class="conteudoFaleConosco">
        <div class="faixaHorizontal">
          <div class="info">
            Nome
          </div>
          <div class="info">
            Usuário
          </div>
          <div class="info">
            Nível
          </div>
          <div class="info">
            Ativado/Desativado
          </div>
          <div class="alt">
            Editar/Excluir
          </div>
        </div>
        <?php
            $sql = "SELECT * FROM tbl_ambiente;";

            $select = mysqli_query($conn, $sql);

            while ($rs = mysqli_fetch_array($select)) {

              ?>
            <div class="faixaHorizontal">
              <!-- &nbsp; - tag de espaço do HTML -->
              <div class="valores2">
                <p><?php echo($rs['nomeLocal']); ?></p>
              </div>
              <div class="valores2">
                <p><?php echo($rs['nomeProprietario']); ?></p>
              </div>
              <div class="valores2">
                <p><?php echo($rs['descLocal']); ?></p>
              </div>

              <div class="valores2">
                <a class="ver" href="#" onclick="Modal(<?php echo($rs["codigo"]);?>)">

                <img src="icones/Modify16.png" alt="Ver">

                </a>

                <a onClick="return confirm('Deseja realmente excluir esse local?');" href="listaAmbiente.php?modo=excluir&codigo=<?php echo($rs['codigo']); ?>" > |

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
