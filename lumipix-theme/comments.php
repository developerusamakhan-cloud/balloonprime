<?php
/**
 * Comments.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="comments">
	<?php if ( have_comments() ) : ?>
		<h2 class="section-title section-title--sm">
			<?php
			/* translators: %d: comment count */
			printf( esc_html( _n( '%d comment', '%d comments', get_comments_number(), 'lumipix' ) ), (int) get_comments_number() );
			?>
		</h2>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 40,
				)
			);
			?>
		</ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>
	<?php comment_form(); ?>
</section>
