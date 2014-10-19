function popup_page(gabarit, largeur, hauteur){
  var top=(screen.height /2)-(hauteur /2);
  var left=(screen.width /2)-(largeur /2);
  var params = "top="+ top + ",left=" + left + ",width=" + largeur + ",height=" + hauteur + ",scrollbars=yes,resizable=yes";
fenetre = window.open(gabarit,'',params);
}

function montrele(leid) {
$(leid).slideToggle();
}

