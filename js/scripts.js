(function($){
    'use strict'

    $(document).ready(function(){
	var pageCount = 2;
	var pageTotal = $('#mason-grid').attr('data-max-page');
	
	/**
	 * Init masonry
	 */
	var $grid = $('#mason-grid').masonry({
	    	columnWidth: '.grid-sizer',
	 	itemSelector: '.entry-box',
	    	gutter: 10,
	    	percentPosition: true,
	    });

	$grid.imagesLoaded().progress(function(){
	    $grid.masonry('layout');
	});
   	
	$(window).scroll(function(){
	    if($(window).scrollTop() == $(document).height() - $(window).height()){
		if(pageCount > pageTotal){
		    $('#eotl').fadeIn();
		} else {
		    loadArticle(pageCount, $grid);
		}
		pageCount++;
	    }
	});

	/**
	 * End of the Line
	 */
	$('#eotl').click(function(){
	    $('html,body').animate({ scrollTop: 0 }, 'slow');
	});

	/**
	 * Youtube embed resizer
	 */
	var allYoutube = $("iframe[src*='//www.youtube.com']");
	var fluidEl = $(".entry-content");
	
	allYoutube.each(function(){
	    $(this).attr('aspect-ratio', this.height/this.width)
		.removeAttr('height')
		.removeAttr('width');
	});

	$(window).resize(function(){
	    var newWidth = fluidEl.width();
	
	    allYoutube.each(function(){
		var el = $(this);
		el.width(newWidth)
		    .height(newWidth * el.attr('aspect-ratio'));
	    });
	}).resize();

	/** Header changer **/
	$(window).on('scroll', function(){
	    if($(window).scrollTop() > 50){
		$('.nav-top').addClass('invert');
	    } else {
		$('.nav-top').removeClass('invert');
	    }
	});

	/** Small nav toggler **/
	$('#sm-toggle').click(function(){
	    if($(this).hasClass('closed')){
	    	$('.nav-side-wrap').css('width', '250px');
		$('.nav-brand').css('opacity', '1.0')
		    .animate({opacity: 0}, 400, function(){
			$(this).css('visibility', 'hidden');
		    });
	    	$(this).css('marginRight', '250px');
	    	$(this).removeClass('closed').addClass('open');
	    } else {
		$('.nav-side-wrap').css('width','0px');
		$('.nav-brand').css('opacity', '0')
		    .animate({opacity: 1.0}, 400, function(){
			$(this).css('visibility', 'visible');
		    });
	    	$(this).css('marginRight', '0px');
	    	$(this).removeClass('open').addClass('closed');
	    }
	});
    });

    function loadArticle(pageCount, $grid){
	var data = {
	    action: 'just_get_posts',
	    page: pageCount
	}

	$.ajax({
	    url: justajax.ajaxurl,
	    type: 'POST',
	    data: data,
	    dataType: 'json',
	    success: function(res){
		//hide loader
		//$("#mason-grid").append(res.html);
		var $items = $(res.html);
		$grid.masonry()
		    .append($items)
		    .masonry('appended', $items)
		    .imagesLoaded().progress(function(){
			$grid.masonry('layout');
		    });
		//console.log(res.html);
	    },
	    error: function(e){
		console.log(e);
	    }
	});
    }

})(jQuery);
