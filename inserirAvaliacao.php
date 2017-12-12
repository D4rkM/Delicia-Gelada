<?php

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		require_once("cms/include/conexao.php");
		$conn = conexao();
		
		$idProduto=$_POST["idProduto"];
		$avaliacao=$_POST["avaliacao"];

    $select = "SELECT * FROM tbl_produto WHERE codigo =".$idProduto;

    $search = mysqli_query($conn, $select);

    if($rs = mysqli_fetch_array($search)){

      $estrelas = $rs['estrelas'] + 1;

      $sql="UPDATE tbl_produto SET
      estrelas='$nome', pessoas = '$estrelas'
      WHERE codigo = ".$idProduto;

  		if (mysqli_query($conn, $sql)) {

  			echo json_encode(array(
  					"sucesso" => true ,
  					"mensagem"=> "Inserido com sucesso"));
  		} else {

  			echo json_encode(array(
  					"sucesso" => false ,
  					"mensagem" => mysqli_error($conn)));
  		}
    }

	}else{

		echo json_encode(array(
		"sucesso" => false ,
		"mensagem"=> "Método não suportado"));
	}
?>
