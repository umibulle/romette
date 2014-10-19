var icone_haut;
var icone_bas;

$(document).ready(function(){
 if ($(".fleche").length){
  icone_haut = $(".fleche")[0].getAttribute('src');
  icone_bas = icone_haut.replace(/deplierhaut\.gif/, 'deplierbas.gif');
 }
});

function montrer_item(leitem) {
	jQuery(leitem).toggle(); 	
}

function deplier_contenu(elem) {
  if ($(elem).attr("src") == icone_haut) {
    $(elem).attr({src: icone_bas});
    $(elem).siblings("ul").css({display: "block"});
  } else {
    $(elem).attr({src: icone_haut});
    $(elem).siblings("ul").css({display: "none"});
  }
}
