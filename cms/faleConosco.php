<!DOCTYPE html>
<?php

  //Serve para ativar no PHP o uso das variáveis de SESSÃO (globais)
  // session_start();

  $nome = null;
  $telefone = null;
  $celular = null;
  $email = null;
  $sexo = null;
  $profissao = null;
  $sugestao = null;
  $informacao = null;
  $botao = "Salvar";
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
        $sql = "DELETE FROM tbl_faleconosco WHERE codFaleConosco =".$codigo;
        mysqli_query($conn, $sql);
        //Redireciona para a pagina inicial para apagar o GET da variavel
        //header('location:faleConosco.php');
    //  }

    }elseif ($modo=='visualizar') {

      //Variavel botao recebe editar
      $botao = "visualizar";

      $codigo=$_GET['codFaleConosco'];

      //Cria a variavel de sessão para o codigo de registro que será atualizado no UPDATE
      $_SESSION['cod_item']=$codigo;

      $sql = "SELECT * FROM tbl_faleconosco WHERE codFaleConosco = ".$codigo;

      $select = mysqli_query($conn, $sql);

      //Consulta para ver se o usuario está no banco
      if($rsConsulta = mysqli_fetch_array($select)){

        //REsgatando dados do banco e guardando em variaveis locais
        $nome = $rsConsulta['nome'];
        $celular = $rsConsulta['celular'];
        $email = $rsConsulta['email'];
        $sexo = $rsConsulta['sexo'];
        $profissao = $rsConsulta['profissao'];
        $sugestao = $rsConsulta['desc_sugestao'];
        $informacao = $rsConsulta['desc_informacao'];

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
    <title>CMS - Fale Conosco</title>
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
    			url: "modalFaleConosco.php",
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

      <?php include('include/cabecalho.php'); ?>
      <?php include('include/menu.php'); ?>

      <div class="conteudoFaleConosco">
        <div class="faixaHorizontal">
          <div class="info">
            Nome
          </div>
          <div class="info">
            Email
          </div>
          <div class="info">
            Celular
          </div>
          <div class="info">
            Sexo
          </div>
          <div class="info">
            Profissao
          </div>
          <div class="alt">
            Ver/Excluir
          </div>
        </div>
        <?php
            $sql = "SELECT * FROM tbl_faleconosco ORDER BY codFaleConosco;";

            $select = mysqli_query($conn, $sql);

            while ($rs = mysqli_fetch_array($select)) {

              ?>
            <div class="faixaHorizontal">
              <!-- &nbsp; - tag de espaço do HTML -->
              <div class="valores2">
                <p><?php echo($rs['nome']); ?></p>
              </div>
              <div class="valores2">
                <p><?php echo($rs['email']); ?></p>
              </div>
              <div class="valores2">
                <p><?php echo($rs['celular']); ?></p>
              </div>
              <div class="valores2">
                <p><?php echo($rs['sexo']); ?></p>
              </div>
              <div class="valores2">
                <p><?php echo($rs['profissao']); ?></p>
              </div>
              <div class="valores2">
                <a class="ver" href="#" onclick="Modal(<?php echo($rs["codFaleConosco"]);?>)">

                <img src="icones/Modify16.png" alt="Ver">

                </a>

                <a onclick="return confirm('Deseja realmente excluir o comentario de <?php echo($rs['nome']);?>?');"
                 href="faleConosco.php?modo=excluir&codigo=<?php echo($rs['codFaleConosco']); ?>" > |

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
