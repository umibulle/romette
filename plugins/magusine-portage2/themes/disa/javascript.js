 $(document).ready(function(){   // fait marcher le menu a deux niveaux
   $('#navigation').children('.niveau1').each(function(){
   	$(this).mouseover(function() {
   	$(this).children('.niveau2').show();   	
   	})
   	
   	$(this).mouseout(function() {
   	$(this).children('.niveau2').hide();   	
   	})
   	}); });