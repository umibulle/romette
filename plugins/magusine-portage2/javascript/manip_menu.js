$(document).ready(function(){

  $('.ajouter').each(function(){
    $(this).click(function(){
      titre = $(this).siblings("span").text();
      regex = /(id_rubrique|id_article|id_groupe|id_mot)=([0-9]+)/;
      matches = regex.exec(this.getAttribute('href'));
      if (matches.length > 2) {
        if (matches[1] == "id_rubrique" && !isNaN(matches[2] && !$('#r'+matches[2]).length)) {
          $("#selection").append('<li id="r'+matches[2]+'" class="sortable">'+titre+" <span class='url_petit'>("+traductions['rubrique']+")</span> <a href=\"javascript:supprimer('#r"+matches[2]+"')\">x</a></li>");
        } else if (matches[1] == "id_article" && !isNaN(matches[2]) && !$('#a'+matches[2]).length) {
          $("#selection").append('<li id="a'+matches[2]+'" class="sortable">'+titre+" <span class='url_petit'>("+traductions['article']+")</span> <a href=\"javascript:supprimer('#a"+matches[2]+"')\">x</a></li>");
        } else if (matches[1] == "id_groupe" && !isNaN(matches[2]) && !$('#g'+matches[2]).length) {
          $("#selection").append('<li id="g'+matches[2]+'" class="sortable">'+titre+" <span class='url_petit'>("+traductions['groupe']+")</span> <a href=\"javascript:supprimer('#g"+matches[2]+"')\">x</a></li>");
        } else if (matches[1] == "id_mot" && !isNaN(matches[2]) && !$('#m'+matches[2]).length) {
          $("#selection").append('<li id="m'+matches[2]+'" class="sortable">'+titre+" <span class='url_petit'>("+traductions['mot']+")</span> <a href=\"javascript:supprimer('#m"+matches[2]+"')\">x</a></li>");
        }
      }
      
      $('#bloc_sauver').css({background: "red"});
     
      makesortable();
      return false;
    });
  });
});

function makesortable() {
  if (type_sortable == "flat") {

  $('#selection').Sortable(
  {
  	accept: 'sortable',
  	helperclass: 'sortHelper',
  	activeclass : 	'sortableactive',
  	hoverclass : 	'sortablehover',
  	//handle: 'div.itemHeader',
  	tolerance: 'pointer',
  	opacity: 0.5,
  	onChange : function(ser)
  	{
  	},
  	onStart : function()
  	{
  		$.iAutoscroller.start(this, document.getElementsByTagName('body'));
  	},
  	onStop : function()
  	{
  		$.iAutoscroller.stop();
      $('#bloc_sauver').css({background: "red"});

    }
  }
  );
  
  } else if (type_sortable = "nested") {

  $('#selection').NestedSortable(
  {
  	accept: 'sortable',
  	helperclass: 'sortHelper',
  	activeclass : 	'sortableactive',
  	hoverclass : 	'sortablehover',
  	//handle: 'div.itemHeader',
  	tolerance: 'pointer',
  	opacity: 0.5,
  	onChange : function(ser)
  	{
  	},
  	onStart : function()
  	{
  		$.iAutoscroller.start(this, document.getElementsByTagName('body'));
  	},
  	onStop : function()
  	{
  		$.iAutoscroller.stop();
      $('#bloc_sauver').css({background: "red"});

    }
  }
  );  
  
  }
}

function ajouter_lien() {
  nom = $('#nom_lien').attr('value');
  lurl = $('#url_lien').attr('value');
  if(!nom || !lurl) { return; }
  
  afficheurl = lurl;
  affichenom = nom;
  nom = nom.replace(/\|/g, "");
  lurl = lurl.replace(/\|/g, "");
  
  // correctif pour le sortable.hash qui merde
  id = htmlentities('|' + nom+'|'+ lurl);
  
  // trouver un id factice superieur à 90000
  base=90000;
  unique=0;
  
  while(unique==0){
  	if ($("#selection li[@id^=l"+ base+"]").length > 0){
  	base++;
  	} else {
  		unique=1;
  	}
  }
  
  id="l" + base + id;
    $("#selection").append('<li id="'+id+'" class="sortable">'+affichenom+" <span class='url_petit'>("+ afficheurl+")</span> <a href='javascript:supprimer_lien(\""+id+"\")'>x</a></li>");
  $('#bloc_sauver').css({background: "red"});
  makesortable();
}

function sauver(langue){
		$('#search').css({visibility: 'visible'});

  if (type_sortable == "nested") {
    serial = $.iNestedSortable.serialize('selection');
  } else {
    serial = $.SortSerialize();
  }
	$.post("?exec=menu&mode=sauver&langue_menu=" + langue + "&niveaux=" + type_sortable, serial.hash, function (reponse) {
		//console.log(reponse);
		$('#search').css({visibility: 'hidden'});
    $('#bloc_sauver').css({background: "green"});
	});
}

function supprimer(elem) {
 jQuery(elem).remove();
       $('#bloc_sauver').css({background: "red"});

}
function supprimer_lien(elem) {
elem = document.getElementById(elem);
 jQuery(elem).remove();
       $('#bloc_sauver').css({background: "red"});

}

function htmlentities(str) {    var i,output="",len;    len = str.length;    for(i=0;i<len;i++){
    	char = str[i].charCodeAt(0);
       if(char == 34) { output+="ggguiii"; }
       else if(char ==39) { output +="aaapooo"; }
       else if(char==45){ output +="tttirrr"; }
  	else { output += str[i]; }    }    return output;}
