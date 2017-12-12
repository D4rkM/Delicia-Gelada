<?php
	require_once("cms/include/conexao.php");
	$conn = conexao();

	$sql = "SELECT * FROM tbl_ambiente WHERE codigo = 1;";

	$select = mysqli_query($conexao, $sql);

	$lstAmb = array();

	while($rsAmb = mysqli_fetch_assoc($select))
	{
		$lstAmb[] =  $rsAmb;
	}

	echo json_encode($lstAmb);

?>
