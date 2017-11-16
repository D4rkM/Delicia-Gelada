<?php
	$id = $_POST['id'];

  $conexao = mysqli_connect('localhost', 'root', 'bcd127', 'db_delicia_gelada');

  session_start();

  if(isset($_POST['btnEditar'])){
    $nomeLocal = $_POST['txtLogradouro'];
    $nomeProprietario = $_POST['txtProprietario'];
    $descLocal = $_POST['txtDesc'];
    $linkMaps = $_POST['linkMaps'];

    //ATUALIZANDO AMBIENTE
    $sql="UPDATE tbl_ambiente
    SET nomeLocal = '$nomeLocal',
     nomeProprietario='$nomeProprietario',
     descLocal='$descLocal',
     linkMaps='$linkMaps' WHERE codigo = ".$_SESSION['cod'];
     echo($sql);
    if(mysqli_query($conexao, $sql)){
      header('location:listaAmbiente.php');

      echo("Arquivo movido com sucesso");
    }else{
      echo("Erro ao tentar enviar dados para o banco\n" .$sql);
    }

  }

?>
<html>
	<head>
		<title> </title>
	</head>

  <script>
    $(document).ready(function() {

      $(".fechar").click(function() {
        //$(".modalContainer").fadeOut();
      $(".modalContainer").slideToggle(1000);
      });
    });
  </script>

<body>

	<div>
		<a href="#" class="fechar">Fechar(x)</a>
	</div>
  <form class="frmEditAmb" action="modalAmbiente.php" method="post">

  	<div id="verDados">
  		<table width="500" height="500" border="solid">

  			<?php
  	      $sql = "SELECT * FROM tbl_ambiente
  	              WHERE codigo = '$id';";

  	      $select = mysqli_query($conexao, $sql);

  	      $rs = mysqli_fetch_array($select);
          $_SESSION['cod'] = $rs['codigo'];
  	    ?>

  			<tr>
  				<td>ID: <?php echo($id); ?></td>
  			</tr>
  			<tr>
  				<td>Nome do Local: <input type="text" name="txtLogradouro" maxlength="50" required value="<?php echo($rs['nomeLocal']); ?>"></td>
  			</tr>
  			<tr>
  				<td>Nome do Proprietário: <input type="text" name="txtProprietario" placeholder="Nome do proprietário do local" value="<?php echo($rs['nomeProprietario']); ?>"></td>
  			</tr>
  			<tr>
  				<td>Descrição do local: <textarea name="txtDesc" rows="1" cols="80" placeholder='Ex: "Próximo ao Rio de Lava Ardente"' required maxlength="90"><?php echo($rs['descLocal']); ?></textarea></td>
  			</tr>
  	    <tr>
  	    	<td>Link para o google Maps: <input type="url" name="linkMaps" placeholder="Link compartilhado do mapa" maxlength="180" required value="<?php echo($rs['linkMaps']); ?>"></td>
  	    </tr>
        <tr>
          <td><input type="submit" name="btnEditar" value="Editar"></td>
        </tr>
  		</table>
  	</div>
  </form>
</body>
</html>
