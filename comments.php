<?php if(post_password_required()){
    return;
} ?>

<?php $args = array(
    'post_id' => get_the_ID(),
    'status' => 'approve'
); 

$comment_query = new WP_Comment_Query;
$comments = $comment_query->query( $args ); ?>

<?php if ( $comments ){ ?>
<div class="entry-comment">
<?php $comment_count = get_comments_number(); ?>
<div class="comment-title"><?= $comment_count; ?> Comment<?php if($comment_count > 1){ echo 's'; } ?></div>
<?php foreach ( $comments as $comment ){ ?>
    <div class="comment-item">
	<div class="comment-pp">
	    <img src="<?= esc_url( get_avatar_url($comment->comment_author_email) ); ?>">
	</div>
	<div class="comment-detail">
	    <header class="comment-header">
		<div class="comment-author"><?= $comment->comment_author; ?></div>
		<time class="comment-time"><?= $comment->comment_date; ?></time>
	    </header>
	    <div class="comment-content"><?= $comment->comment_content; ?></div>
	</div>
    </div>
<?php } ?>
</div>
<?php } else { ?>
<div class="no-comment">Be the first to comment!</div>
<?php } ?>

<?php $args = array(
    'label_summit' => __( 'Send', 'just' ),
    'title_reply' => __( 'Write a Comment', 'just')
); ?>
<?php comment_form($args); ?>
