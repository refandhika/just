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
