<?php
global $wp_query;

get_header(); ?>

<main id="main-content" class="content-container">
    <div class="category-detail content-wrap">
        <h1 class="category-title"><?= single_cat_title(); ?></h1>
    	<div class="category-desc"><?= category_description(); ?></div>
    </div>
    <div id="mason-grid" class="content-wrap" data-max-page="<?= $wp_query->max_num_pages; ?>">
	<div class="grid-sizer"></div>

	<?php get_template_part('loop'); ?>

    </div>
    <div id="eotl">End of the Line</div>
</main>

<?php 

get_footer();
