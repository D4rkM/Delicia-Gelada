<!DOCTYPE html>

<?php

$nomeLocal = null;
$nomeProprietario = null;
$descLocal = null;
$linkMaps = null;

  $conn = mysqli_connect('localhost','root','bcd127','db_delicia_gelada');

  if(isset($_POST['btnSalvar'])){

    $nomeLocal = $_POST['txtLogradouro'];
    $nomeProprietario = $_POST['txtProprietario'];
    $descLocal = $_POST['txtDesc'];
    $linkMaps = $_POST['linkMaps'];


    $sql="INSERT INTO tbl_ambiente
    (nomeLocal, nomeProprietario, descLocal, linkMaps)
    VALUES('$nomeLocal','$nomeProprietario','$descLocal','$linkMaps');";

    if(mysqli_query($conn, $sql)){
      header('location:cadAmbiente.php');

      echo("Arquivo movido com sucesso");
    }else{
      echo("Erro ao tentar enviar dados para o banco\n" .$sql);
    }



  }

  //Verificando se a extensão é permitida
  function guardarFotos($nome_arq){

    $upload_dir = "../img/BkpMap/";

    if(strstr($nome_arq,'.jpg') || strstr($nome_arq,'.png')){

      $extensao = substr($nome_arq, strpos($nome_arq,"."), 5);
      $prefixo = substr($nome_arq, 0, strpos($nome_arq,"."));
      $nome_arq = md5($prefixo).$extensao;

      //Guardamos o caminho e o nome da imagem que será inserida no BD.
      $upload_file = $upload_dir . $nome_arq;

      //move_uploaded_file($_FILES['$nameFile']['tmp_name'], $upload_file);

      return $upload_file;
    }else{
      return "Extensão Inválida";
    }
  }

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="css/cms.css">
    <title>CMS - Cadastro de Ambientes</title>
  </head>
  <body>
    <div class="main">
      <?php include('include/cabecalho.php'); ?>
      <?php include('include/menu.php'); ?>
      <div class="subMenu">
        <a href="listaAmbiente.php">
          <img src="#" alt="Retornar">
        </a>
      </div>
      <form class="frmAtualizarSite" action="cadAmbiente.php" enctype="multipart/form-data" method="post">
        <div class="conteudo">
          <div class="cadastrarItem">
            <div>
              Nome do Local: <input type="text" name="txtLogradouro" maxlength="50" required>
            </div>
            <div>
              Nome do Proprietário: <input type="text" name="txtProprietario" placeholder="Nome do proprietário do local">
            </div>
            <div>
              Descrição do local: <textarea name="txtDesc" rows="1" cols="80" placeholder='Ex: "Próximo ao Rio de Lava Ardente"' required></textarea>
            </div>
            <div>
              Link para o google Maps: <input type="url" name="linkMaps" placeholder="Link compartilhado do mapa" maxlength="180" required>
            </div>
            <div>
              <input type="submit" name="btnSalvar" value="Salvar">
            </div>
          </div>
        </div>
      </form>
      <?php include('include/rodape.php'); ?>
    </div>
  </body>
</html>
