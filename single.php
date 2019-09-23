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

<footer class="page-footer">
    <div class="footer-wrap">
    <div class="footer-flex">
	<div class="site-name">&copy; 2019 - <?= date('Y'); ?> | <a href="<?= site_url(); ?>"><?= bloginfo('name'); ?></a></div>
	<ul class="footer-nav">
	<?php $menus = wp_get_nav_menu_items('footer-menu'); ?>
	<?php if(!empty($menus)){ ?>
	    <?php foreach($menus as $menu){ ?>
	    <li class="nav-item"><a href="<?= $menu->url; ?>"><?= $menu->title; ?></a></li>
	    <?php } ?>
	<?php } ?>
	</ul>
    </div>
    </div>
</footer>

<?php 

get_footer();
