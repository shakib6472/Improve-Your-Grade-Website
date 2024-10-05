<?php
/**
 * @var object $course
 * @var boolean $with_image
 */

$with_image = isset( $with_image ) ? $with_image : false;
?>

<div class="masterstudy-single-course-description">
	<?php if (Edubin::setting( 'ms_intro_video_position' ) == 'intro_video_content' ): ?>
		
	<?php if ( ! empty( $course->thumbnail ) && $with_image ) { ?>
		<img class="masterstudy-single-course-description__image" src="<?php echo esc_url( $course->thumbnail['url'] ); ?>" alt="<?php echo esc_html( $course->thumbnail['title'] ); ?>">
	<?php } ?>

	<?php endif ?>
	
	<div class="masterstudy-single-course-description__content">
		<?php
		$post = get_post( $course->id );
		setup_postdata( $post );
		the_content();
		wp_reset_postdata();
		?>
	</div>
	<?php if ( ! empty( $course->attachments ) ) { ?>
		<div class="masterstudy-single-course-description__files">
			<?php
			STM_LMS_Templates::show_lms_template(
				'components/course/materials',
				array(
					'attachments' => $course->attachments,
				)
			);
			?>
		</div>
	<?php } ?>
</div>
