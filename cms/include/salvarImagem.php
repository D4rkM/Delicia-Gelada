<?php
 function salvarImagem($nome_arq){
   $upload_dir = "img/produto/";

     //Verificando se a extensão é permitida
     if(strstr($nome_arq,'.jpg') || strstr($nome_arq,'.png') || strstr($nome_arq,'.jpeg')){
      //pega a extensão do nome do arquivo
      $extensao = substr($nome_arq, strpos($nome_arq,"."), 5);
      //pega o nome do arquivo sem a extensão
      $prefixo = substr($nome_arq, 0, strpos($nome_arq,"."));
      //Criptografa o nome do arquivo em MD5 e coloca o tipo de extensão que o arquivo pertence
      $nome_arq = md5($prefixo).$extensao;
      //Guardamos o caminho e o nome da imagem que será inserida no BD.
      $upload_file = $upload_dir . $nome_arq;
      //Salva o arquivo temporariamente no servidor antes do envio para o banco
      move_uploaded_file($_FILES['fotoImp']['tmp_name'], $upload_file);
      //retorna
    }else{
      $upload_file = "Extensão de arquivo Inválida";
    }
    return $upload_file;
  }
?>
