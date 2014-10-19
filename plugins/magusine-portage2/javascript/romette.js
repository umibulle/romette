/*
 *
 * Copyright (c) UMI Bulle de création graphique
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Version 1.1
 *
 */

$(document).ready(function() {

  if ($('#header_bandeau').length != 0) {
    $('#header_bandeau').fadeTo(2500, 1).fadeOut(3000, function() {
      $('#header_bandeau').css('z-index', '-100');
      });
    $('#bandeau-main').fadeTo(2500, 1).fadeOut(3000);
  } else {
    $('#bandeau-main').fadeOut(1);
  }

});

$(document).ready(function() {
  $(".listageconteneur a").hover(function() {
    $(this).next("em").animate( {
      opacity : "show",
      left : "-110"
    }, "fast");
  }, function() {
    $(this).next("em").animate( {
      opacity : "hide",
      left : "-150"
    }, "fast");
  });
});

$(document).ready(function() {

  // hide message_body after the first one
    $(".collapse_body:gt(-1)").hide();

    // toggle message_body
    $(".collapse_header").click(function() {
      $(this).next(".collapse_body").slideToggle(500)
      return false;
    });

  });
