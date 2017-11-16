<!DOCTYPE html>
<?php
  //Serve para ativar no PHP o uso das variáveis de SESSÃO (globais)
  // session_start();
  $nome = null;
  $user = null;
  $nivel = null;

  $botao = "Salvar";

  // CONEXÃO COM BANCO DE dados
  //Estabelece a conexão com o banco
  $conexao = mysqli_connect("localhost","root","bcd127", "db_delicia_gelada");
  include('include/login.php');
  //Declarando constantes --
  define('Campos_obg','Preencha todos os campos obrigatórios!.(*)');

  if(isset($_GET['modo'])){
    //pega conteudo da variavel modo
    $modo=$_GET['modo'];
    //verifica se a variavel modo é igual 'excluir'
    if ($modo=='excluir') {

      //resgata o codigo passado na url
      $codigo=$_GET['codigo'];
      //Deleta no BD o registro
      $sql = "DELETE FROM tbl_Usuario WHERE codUsuario =".$codigo;
      mysqli_query($conexao, $sql);
      //Redireciona para a pagina inicial pa ra apagar o GET da variavel
      header('location:admUsuario.php');

    }elseif ($modo == 'visualizar') {

      //Variavel botao recebe editar
      $botao = "visualizar";

      $codigo=$_GET['codigo'];

      //Cria a variavel de sessão para o codigo de registro que será atualizado no UPDATE
      $_SESSION['cod_item'] = $codigo;

      $sql = "SELECT u.nome, u.user, n.nivel FROM tbl_Usuario AS u
      INNER JOIN tbl_NivelDeUsuario as n
      ON u.codNivel = n.codNivel
      WHERE u.codUsuario = ".$codigo;

      $select = mysqli_query($conexao, $sql);

      //Consulta para ver se o usuario está no banco
      if($rsConsulta = mysqli_fetch_array($select)){

        //REsgatando dados do banco e guardando em variaveis locais
        $nome = $rsConsulta['nome'];
        $celular = $rsConsulta['user'];
        $email = $rsConsulta['nivel'];

      }

    }else if($modo == "ativar"){
      $atDt = $_GET['atDt'];
      $codUser = $_GET['codigo'];

      if($atDt == "Ativar"){
        $sql = "UPDATE tbl_Usuario
                SET ativo = 1
                WHERE codUsuario =".$codUser;

        if(mysqli_query($conexao, $sql)){
          echo("foi pra 1");
        }else{
          echo("não foi pra 1");
          echo($sql);
        }
        header('location:admUsuario.php');
      }else if($atDt == "Desativar"){
        $sql = "UPDATE tbl_Usuario
                SET ativo = 0
                WHERE codUsuario =".$codUser;

        if(mysqli_query($conexao, $sql)){
          echo("foi pra 0");
        }else{
          echo("não foi pra 0");
          echo($sql);
      }
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

        function Modal(idIten){
          $.ajax({
            type: "POST",
            url: "modalUsuario.php",
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
      <div class="subMenu">
        <a href="mainUsuario.php">
          <img src="#" alt="retornar">
        </a>
        <a href="cadUsuario.php">
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
            $sql = "SELECT u.codUsuario, u.nome, u.user, u.ativo, n.nivel FROM tbl_Usuario AS u
            INNER JOIN tbl_NivelDeUsuario as n
            ON u.codNivel = n.codNivel
            ORDER BY n.codNivel;";

            $select = mysqli_query($conexao, $sql);

            while ($rs = mysqli_fetch_array($select)) {
              $at = "";
              //verificando usuario ativo
              if($rs['ativo']){
                $at = "Desativar";
              }else{
                $at = "Ativar";
              }

              ?>
            <div class="faixaHorizontal">
              <!-- &nbsp; - tag de espaço do HTML -->
              <div class="valores2">
                <p><?php echo($rs['nome']); ?></p>
              </div>
              <div class="valores2">
                <p><?php echo($rs['user']); ?></p>
              </div>
              <div class="valores2">
                <p><?php echo($rs['nivel']); ?></p>
              </div>
              <div class="valores2">
                <a href="admUsuario.php?modo=ativar&codigo=<?php echo($rs['codUsuario']); ?>&atDt=<?php echo($at); ?>" >
                  <?php echo($at); ?>
                </a>
              </div>

              <div class="valores2">
                <a class="ver" href="#" onclick="Modal(<?php echo($rs["codUsuario"]);?>)">

                <img src="icones/Modify16.png" alt="Ver">

                </a>

                <a onClick="return confirm('Deseja realmente excluir o usuário <?php echo($rs['nome']);?>?');" href="admUsuario.php?modo=excluir&codigo=<?php echo($rs['codUsuario']); ?>" > |

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
