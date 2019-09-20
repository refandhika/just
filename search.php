<?php
global $wp_query;

get_header(); ?>

<main id="main-content" class="content-container">
    <div class="search-desc">Search Result for <span><?= $_GET['s']; ?></span></div>
    <div id="mason-grid" class="content-wrap" data-max-page="<?= $wp_query->max_num_pages; ?>">
	<div class="grid-sizer"></div>

	<?php get_template_part('loop'); ?>

    </div>
    <div id="eotl">End of the Line</div>
</main>

<?php 

get_footer();
