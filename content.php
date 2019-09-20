<div id="content" class="article-wrap">
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
		<?php if( 'post' === get_post_type() ) { ?>
		<div class="entry-meta">
		<div class="posted-on">Posted On <time class="entry-date" datetime="<?= get_the_date(DATE_W3C); ?>"><?= get_the_date(); ?></time></div>
		<span>|</span>
		<div class="posted-by">Posted By <span class="entry-author"><a href="<?= get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?= get_the_author(); ?></a></span></div>
		</div>
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
	    <footer class="entry-footer">
		<?php if('post' === get_post_type()){ ?>
		    <?php $tags = get_the_tags(get_the_ID()); ?>
		    <?php if(!empty($tags)){ ?>
		    <div class="entry-tags">
			<span class="tags-label">Tags</span>
		    <?php foreach($tags as $tag){ ?>
			    <a class="btn-tag" href="<?= site_url('/tag/'.$tag->slug); ?>"><?= $tag->name; ?></a>
		    <?php } ?> 
		    </div>
		    <?php } ?>
		    <?php comments_template(); ?>
		<?php } ?>
	    </footer>
	</article>
    <?php } ?>
<?php } ?>
</div>
