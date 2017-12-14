<?php
	$id = $_POST['id'];

  require_once("cms/include/conexao.php");
	$conn = conexao();

?>
<html>
	<head>
		<title></title>
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
	<div>
		<?php
			$sql = "SELECT * FROM tbl_produto WHERE codigo=".$id;
      $select = mysqli_query($conn, $sql);
      $rs = mysqli_fetch_array($select);

      $cliques = $rs['qtdCliques'];
      $cliques += 1;
      $insert = "UPDATE tbl_produto
                SET qtdCliques = '$cliques'
                WHERE codigo =".$id;
                mysqli_query($conn,$insert);
                // echo $insert;
		?>
		ID: <?php echo($id); ?>
    <table>
      <tr>
        <td> <img src="cms/<?php echo($rs['foto']); ?>" alt="produto" width="300px" height="300px" style="margin-left:auto;"> </td>
      </tr>
      <tr>
        <td>Nome: <?php echo ($rs['nome']); ?></td>
      </tr>
      <tr>
        <td>Descrição: <?php echo($rs['descricao']); ?></td>
      </tr>
      <tr>
        <td>Preço: <?php echo($rs['preco']); ?></td>
      </tr>
    </table>
	</div>

</body>
</html>
