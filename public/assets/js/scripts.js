
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */

	/* slideshow
    $.backstretch([
                    "assets/img/backgrounds/2.jpg"
	              , "assets/img/backgrounds/3.jpg"
	              , "assets/img/backgrounds/1.jpg"
	             ], {duration: 3000, fade: 750});

    */

	$.backstretch("assets/img/backgrounds/2.jpg");


    /*
        Form validation
    */
    $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    $('.login-form').on('submit', function(e) {
    	
    	$(this).find('input[type="text"], input[type="password"], textarea').each(function(){
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    });
    
    
});
