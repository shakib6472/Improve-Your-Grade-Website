<?php $full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>

<ul class="edubin-social-share-icons-wrapper">
	<?php do_action( 'edubin_social_share_items_before' ); ?>
	
	<?php if ( Edubin::setting( 'social_shear_facebook' ) ) : ?>
		<li class="edubin-social-share-each-icon facebook">
			<a class="edubin-social-share-link" href="https://www.facebook.com/sharer.php?s=100&u=<?php the_permalink(); ?>&i=<?php echo urlencode($full_image ? $full_image[0] : ''); ?>" target="_blank" title="<?php esc_attr_e( 'Share on facebook', 'edubin' ); ?>">
				<i class="icon-facebook"></i>
			</a>
	 	</li>
	<?php endif; ?>

	<?php if ( Edubin::setting( 'social_shear_twitter' ) ) : ?>
 		<li class="edubin-social-share-each-icon twitter">
			<a class="edubin-social-share-link" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank" title="<?php esc_attr_e( 'Share on Twitter', 'edubin' ); ?>">
				<i class="icon-twitter"></i>
			</a>
 		</li>
	<?php endif; ?>

	<?php if ( Edubin::setting( 'social_shear_linkedin' ) ) : ?>
 		<li class="edubin-social-share-each-icon linkedin">
			<a class="edubin-social-share-link" href="https://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" title="<?php esc_attr_e( 'Share on LinkedIn', 'edubin' ); ?>">
				<i class="icon-linkedin2"></i>
			</a>
 		</li>
	<?php endif; ?>

	<?php if ( Edubin::setting( 'social_shear_linkedin' ) ) : ?>
 		<li class="edubin-social-share-each-icon pinterest">
			<a class="edubin-social-share-link" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;description=<?php echo urlencode($post->post_title); ?>&amp;media=<?php echo urlencode( $full_image ? $full_image[0] : '' ); ?>" target="_blank" title="<?php esc_attr_e( 'Share on Pinterest', 'edubin' ); ?>">
				<i class="icon-pinterest"></i>
			</a>
 		</li>
	<?php endif; ?>
	<?php do_action( 'edubin_social_share_items_after' ); ?>
</ul>