
<script>//Função para adicionar animação ao menu_superior (alterações de opacidade)
$(function(){
 //Função para utilizar a posição do scroll na animação
   $(window).scroll(function() {
     var top = $(window).scrollTop();//top pega a posição do scroll

     if(top > 150){ //verifica se a posição do srcoll é maior do que 150 para diminuir a opacidade
       // alert(top);
       $("#menu_superior").css("opacity","0.2");

     }else{ //se não mantem a opacidade
       $("#menu_superior").css("opacity","1");
     }
   });
   // Aplica um efeito para quando passar o mouse sobre o menu para que ele volte a opacidade para 1
   $('#menu_superior').hover(function(){
     $("#menu_superior").css("opacity","1");
   })
   // Efeito de retorno para quando retirar o mouse a opacidade diminuir novamente
   $('#menu_superior' && '#campo_items_menu' && '#logo' && '#autenticacao' && '.loginBtn' && '.login').mouseout(function(){
     var top = $(window).scrollTop();
     // alert(top);
     if (top > 150) {
       $("#menu_superior").css("opacity","0.2");
     }
   });
});

</script>
