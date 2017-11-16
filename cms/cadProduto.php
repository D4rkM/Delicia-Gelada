<!DOCTYPE html>

<?php

  $conexao = mysqli_connect('localhost','root','bcd127','db_delicia_gelada');

  if(isset($_POST['btnSalvar'])){

    $nome = $_POST['txtProduto'];
    $preco = $_POST['txtPreco'];
    $descricao = $_POST['txtDescricao'];
    $subCategoria = $_POST['selectSubCategoria'];
    //ativa ou mantem desativado o produto
    if(isset($_POST['ckAtivo'])){
      $ativo = $_POST['ckAtivo'];
    }else{
      $ativo = 0;
    }

    $upload_dir = "img/produto/";
    $nome_arq = basename($_FILES['fotoImp']['name']);

    //Verificando se a extensão é permitida
    if(strstr($nome_arq,'.jpg') || strstr($nome_arq,'.png') || strstr($nome_arq,'.jpeg')){
      $extensao = substr($nome_arq, strpos($nome_arq,"."), 5);
      $prefixo = substr($nome_arq, 0, strpos($nome_arq,"."));
      $nome_arq = md5($prefixo).$extensao;

      //Guardamos o caminho e o nome da imagem que será inserida no BD.
      $upload_file = $upload_dir . $nome_arq;

      if (move_uploaded_file($_FILES['fotoImp']['tmp_name'], $upload_file)){

        $sql = "INSERT INTO tbl_produto(nome, preco, descricao, codSubCategoria, ativo, foto)
          VALUES ('$nome','$preco','$descricao','$subCategoria','$ativo','$upload_file');";

        if(mysqli_query($conexao, $sql)){
          echo("<script>alert('Suco Cadastrado com Sucesso');</script>");
        }else{
          // echo($sql);
          echo("<script>alert('Erro ao cadastrar essa opção!');</script>");
          echo $sql;
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

                    $select = mysqli_query($conexao, $sql);

                    while($rs = mysqli_fetch_array($select)){
                   ?>
                  <optgroup label="<?php echo($rs['categoria']); ?>">
                    <?php
                      $newSql = "SELECT * FROM tbl_subCategoria WHERE ativo = 1 AND codCategoria =".$rs['codigo'];

                      $subSelect = mysqli_query($conexao, $newSql);

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
                <td><input type="checkbox" name="ckAtivo" value="1">Ativo <br></td>
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
