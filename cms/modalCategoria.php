<?php
	$id = $_POST['id'];

	session_start();

	require_once("include/conexao.php");
	$conn = conexao();

	if(isset($_POST['btnEditar'])){

		$categoria = $_POST['txtCategoria'];
		$ativado = $_POST['ckAtivar'];
		$ativado = $ativado == "" ? 0 : $ativado;

		$sql = "UPDATE tbl_categoria
						SET categoria = '$categoria',
						ativo = '$ativo'
						WHERE codigo =".$_SESSION['codCategoria'];

		// echo($sql);

		if (mysqli_query($conn, $sql)){
			?><script> alert('Categoria alterada com sucesso!'); </script>"<?php
				header("location:listaCategorias.php");
		} else {
			echo("<script> alert('Não foi possível alterar a Promoção..'); </script>");
		}

	}
?>
<html>
	<head>
		<title></title>
		<script>
    	$(document).ready(function() {

    		$(".fechar").click(function() {
    			//$(".modalContainer").fadeOut();
    		$(".modalContainer").slideToggle(1000);
    		});
    	});
		</script>
	</head>
	<body>
    <form class="frmEditarCategoria" action="modalCategoria.php" method="post">
  		<div>
  			<a href="#" class="fechar">Fechar(x)</a>
  		</div>
  		<div id="editarUsuairo">
				<?php
  				$sql = "SELECT * FROM tbl_categoria WHERE codigo=".$id;
  				// echo($sql);
  				$select = mysqli_query($conn, $sql);

  				$rs = mysqli_fetch_array($select);

          $_SESSION['codCategoria'] = $rs['codigo'];

          $cod = $rs['codigo'];

          $at = "";

          if($rs['ativo']){
            $at = "checked";
          }

  			?>
				<table width="500" height="auto" border="solid 1" style="margin-left:50px">
					<tr>
						<td>Código:  <?php echo($id); ?><br></td>
					</tr>
					<tr>
						<td>Categoria: <input type="text" name="txtCategoria" maxlength="50" required value="<?php echo($rs['categoria']); ?>">
            </td>
					</tr>
					<tr>
						<td>Ativar Categoria: <input type="checkbox" name="ckAtivar" value="1" <?php echo($at); ?>></td>
					</tr>
					<tr>
						<td><input type="submit" name="btnEditar" value="Editar"></td>
					</tr>
				</table>

  		</div>
    </form>
	</body>
</html>
