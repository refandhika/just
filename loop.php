<?php if(have_posts()){ ?>
    <?php while(have_posts()){ ?>
	<?php the_post(); ?>
	<article class="entry-box">
	    <div class="entry-wrap">
	    	<div class="entry-img">
	    	    <a href="<?= the_permalink(); ?>">
		    	<?= wp_get_attachment_image( get_post_thumbnail_id(), 'medium'); ?>
	    	    </a>
	    	</div>
	    	<div class="entry-detail">
		    <a href="<?= the_permalink(); ?>">
		    	<h1 class="entry-title"><?= the_title(); ?></h1>
		    </a>
		    <?php $cats = get_the_category(get_the_ID()); 
		    if( empty($cats[0]->term_id) ){
		    	$cats = get_the_category(1);
		    } ?>
		    <a href="<?= get_category_link( $cats[0]->term_id ); ?>">
		    	<span><?= $cats[0]->name; ?></span>
		    </a>
	    	</div>
	    </div>
	</article>
    <?php } ?>
<?php } ?>

