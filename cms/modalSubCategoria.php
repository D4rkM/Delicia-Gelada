<?php
	$id = $_POST['id'];

	session_start();

  $conexao = mysqli_connect('localhost', 'root', 'bcd127', 'db_delicia_gelada');

	if(isset($_POST['btnEditar'])){

		$nome = $_POST['txtSubCategoria'];
		if(isset($_POST['ckAtivo'])){
      $ativo = $_POST['ckAtivo'];
    }else{
      $ativo = 0;
    }

		$sql = "UPDATE tbl_subCategoria
						SET nome = '$nome',
						ativo = '$ativo'
						WHERE codigo =".$_SESSION['codSubCategoria'];

		// echo($sql);

		if (mysqli_query($conexao, $sql)){
			?><script> alert('Sub-Categoria alterada com sucesso!'); </script>"<?php
				header("location:listaSubCategorias.php");
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
    <form class="frmEditarSubCategoria" action="modalSubCategoria.php" method="post">
  		<div>
  			<a href="#" class="fechar">Fechar(x)</a>
  		</div>
  		<div id="editarUsuairo">
				<?php
  				$sql = "SELECT sc.*, sc.codigo as codSub, c.* FROM tbl_subCategoria AS sc
          INNER JOIN tbl_categoria as c
          ON sc.codCategoria = c.codigo
          WHERE sc.codigo=".$id;
  				// echo($sql);
  				$select = mysqli_query($conexao, $sql);

  				$rs = mysqli_fetch_array($select);

          $_SESSION['codSubCategoria'] = $rs['codSub'];
          $codCategoria = $rs['codCategoria'];
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
						<td>Categoria: <input type="text" name="txtSubCategoria" maxlength="50" required value="<?php echo($rs['nome']); ?>">
            </td>
					</tr>
          <tr>
            <td>Categoria:
            <select class="categoria" name="selectCategoria" required>
              <option value="<?php echo($rs['codCategoria']); ?>"><?php echo($rs['categoria']); ?></option>
              <?php
                $newSql = "SELECT * from tbl_categoria WHERE codigo <> ".$codCategoria;
                $select = mysqli_query($conexao, $newSql);
                while($newRs = mysqli_fetch_array($select)){
              ?>
              <option value="<?php echo($newRs['codCategoria']); ?>"><?php echo($newRs['categoria']); ?></option>
              <?php
                }  ?>
            </select></td>
					<tr>
						<td>Ativar Categoria: <input type="checkbox" name="ckAtivo" value="1" <?php echo($at); ?>></td>
					</tr>
					<tr>
						<td><input type="submit" name="btnEditar" value="Editar"></td>
					</tr>
				</table>

  		</div>
    </form>
	</body>
</html>
