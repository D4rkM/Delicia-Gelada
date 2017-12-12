<!DOCTYPE html>

<?php

  require_once("include/conexao.php");
  $conn = conexao();
  require_once("include/salvarImagem.php");

  if(isset($_POST['btnSalvar'])){

    $nome = $_POST['txtProduto'];
    $preco = $_POST['txtPreco'];
    $descricao = $_POST['txtDescricao'];
    $subCategoria = $_POST['selectSubCategoria'];
    //ativa ou mantem desativado o produto
    $ativado = $_POST['ckAtivar'];
		$ativado = $ativado == "" ? 0 : $ativado;

    $nome_arq = basename($_FILES['fotoImp']['name']);
    $foto = salvarImagem($nome_arq);

    $sql = "INSERT INTO tbl_produto(nome, preco, descricao, codSubCategoria, ativo, foto,qtdCliques)
      VALUES ('$nome','$preco','$descricao','$subCategoria','$ativo','$foto', 0);";

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
    <title>CMS - Cadastro de produto</title>
  </head>
  <body>
    <div class="main">
      <?php include('include/cabecalho.php'); ?>
      <?php include('include/menu.php'); ?>
      <form class="frmAddCategoria" action="cadProduto.php" enctype="multipart/form-data" method="post">
        <div class="conteudo">
          <div id="cadItem">
            <table width="500" height="200" border="solid">
              <tr>
                <td>Nome : <input type="text" name="txtProduto" placeholder="Insira o nome do Produto." required></td>
              </tr>
              <tr>
                <td>Descrição: <textarea name="txtDescricao" placeholder="Insira a descrição do produto" rows="1" cols="30" required maxlength="110"></textarea></td>
              </tr>
              <tr>
                <td>Preço: <input type="text" name="txtPreco" placeholder="Insira o preço original do produto" title="Insira apenas números" required></td>
              </tr>
              <tr>
                <td>Sub-Categoria:
                <select class="subCategoria" name="selectSubCategoria" required>
                  <?php
                    $sql ="SELECT * FROM tbl_categoria WHERE ativo = 1;";

                    $select = mysqli_query($conn, $sql);

                    while($rs = mysqli_fetch_array($select)){
                   ?>
                  <optgroup label="<?php echo($rs['categoria']); ?>">
                    <?php
                      $newSql = "SELECT * FROM tbl_subCategoria WHERE ativo = 1 AND codCategoria =".$rs['codigo'];

                      $subSelect = mysqli_query($conn, $newSql);

                      while($newRs = mysqli_fetch_array($subSelect)){
                    ?>
                    <option value="<?php echo($newRs['codigo']); ?>"><?php echo($newRs['nome']); ?></option>
                    <?php
                        }  ?>
                  </optgroup>
                <?php } ?>
                </select></td>
              </tr>
              <tr>
                <td>Foto: <input type="file" name="fotoImp" required></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="ckAtivar" value="1">Ativo <br></td>
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
