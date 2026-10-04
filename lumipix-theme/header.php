<?php
/**
 * Site header.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#FAFAF7" media="(prefers-color-scheme: light)">
	<meta name="theme-color" content="#0B0B12" media="(prefers-color-scheme: dark)">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link visually-hidden-focusable" href="#main"><?php esc_html_e( 'Skip to content', 'lumipix' ); ?></a>

<header class="site-header" data-header>
	<div class="container site-header__inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php
			if ( has_custom_logo() ) {
				$logo_id = get_theme_mod( 'custom_logo' );
				echo wp_get_attachment_image( $logo_id, 'full', false, array( 'class' => 'brand__logo', 'alt' => get_bloginfo( 'name' ) ) );
			} else {
				echo lumipix_logo_mark( 30 ); // phpcs:ignore WordPress.Security.EscapeOutput
				echo '<span class="brand__name">' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
			}
			?>
		</a>

		<nav class="primary-nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'lumipix' ); ?>" data-nav>
			<?php lumipix_primary_nav(); ?>
		</nav>

		<div class="site-header__actions">
			<button class="icon-btn" type="button" data-theme-toggle aria-label="<?php esc_attr_e( 'Toggle dark mode', 'lumipix' ); ?>">
				<span class="theme-icon theme-icon--sun"><?php echo lumipix_icon( 'sun', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<span class="theme-icon theme-icon--moon"><?php echo lumipix_icon( 'moon', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
			</button>
			<?php
			$cta_url = lumipix_tool_url( 'compress-image' );
			if ( $cta_url ) :
				?>
				<a class="btn btn--primary btn--sm site-header__cta" href="<?php echo esc_url( $cta_url ); ?>"><?php esc_html_e( 'Start free', 'lumipix' ); ?></a>
			<?php endif; ?>
			<button class="icon-btn nav-toggle" type="button" aria-controls="primary-nav" aria-expanded="false" data-nav-toggle>
				<span class="nav-toggle__open"><?php echo lumipix_icon( 'menu', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<span class="nav-toggle__close"><?php echo lumipix_icon( 'x', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<span class="visually-hidden"><?php esc_html_e( 'Menu', 'lumipix' ); ?></span>
			</button>
		</div>
	</div>
</header>

<main id="main" class="site-main">
