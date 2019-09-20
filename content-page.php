<div id="content" class="page-wrap">
<?php if(have_posts()){ ?>
    <?php while(have_posts()){ ?>
	<?php the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	    <header class="entry-header">
		<?php if( is_singular() ) { ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php } ?>
		<?php if( function_exists( 'the_subtitle' ) ) { ?>
		<h2 class="entry-subtitle"><?php the_subtitle(); ?></h2>
		<?php } ?>
	    </header>
	    <?php if(has_post_thumbnail()){ ?>
	    <div class="post-thumbnail">
	    	<?php the_post_thumbnail(); ?>
	    </div>
	    <?php } ?>
	    <div class="entry-content">
		<?php the_content(); ?>
	    </div>
	</article>
    <?php } ?>
<?php } ?>
</div>
