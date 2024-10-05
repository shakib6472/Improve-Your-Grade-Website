<?php

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

if ( ! comments_open() ) :
	return;
endif;

global $post;
$all_rating = Edubin_SS_Course_Review::get_average_ratings( $post->ID );
$course_ratings = Edubin_SS_Course_Review::get_detail_ratings( $post->ID );
$all = Edubin_SS_Course_Review::get_all_reviews( $post->ID );
?>
<div id="reviews">
	<div class="box-info-white">
		<h3 class="title"><?php echo __('Feedback', 'edubin'); ?></h3>
		<div class="d-md-flex">
			<div class="detail-average-rating flex-column d-flex align-items-center justify-content-center">
				<div class="average-value"><?php echo number_format((float)$all_rating, 1, '.', ''); ?></div>
				<div class="average-star">
					<?php Edubin_SS_Course_Review::display_review( $all_rating ); ?>
				</div>
				<div class="total-rating">
					<?php $all ? printf( _n( '%1$s rating', '%1$s ratings', $all, 'edubin' ), number_format_i18n( $all ) ) : esc_html_e( '0 rating', 'edubin' ); ?>
				</div>
			</div>

			<div class="detail-rating">
				<?php for ( $i = 5; $i >= 1; $i -- ) : ?>
					<div class="item-rating">
						<div class="list-rating">
							
							<div class="value-content">
								<div class="progress">
									<div class="progress-bar progress-bar-success" style="<?php echo esc_attr(( $all && !empty( $course_ratings[$i]->quantity ) ) ? esc_attr( 'width: ' . ( $course_ratings[$i]->quantity / $all * 100 ) . '%' ) : 'width: 0%'); ?>">
									</div>
								</div>
								<div class="value">
									<div class="d-flex align-items-center">
										<div class="review-stars-rated">
								            <ul class="review-stars">
								                <li><span class="ri-star-line"></span></li>
								                <li><span class="ri-star-line"></span></li>
								                <li><span class="ri-star-line"></span></li>
								                <li><span class="ri-star-line"></span></li>
								                <li><span class="ri-star-line"></span></li>
								            </ul>
								            
								            <ul class="review-stars filled" style="width: <?php echo trim($i*20) ?>%">
								                <li><span class="ri-star-line"></span></li>
								                <li><span class="ri-star-line"></span></li>
								                <li><span class="ri-star-line"></span></li>
								                <li><span class="ri-star-line"></span></li>
								                <li><span class="ri-star-line"></span></li>
								            </ul>
								        </div>
								        <div class="ms-auto">
											<?php echo trim( ( $all && !empty( $course_ratings[$i]->quantity ) ) ?  number_format(( $course_ratings[$i]->quantity / $all * 100 ), 0) . '%' : '0%' ); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	</div>

	<?php if ( have_comments() ) : ?>
		<div id="comments" class="box-info-white comments-course">
			<h3 class="title"><?php echo sprintf(_n(__('Review', 'edubin').' <small>(%s)</small>', __('Reviewddds', 'edubin').' <small>(%s)</small>', $all), $all); ?></h3>
			<ol class="comment-list">
				<?php wp_list_comments( array( 'callback' => array( 'Edubin_SS_Course_Review', 'ss_course_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="edubin-pagination-wrapper">';
				paginate_comments_links( apply_filters( 'edubin_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>
		</div>
	<?php endif; ?>

	<?php $commenter = wp_get_current_commenter(); ?>
	<div id="review_form_wrapper" class="commentform box-info-white">
		<div class="reply_comment_form hidden">
			<?php
				$comment_form = array(
					'title_reply'          => __( 'Reply comment', 'edubin' ),
					'title_reply_to'       => __( 'Leave a Reply to %s', 'edubin' ),
					'comment_notes_before' => '',
					'comment_notes_after'  => '',
					'fields'               => array(
						'author' => '<div class="row"><div class="col-12 col-sm-6"><div class="form-group">'.
						            '<label>'.esc_attr__('Name', 'edubin').'</label>
						            <input id="author" class="form-control" placeholder="'.esc_attr__( 'Your Name', 'edubin' ).'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></div></div>',
						'email'  => '<div class="col-12 col-sm-6"><div class="form-group">' .
						            '<label>'.esc_attr__('Email', 'edubin').'</label>
						            <input id="email" placeholder="'.esc_attr__( 'your@mail.com', 'edubin' ).'" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div></div>',
						            'url' => '<div class="col-12 col-sm-6 d-none"><div class="form-group"><label>'.__( 'Website', 'edubin' ).'</label>
                                            <input id="url" name="url" placeholder="'.esc_attr__( 'Your Website', 'edubin' ).'" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  />
                                       	</div></div></div>',
					),
					'label_submit'  => __( 'Submit', 'edubin' ),
					'logged_in_as'  => '',
					'comment_field' => '',
					'title_reply_before' => '<h4 class="title comment-reply-title">',
					'title_reply_after'  => '</h4>',
					'class_form'  => 'comment-form-theme',
					'class_submit' => 'btn btn-theme'
				);

				$comment_form['comment_field'] .= '<div class="form-group"><label>'.esc_attr__('Reviews', 'edubin').'</label><textarea placeholder="'.esc_attr__( 'Write Reviews', 'edubin' ).'" id="comment" class="form-control" name="comment" cols="45" rows="5" aria-required="true" placeholder="'.esc_attr__( 'Write Reviews', 'edubin' ).'"></textarea></div>';
				
				$comment_form['must_log_in'] = '<p class="must-log-in">' .  __( 'You must be logged in to reply this review.', 'edubin' ) . '</p>';
				
				edubin_hidden_comment_form($comment_form);
			?>
		</div>

		<div id="review_form">
			<?php
				$comment_form = array(
					'title_reply'          => have_comments() ? __( 'Add a review', 'edubin' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'edubin' ), get_the_title() ),
					'title_reply_to'       => __( 'Leave a Reply to %s', 'edubin' ),
					'comment_notes_before' => '',
					'comment_notes_after'  => '',
					'fields'               => array(
						'author' => '<div class="row"><div class="col-12 col-sm-6"><div class="form-group">'.
						            '<label>'.esc_attr__('Name', 'edubin').'</label>
						            <input id="author" placeholder="'.esc_attr__( 'Your Name', 'edubin' ).'" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></div></div>',
						'email'  => '<div class="col-12 col-sm-6"><div class="form-group">' .
						            '<label>'.esc_attr__('Email', 'edubin').'</label>
						            <input id="email" placeholder="'.esc_attr__( 'your@mail.com', 'edubin' ).'" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div></div>',
						            'url' => '<div class="col-12 col-sm-6 d-none"><div class="form-group"><label>'.__( 'Website', 'edubin' ).'</label>
                                            <input id="url" placeholder="'.esc_attr__( 'Your Website', 'edubin' ).'" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  />
                                       	</div></div></div>',
					),
					'label_submit'  => __( 'Submit Review', 'edubin' ),
					'logged_in_as'  => '',
					'comment_field' => '',
					'title_reply_before' => '<h4 class="title comment-reply-title">',
					'title_reply_after'  => '</h4>',
					'class_form'  => 'comment-form-theme',
					'class_submit' => 'btn btn-theme'
				);

				
				$comment_form['must_log_in'] = '<div class="must-log-in">' .  __( 'You must be logged in to post a review.', 'edubin' ) . '</div>';
				

				$comment_form['comment_field'] = '<div class="choose-rating clearfix"><div class="choose-rating-inner">'.'

					<div class="form-group yourview"><div class="tpc-custom-rating-form"><label for="rating">' . __( 'What is it like to Course?', 'edubin' ) .'</label>
						<div class="review-stars-wrap">						
						<ul class="review-stars">
							<li><span class="ri-star-line"></span></li>
							<li><span class="ri-star-line"></span></li>
							<li><span class="ri-star-line"></span></li>
							<li><span class="ri-star-line"></span></li>
							<li><span class="ri-star-line"></span></li>
						</ul>
						<ul class="review-stars filled">
							<li><span class="ri-star-line"></span></li>
							<li><span class="ri-star-line"></span></li>
							<li><span class="ri-star-line"></span></li>
							<li><span class="ri-star-line"></span></li>
							<li><span class="ri-star-line"></span></li>
						</ul></div>
						<input type="hidden" value="5" name="rating" id="edubin_input_rating">
						</div></div></div></div>
						' ;
				

				$comment_form['comment_field'] .= '<div class="form-group"><label>'.esc_attr__('Reviews', 'edubin').'</label><textarea id="comment" class="form-control" placeholder="'.esc_attr__( 'Write Reviews', 'edubin' ).'" name="comment" cols="45" rows="5" aria-required="true"></textarea></div>';
				
				edubin_hidden_comment_form($comment_form);
			?>
		</div>
	</div>
</div>