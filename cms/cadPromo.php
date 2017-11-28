<!DOCTYPE html>

<?php

  require_once("include/conexao.php");
  $conn = conexao();

  if(isset($_POST['btnSalvar'])){

    $tituloPromocao = $_POST['txtTituloPromo'];
    $desconto = $_POST['txtPromo'];
    $descricao = $_POST['txtDescricao'];
    $promoCode =$_POST['txtPromoCode'];
    $produto = $_POST['selectProduto'];
    $ativado = $_POST['ckAtivar'];
		$ativado = $ativado == "" ? 0 : $ativado;
    if(isset($_POST['ckPromoMes'])){
      $promoMes = 1;

      $sql = "UPDATE tbl_promocao
      SET promoMes = 0;";

      mysqli_query($conn, $sql);

    }else{
      $promoMes = 0;
    }

    $sql = "INSERT INTO tbl_promocao(codProduto, tituloPromocao, desconto, ativo, promoCode, descricao, promoMes)
      VALUES ('$produto','$tituloPromocao','$desconto','$ativo','$promoCode','$descricao', '$promoMes');";

    if(mysqli_query($conn, $sql)){
      echo("<script>alert('Suco Cadastrado com Sucesso');</script>");
    }else{
      // echo($sql);
      echo("<script>alert('Erro ao cadastrar essa opção!');</script>");
      echo $sql;
    }

  }

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="css/cms.css">
    <title>CMS - Cadastro de Promoção</title>
  </head>
  <body>
    <div class="main">
      <?php include('include/cabecalho.php'); ?>
      <?php include('include/menu.php'); ?>
      <div class="subMenu">
        <a href="listaPromo.php">
          <img src="#" alt="Retornar">
        </a>
      </div>
      <form class="frmAddPromo" action="cadPromo.php" method="post">
        <div class="conteudo">
          <div id="editarUsuairo">
            Nome da Promo: <input type="text" name="txtTituloPromo" placeholder="Insira o nome do Produto." required><br>
            Descrição da Promo: <textarea name="txtDescricao" placeholder="Insira a descrição do produto" rows="1" cols="30" required maxlength="110"></textarea> <br>
            Desconto: <input type="text" name="txtPromo" placeholder="Insira o desconto que será aplicado na promoção" title="Insira apenas números" required><br>
            Código Promocional: <input type="text" name="txtPromoCode" placeholder="Insira caso seja nessecário" > <br>
            Produto:
            <select class="produto" name="selectProduto" required>
              <?php
                $newSql = "SELECT * from tbl_produto;";
                $select = mysqli_query($conn, $newSql);
                while($newRs = mysqli_fetch_array($select)){
              ?>
              <option value="<?php echo($newRs['codigo']); ?>"><?php echo($newRs['nome']); ?></option>
              <?php
                }  ?>
            </select> <br>
            <input type="checkbox" name="ckAtivar" value="ativar">Ativo <br>
            <input type="checkbox" name="ckPromoMes" value="promoMes">Promoção do Mês <br>
            <input type="submit" name="btnSalvar" value="Salvar">
          </div>
        </div>
      </form>
      <?php include('include/rodape.php'); ?>
    </div>
  </body>
</html>
