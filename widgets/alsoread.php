<?php

class just_alsoread extends WP_Widget {

    function __construct() {
	parent::__construct(
	    'just_alsoread',
	    'Just Also Read',
	    array('description' => 'Show post on the site randomly')
	);
    }

    public function widget( $args, $instance ){
	$title = apply_filters('widget_title', $instance['title']);
	
	$widgy = $args['before_widget'];
	if(!empty($title)){
	    $widgy .= $args['before_title'] . $title . $args['after_title'];
	}

	$post_args = array(
	    'post_type' => 'post',
	    'orderby' => 'rand',
	    'posts_per_page' => $instance['item_count'],
    	);

	$the_query = new WP_Query( $post_args );

	if($the_query->have_posts()){
	    while($the_query->have_posts()){
		$the_query->the_post();
		$widgy .= '<div class="alsoread-item">';
		    $widgy .= '<div class="alsoread-img">';
		        $widgy .= '<a href="'.get_the_permalink().'">';
			    $widgy .= wp_get_attachment_image(get_post_thumbnail_id(), 'medium');
			$widgy .= '</a>';
		    $widgy .= '</div>';
		    $widgy .= '<div class="alsoread-detail">';
			$widgy .= '<a href="'.get_the_permalink().'">';
		    	    $widgy .= '<div class="alsoread-title">'.get_the_title().'</div>';
		    	$widgy .= '</a>';
			
		        $cats = get_the_category(get_the_ID());
			if(empty($cats[0]->term_id)){
			    $cats = get_the_category(1);
			}

			$widgy .= '<a href="'.get_category_link($cats[0]->term_id).'">';
			    $widgy .= '<div class="alsoread-category">'.$cats[0]->name.'</div>';
			$widgy .= '</a>';
		    $widgy .= '</div>';
	    	$widgy .= '</div>';
	    }
	    wp_reset_postdata();
	} else {
	    $widgy .= '<div class="alsoread-noitem">No posts found</div>';
	}

	$widgy .= $args['after_widget'];

	echo $widgy;
    }

    public function form( $instance ){
	if(isset($instance['title'])){
	    $title = $instance['title'];
	} else {
	    $title = 'Also Read';
	}
	if(isset($instance['item_count'])){
	    $item_count = $instance['item_count'];
	} else {
	    $item_count = 5;
	}

	$form = '<p>';
	$form .= '<label for="'.$this->get_field_id('title').'">Title:</label>';
	$form .= '<input class="widefat" id="'.$this->get_field_id('title').'" ';
	$form .= 'name="'.$this->get_field_name('title').'" ';
	$form .= 'type="text" value="'.esc_attr($title).'">';
	$form .= '</p>';
	
	$form .= '<p>';
	$form .= '<label for="'.$this->get_field_id('item_count').'">Item Count:</label>';
	$form .= '<input class="widefat" id="'.$this->get_field_id('item_count').'" ';
	$form .= 'name="'.$this->get_field_name('item_count').'" ';
	$form .= 'type="number" value="'.esc_attr($item_count).'">';
	$form .= '</p>';


	echo $form;
    }

    public function update( $new, $old ){
	$instance = array();
	$instance['title'] = ( !empty($new['title']) ) ? strip_tags($new['title']) : '' ;
	$instance['item_count'] = ( !empty($new['item_count']) ) ? strip_tags($new['item_count']) : '' ;
	return $instance;
    }

}
