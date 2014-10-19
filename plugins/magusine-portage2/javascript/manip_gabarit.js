$(document).ready(function(){
makesortable();

$("#avance .bloc").hide();

$("#avance li").eq(0).css("cursor","pointer").click(function(){
$("#avance .bloc").toggle();
});

});

function makesortable() {
  $('.conteneur_bloc').Sortable(
  {
  	accept: 'bloc',
  	handle: 'div.poignee',
  	helperclass: 'sortHelper',
  	activeclass : 	'sortableactive',
  	hoverclass : 	'sortablehover',
  	//handle: 'div.itemHeader',
  	tolerance: 'pointer',
  	opacity: 0.5,

  	
  	onStart : function()
  	{
  		$.iAutoscroller.start(this, document.getElementsByTagName('body'));
  	},
  	onStop : function()
  	{
  		$.iAutoscroller.stop();
  		$('#reponse').html('');
  		$('#bloc_sauver').css({background: "red", border: "1px solid black"});
    }
  }
  );
    
}

function sauver (gabarit,urlretour) {
	$('#search').css({visibility: 'visible'});
	serial = $.SortSerialize();
	// ici recuperer les valeurs des parametres dans les blocs pour les ajouter a la base
	parametres = "";
	$('.selecteur-param').each(function() { 
		lecheck=this.value;
		lebloc=this.name;
		parametres = parametres + "&" + lebloc + "=" + lecheck
		// ici, formater pour le post
		});	

	$.post("?exec=gabarit&action=enregistrer_gabarit", serial.hash + "&gabarit="+gabarit + parametres, function (reponse) {
		$('#reponse').html(reponse);
		$('#search').css({visibility: 'hidden'});
		$('#bloc_sauver').css({background: "green", border: "1px solid green"});
		if (urlretour){
			window.location=urlretour;
			}
		});
	
	}


