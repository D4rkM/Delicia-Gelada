<!DOCTYPE html>

<?php

  require_once("include/conexao.php");
  $conn = conexao();

  if(isset($_POST['btnSalvar'])){

    $nome = $_POST['txtSubCategoria'];
    $codCategoria = $_POST['selectCategoria'];
    $ativado = $_POST['ckAtivar'];
    $ativado = $ativado == "" ? 0 : $ativado;
    //Criando script de insert no banco
    $sql = "INSERT INTO tbl_subCategoria(nome, codCategoria, ativo)
      VALUES ('$nome','$codCategoria', '$ativo');";

    if(mysqli_query($conn, $sql)){
      echo("<script>alert('SubCategoria Cadastrada com Sucesso');</script>");
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
    <title>CMS - Cadastro de Categoria</title>
  </head>
  <body>
    <div class="main">
      <?php include('include/cabecalho.php'); ?>
      <?php include('include/menu.php'); ?>
      <form class="frmAddCategoria" action="cadSubCategoria.php" method="post">
        <div class="conteudo">
          <div id="cadItem">
            <table width="500" height="200" border="solid">
              <tr>
                <td>Nome da Categoria : <input type="text" name="txtSubCategoria" placeholder="'Refrecos'." required></td>
              </tr>
              <tr>
                <td>Categoria:
                <select class="categoria" name="selectCategoria" required>
                  <?php
                    $newSql = "SELECT * from tbl_categoria;";
                    $select = mysqli_query($conn, $newSql);
                    while($newRs = mysqli_fetch_array($select)){
                  ?>
                  <option value="<?php echo($newRs['codigo']); ?>"><?php echo($newRs['categoria']); ?></option>
                  <?php
                    }  ?>
                </select></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="ckAtivar" value="">Ativo <br></td>
              </tr>
              <tr>
                <td><input type="submit" name="btnSalvar" value="Salvar"></td>
              </tr>
            </table>
          </div>
        </div>
      </form>
      <?php include('include/rodape.php'); ?>
    </div>
  </body>
</html>
