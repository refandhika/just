<?php

get_header(); ?>

<main id="main-content" class="content-container">
    <div id="main-article" class="content-wrap">

    <?php get_template_part('content'); ?>

    <div id="sidebar" class="sidebar-wrap">
    <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Just Sidebar')){ ?>
    <?php } ?>
    </div>

    </div>
</main>

<?php 

get_footer();
