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
	$widgy .= 'content';
	$widgy .= $args['after_widget'];

	echo $widgy;
    }

    public function form( $instance ){
	if(isset($instance['title'])){
	    $title = $instance['title'];
	} else {
	    $title = 'New Title';
	}
	if(isset($instance['item_count'])){
	    $item_count = $instance['item_count'];
	} else {
	    $item_count = '5';
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
	return $instance;
    }

}
