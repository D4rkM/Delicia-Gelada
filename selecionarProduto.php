<?php
	require_once("cms/include/conexao.php");
	$conn = conexao();

	$sql = "SELECT * FROM tbl_produto WHERE ativo = 1;";

	$select = mysqli_query($conexao, $sql);

	$lstProdutos = array();

	while($rsProduto = mysqli_fetch_assoc($select))
	{
		$lstProdutos[] =  $rsProduto;
	}

	echo json_encode($lstProdutos);

?>
