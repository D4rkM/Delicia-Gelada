<?php
	$id = $_POST['id'];

	session_start();

  $conexao = mysqli_connect('localhost', 'root', 'bcd127', 'db_delicia_gelada');

	if(isset($_POST['btnEditar'])){

		$nome = $_POST['txtNome'];
		$usuario = $_POST['txtUsuario'];
		$nivelUsuario = $_POST['selectNivel'];
		$ativado = $_POST['ckAtivo'];
		$ativado = $ativado == "" ? 0 : $ativado;

		$sql = "UPDATE tbl_Usuario
						SET nome = '$nome', user = '$usuario',
						codNivel = '$nivelUsuario', ativo = '$ativado'
						WHERE codUsuario =".$_SESSION['idU'];

		echo($sql);

		if (mysqli_query($conexao, $sql)){
			?><script> alert('Usuário alterado com sucesso!'); </script>"<?php
				header("location:admUsuario.php");
		} else {
			echo("<script> alert('Não foi possível alterar o usuário..'); </script>");
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
    <form class="frmEditarUsuario" action="modalUsuario.php" method="post">
  		<div>
  			<a href="#" class="fechar">Fechar(x)</a>
  		</div>
  		<div id="editarUsuairo">
  			<?php
  				$sql = "SELECT u.*, n.* FROM tbl_Usuario AS u
  				 			INNER JOIN tbl_NivelDeUsuario AS n
  							ON u.codNivel = n.codNivel
  							WHERE u.codUsuario = '$id';";
					// echo($sql);
  				$select = mysqli_query($conexao, $sql);

  				$rs = mysqli_fetch_array($select);
					
          $codNivel= $rs['codNivel'];
					$_SESSION['idU'] = $rs['codUsuario'];

  			?>

  			Código:  <?php echo($id); ?><br>
  			Nome : <input type="text" name="txtNome" value="<?php echo($rs['nome']); ?>"><br>
  			Usuario: <input type="text" name="txtUsuario" value="<?php echo($rs['user']); ?>"> <br>
				<input type="checkbox" name="ckAtivo" value="<?php echo(isset($_POST['ckAtivo']) ? '0' : '1');?> " <?php echo($rs['ativo'] == 1? 'checked' : ''); ?>>Usuario Ativado<br>
  			Nível:
        <select class="nivel" name="selectNivel">
          <option value="<?php echo($rs['codNivel']); ?>"><?php echo($rs['nivel']); ?></option>
          <?php
	          $newSql = "SELECT * from tbl_NivelDeUsuario WHERE codNivel <> '$codNivel';";
	          $select = mysqli_query($conexao, $newSql);
	          while($newRs = mysqli_fetch_array($select)){
          ?>
          <option value="<?php echo($newRs['codNivel']); ?>"><?php echo($newRs['nivel']); ?></option>
          <?php
          	}  ?>
  			</select> <br>
        <input type="submit" name="btnEditar" value="Editar">
  		</div>
    </form>
	</body>
</html>
