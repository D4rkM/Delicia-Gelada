<?php
	$id = $_POST['id'];

  $conexao = mysqli_connect('localhost', 'root', 'bcd127', 'db_delicia_gelada');

?>
<html>
	<head>
		<title> Teste Modal </title>
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
	<div id="verDados">
		<table width="500" height="500" border="solid">

			<?php
	      $sql = "SELECT * FROM tbl_faleconosco
	              WHERE codFaleConosco = '$id';";

	      $select = mysqli_query($conexao, $sql);

	      $rs = mysqli_fetch_array($select);
	    ?>

			<tr>
				<td>ID: <?php echo($id); ?></td>
			</tr>
			<tr>
				<td>nome: <?php echo($rs["nome"]) ?></td>
			</tr>
			<tr>
				<td>telefone: <?php echo($rs["telefone"]) ?></td>
			</tr>
			<tr>
				<td>celular: <?php echo($rs["celular"]) ?></td>
			</tr>
	    <tr>
	    	<td>email: <?php echo($rs["email"]) ?></td>
	    </tr>
	    <tr>
	    	<td>homepage: <?php echo($rs["home_page"]) ?></td>
	    </tr>
	    <tr>
	    	<td>facebook: <?php echo($rs["facebook"]) ?></td>
	    </tr>
	    <tr>
	    	<td>sexo: <?php echo($rs["sexo"]) ?></td>
	    </tr>
	    <tr>
	    	<td>profissão: <?php echo($rs["profissao"]) ?></td>
	    </tr>
	    <tr>
	    	<td>Sugestão/Crítica: <?php echo($rs["desc_sugestao"]) ?></td>
	    </tr>
			<tr>
				<td>Informação: <?php echo($rs["desc_informacao"]) ?></td>
			</tr>

		</table>
	</div>

</body>
</html>
