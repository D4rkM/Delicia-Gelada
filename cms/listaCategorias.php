<!DOCTYPE html>
<?php

  //Serve para ativar no PHP o uso das variáveis de SESSÃO (globais)
  // session_start();
  $nome = null;
  $ativo = null;
  // CONEXÃO COM BANCO DE dados
  //Estabelece a conexão com o banco
  require_once("include/conexao.php");
  $conn = conexao();

  include('include/login.php');
  //Declarando constantes --
  define('Campos_obg','Preencha todos os campos obrigatórios!.(*)');

  if(isset($_GET['modo'])){
    //pega conteudo da variavel modo
    $modo=$_GET['modo'];
    //verifica se a variavel modo é igual 'excluir'
    if ($modo=='excluir') {
      //Chama verificador em javascript

      //if($verificador != 1){
        //resgata o codigo passado na url
        $codigo=$_GET['codigo'];
        //Deleta no BD o registro
        $sql = "DELETE FROM tbl_categoria WHERE codigo =".$codigo;
        mysqli_query($conn, $sql);
        //Redireciona para a pagina inicial para apagar o GET da variavel
        //header('location:faleConosco.php');
    //  }

    }elseif ($modo=='visualizar') {

      //Variavel botao recebe editar
      $botao = "visualizar";

      $codigo=$_GET['codigo'];

      //Cria a variavel de sessão para o codigo de registro que será atualizado no UPDATE
      $_SESSION['cod_item']=$codigo;

      $sql = "SELECT * FROM tbl_categoria WHERE codigo = ".$codigo;

      $select = mysqli_query($conn, $sql);

      //Consulta para ver se o usuario está no banco
      if($rsConsulta = mysqli_fetch_array($select)){

        //REsgatando dados do banco e guardando em variaveis locais
        $codigo = $rs['codigo'];
        $nome = $rs['categoria'];
        $ativo = $rs['ativo'];

      }

      //Alterando página ativa quando clicado no radio
    }else if($modo == "ativar"){

      $codigo = $_GET['codigo'];

      $ativo = $_GET['ativo'];

        if($ativo){
          $sql = "UPDATE tbl_categoria
                  SET ativo = 0
                  WHERE codigo =".$codigo;
        }else{
          $sql = "UPDATE tbl_categoria
                  SET ativo = 1
                  WHERE codigo =".$codigo;
        }

        if(mysqli_query($conn, $sql)){
          echo("<script>alert('Atualizado com sucesso!');</script>");
        }else{
          echo("<script>alert('Não foi possível atualizar a categoria!');");
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
    <title>CMS - Lista de Produtos</title>
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
    			url: "modalCategoria.php",
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
      <div class="modal" >

      </div>
    </div>
    <div class="main">

      <?php include('include/cabecalho.php'); ?>
      <?php include('include/menu.php'); ?>
      <div class="subMenu">
        <a href="cadCategoria.php">
          <img src="#" alt="Adicionar">
        </a>
      </div>

      <div class="conteudoFaleConosco">
        <div class="faixaHorizontal">
          <div class="info">
            Nome da Categoria
          </div>
          <div class="info">
            Ativar/desativar
          </div>
          <div class="info">
            ver/excluir
          </div>
        </div>
        <form class="frmAtivarCategorias" action="listaCategorias.php" method="post">
        <?php
            $sql = "SELECT * FROM tbl_categoria;";
                    // echo($sql);
            $select = mysqli_query($conn, $sql);

            while ($rs = mysqli_fetch_array($select)) {
              $at = "";
              //Identificando página ativa
              if($rs['ativo']){
                $at = "ON";
              }else{
                $at = "OFF";
              }

              ?>
            <div class="faixaHorizontal">
              <!-- &nbsp; - tag de espaço do HTML -->

                <div class="valores2">
                  <p><?php echo($rs['categoria']); ?></p>
                </div>
                <div class="valores2">
                  <a href="listaCategorias.php?modo=ativar&ativo=<?php echo($rs['ativo']); ?>&codigo=<?php echo($rs['codigo']); ?>" >
                    <?php echo($at); ?>
                  </a>
                </div>


              <div class="valores2">
                <a class="ver" href="#" onclick="Modal(<?php echo($rs["codigo"]);?>)">

                  <img src="icones/Modify16.png" alt="Ver">

                </a>

                <a onclick="return confirm('Deseja realmente excluir esta página?');"
                 href="listaCategorias.php?modo=excluir&codigo=<?php echo($rs['codigo']); ?>" > |
                  <img src="icones/Delete16.png" alt="Excluir">
                </a>
              </div>
            </div>
        <?php } ?>
        </form>
      </div>
      <?php include('include/rodape.php'); ?>
    </div>
  </body>
</html>
