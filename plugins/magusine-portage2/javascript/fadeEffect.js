/**
 * Fade effect for UMI
 * 
 * http://www.umi-bulle.fr
 * 
 * Copyright (c) 2009 Stephan Lagraulet
 * Licensed under the GPL (GPL-LICENSE.txt) license.
 * 
 */
		$(document).ready(
				function(){
				   $('.latest_img').fadeTo(10, 0.1); // This sets the opacity of the thumbs to fade down to 10% when the page loads
				   $('.latest_img').css('visibility','visible');
				   $('.latest_img').hover(function(){
					   		$(this).fadeTo('slow', 1.0); // This should set the opacity to 100% on hover
					 	},function(){
							$(this).fadeTo('slow', 0.1); // This should set the opacity back to 10% on mouseout
						});
				   /*$('.menu_img').fadeTo(1, 0); // This sets the opacity of the thumbs to fade down to 10% when the page loads
				   $('.menu_img').css('visibility','visible');
				   $('.menu_img').hover(function(){
					   		$(this).css('visibility','visible');
					   		$(this).animate({opacity: '1', top: '+=75px'}, 500); // This should move the element
					 	});
				   /*,function(){
							$(this).fadeTo('slow', 0.1); // This should set the opacity back to 10% on mouseout
						});*/
				});
		$(document).ready(function(){
				$('#contextes').css('visibility','visible');
				$('#contextes')
					.animate({opacity: '0', left: '690px',top: '105px'}, 1)
					.animate({opacity: '1', left: '720px',top: '75px'}, 2000)
					return false;
		});
		$(document).ready(function(){
				$('.menu_head').css('visibility','visible');
				$('.menu_head')
					.fadeTo(10, 0)
					.fadeTo(1000, 0.9)
					.fadeTo(3500, 0)
					.fadeTo(3500, 0)
					.fadeTo(3500, 0)
					return false;
		});
		$(document).ready(function(){
				$('.menu_head1').css('visibility','visible');
				$('.menu_head1')
					.fadeTo(10, 0)
					.fadeTo(2000, 0)
					.fadeTo(3500, 0.9)
					.fadeTo(3500, 0)
					return false;
		});
		$(document).ready(function(){
				$('.menu_head2').css('visibility','visible');
				$('.menu_head2')
					.fadeTo(10, 0)
					.fadeTo(3500, 0)
					.fadeTo(2000, 0)
					.fadeTo(3500, 0.9)
					.fadeTo(3500, 0)
					return false;
		});