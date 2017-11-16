<?php
	$id = $_POST['id'];

	session_start();

	$conn = mysqli_connect('localhost','root','bcd127','db_delicia_gelada');

//ação do botao editar
	if(isset($_POST['btnEditar'])){

		$nivel = $_POST['txtNivel'];

		$sql = "UPDATE tbl_NivelDeUsuario
							SET nivel = '$nivel'
							WHERE codNivel =".$_SESSION['codigo'];

		if(mysqli_query($conn, $sql)){
			header('location:admNivel.php');
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
	<form class="frmNivel" action="modalNivel.php" method="post">
		<div>
			<a href="#" class="fechar">Fechar(x)</a>
		</div>
		<div>
			<?php
				$sql = "SELECT * FROM tbl_NivelDeUsuario WHERE codNivel=".$id;
				$select = mysqli_query($conn, $sql);
				$rs = mysqli_fetch_array($select);
				$_SESSION['codigo'] = $rs['codNivel'];

			?>
			ID: <?php echo($id); ?>
			Nivel:<input type="text" name="txtNivel" value="<?php echo($rs['nivel']); ?>">
			<input type="submit" name="btnEditar" value="Editar">
		</div>
	</form>
</body>
</html>
