$(document).ready(function(){

// cache la liste des menus et declinaisons, ajoute un onclick, deroule si clicque
$(".liste-declinaison").hide();
$(".declinaison").each(function(){
if( $(this).attr("checked")==true){
$(this).parent().show();
}

});

$(".vignette-autres-theme").css({ display:"block",position:"absolute",top:"0",left:"0px" });

$(".conteneur-theme .theme_deplier").each(function(){
$(this).css("cursor","pointer");
	$(this).click(function(){
		$(this).next().toggle();
	});
	$(this).hover(function(e){
	lien=$(this).attr("rel");
	$("body").after("<img src='"+ lien +"' id='lavignette' />");
	posbasex=e.pageX;	posbasey=e.pageY;
	$('#lavignette').css("top", (posbasey -20) + "px").css("left", (posbasex -320) + "px");
	},function(){
	$("#lavignette").remove();
	});
	
});


});