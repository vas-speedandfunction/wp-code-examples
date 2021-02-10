<?php
/**
 * Build markup for the Homepage Header Block
 *
 * @package BeckMainTheme-child
 */

// filter for Frontend output.
add_filter( 'lazyblock/homepage-header-block/frontend_callback', 'homepage_header_block', 10, 2 );
// filter for Editor output.
if ( ! function_exists( 'homepage_header_block' ) ) :
	/**
	 * Render Callback
	 *
	 * @param string $output     - block output.
	 * @param array  $attributes - block attributes.
	 */
	function homepage_header_block( $output, $attributes ) {
		ob_start();
		$background_image = ( has_post_thumbnail( $post->ID ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ) : '' );
		if ( empty( $background_image ) === false && count( $background_image ) > 0 ) {
			$background_image = $background_image[0];
		} else {
			$background_image = '';
		}

		$background_cf_image        = get_field( 'background_image' );
		$background_cf_image_mobile = get_field( 'background_image_mobile' );

		if ( empty( $background_cf_image_mobile ) ) {
			if ( ! empty( $background_cf_image ) ) {
				$background_cf_image_mobile = $background_cf_image;
			} else {
				$background_cf_image_mobile = $background_image;
			}
		}
		if ( empty( $background_cf_image ) ) {
			$background_cf_image = $background_image;
		}

		?>
		<div class="home-header">
			<?php if ( ! empty( $background_image ) ) : ?>
				<img src="<?php echo esc_html( $background_cf_image ); ?>" class="home-header__image">
			<?php endif; ?>
			<img src="<?php echo esc_html( $background_cf_image_mobile ); ?>" class="home-header__image--mobile">
			<div class="home-header__top-gradient"></div>
			<div class="home-header__left-gradient"></div>
			<div class="home-header__mobile-background"></div>
			<div class="container">
				<div class="home-header__wrapper">
					<h2 class="home-header__title"><?php echo esc_html( $attributes['heading'] ); ?></h2>
					<div class="home-header__carousel">
						<h4 class="home-header__carousel__label"><?php echo esc_html( $attributes['heading'] ); ?></h4>
						<div class="home-header__carousel__grid">
							<?php
							foreach ( $attributes['item-list'] as $item ) :
								$target = $item['target'] ? ' target="_blank"' : '';
								?>
							<a href="<?php echo esc_html( $item['item-url'] ); ?> "  <?php echo esc_html( $target ); ?>  class="home-header__carousel__grid__item" ><?php echo esc_html( $item['item-title'] ); ?> <span class="home-header__carousel__grid__item__button"><i class="zmdi zmdi-caret-right"></i></span></a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
endif;
