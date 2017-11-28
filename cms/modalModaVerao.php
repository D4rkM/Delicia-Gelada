<?php
	$id = $_POST['id'];

	session_start();

	require_once("include/conexao.php");
	$conn = conexao();

	require_once("include/salvarImagem.php");

	// ação do botao editar
	if(isset($_POST['btnEditar'])){

		$titulo = $_POST['txt_titulo'];
		$texto1 = $_POST['txt1'];
		$texto2 = $_POST['txt2'];
		$cod = $_SESSION['codModa'];
		$ativado = $_POST['ckAtivar'];
		$ativado = $ativado == "" ? 0 : $ativado;


    $nome_arq = basename($_FILES['fotoImp']['name']);
		if($nome_arq == ""){
			$sql = "UPDATE tbl_modaVerao
							SET texto1 = '$texto1',
							texto2 = '$texto2',
							titulo = '$titulo',
							ativo = '$ativo'
							WHERE codigo = '$cod';";

			// echo($sql);

			if (mysqli_query($conn, $sql)){
				?><script> alert('Usuário alterado com sucesso!'); </script>"<?php
					header("location:listaModaVerao.php");
			} else {
				echo("<script> alert('Não foi possível alterar a página..'); </script>");
			}
		}else{
			$imagem = salvarImagem($nome_arq);

			$sql = "UPDATE tbl_modaVerao
							SET texto1 = '$texto1',
							texto2 = '$texto2',
							titulo = '$titulo',
							imagem = '$imagem',
							ativo = '$ativo'
							WHERE codigo = '$cod';";

			// echo($sql);

			if (mysqli_query($conn, $sql)){
				?><script> alert('Usuário alterado com sucesso!'); </script>"<?php
					header("location:listaModaVerao.php");
			} else {
				echo("<script> alert('Não foi possível alterar a página..'); </script>");
			}
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
    <form class="frmAtualizarSite" action="modalModaVerao.php" enctype="multipart/form-data" method="post">
  		<div>
  			<a href="#" class="fechar">Fechar(x)</a>
  		</div>
  		<div id="editarUsuairo">
				<?php
  				$sql = "SELECT * FROM tbl_modaVerao WHERE codigo =".$id;
					// echo($sql);
  				$select = mysqli_query($conn, $sql);

  				$rs = mysqli_fetch_array($select);

					$at = "";

					if($rs['ativo']){
						$at = "checked";
					}

					$_SESSION['codModa'] = $rs['codigo'];

  			?>
				<table width="500" height="auto" border="solid 1" style="margin-left:50px">
					<tr>
						<td>Código:  <?php echo($id); ?><br></td>
					</tr>
					<tr>
						<td>Título: <input type="text" name="txt_titulo" maxlength="50" required value="<?php echo($rs['titulo']); ?>"></td>
					</tr>
					<tr>
						<td>Texto1: <textarea name="txt1" rows="4" cols="80" required maxlength="950"><?php echo($rs['texto1']); ?></textarea></td>
					</tr>
					<tr>
						<td>Texto2: <textarea name="txt2" rows="4" cols="80" required maxlength="950"><?php echo($rs['texto2']); ?></textarea></td>
					</tr>
					<tr>
						<td>Foto: <input type="file" name="fotoImp">
						<div>
							<img src="<?php echo($rs['imagem']); ?>" alt="Imagem da página" width="50" height="30"/>
						</div>
						</td>
					</tr>
					<tr>
						<td>Ativar Página: <input type="checkbox" name="ckAtivar" value="1" <?php echo($at); ?>></td>
					</tr>
					<tr>
						<td><input type="submit" name="btnEditar" value="Editar"></td>
					</tr>
				</table>

  		</div>
    </form>
	</body>
</html>
