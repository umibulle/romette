/**
 * Fade effect for Contrepoint
 * 
 * http://www.umi-bulle.fr
 * 
 * Copyright (c) 2009 Stephan Lagraulet
 * Licensed under the GPL (GPL-LICENSE.txt) license.
 * 
 */
		
		$(document).ready(function(){
				$('#accueil_cache').css('visibility','visible');
				$('#accueil_cache')
					/*.animate({opacity: '1', left: '250px',top: '0px'}, 1) */
					.animate({opacity: '1', left: '+1500px',top: '0px'}, 2500)
					.fadeTo(1,0)
					.animate({opacity: '1', left: '-1500px',top: '0px'}, 10);
				/*$('#accueil_cache').css('visibility','none');*/
				$('#accueil_image')
					.fadeTo(4000,0.3)
					.animate({opacity: '1', left: '-1500px',top: '0px'}, 2000)
					.fadeTo(2500,0);
		});
		