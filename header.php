<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <title><?php bloginfo('name'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php if(is_singular() && get_option('thread_comment')) wp_enqueue_scripts('comment-reply'); ?>
        <?php wp_head(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body <?php body_class(); ?>>

    <div id="main" class="main-container">

	<nav id="main-nav" class="nav-top">
	    <div class="nav-top-wrap">
	    <div class="nav-brand"><a href="<?= site_url(); ?>"><?= bloginfo('name'); ?></a></div>
		<ul class="nav-item-wrap">
	        <?php $menus = wp_get_nav_menu_items('header-menu'); ?>
	        <?php if(!empty($menus)){ ?>
	    	    <?php foreach($menus as $menu){ ?>
		    <li class="nav-item"><a href="<?= $menu->url; ?>"><?= $menu->title; ?></a></li>
	    	    <?php } ?>
	        <?php } ?>
	        </ul>
	    </div>
       </nav>

	<nav id="main-nav-small" class="nav-top">
	    <div class="nav-top-wrap">
		<div class="nav-top-inside">
		    <div class="nav-brand"><a href="<?= site_url(); ?>"><?= bloginfo('name'); ?></a></div>
		    <div id="sm-toggle" class="nav-toggle closed"></div>
		</div>
	    </div>
	    <div class="nav-side-wrap">
		<div class="nav-side-title">Directory</div>
		<ul class="nav-item-wrap">
	        <?php $menus = wp_get_nav_menu_items('header-menu'); ?>
	        <?php if(!empty($menus)){ ?>
	    	    <?php foreach($menus as $menu){ ?>
		    <li class="nav-item"><a href="<?= $menu->url; ?>"><?= $menu->title; ?></a></li>
	    	    <?php } ?>
	        <?php } ?>
	        </ul>
	    </div>
       </nav>


