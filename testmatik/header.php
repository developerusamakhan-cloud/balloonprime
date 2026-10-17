<?php
/**
 * Header.
 *
 * @package Testmatik
 */

defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'İçeriğe geç', 'testmatik' ); ?></a>
<header class="site-header" data-header>
	<div class="container site-header__inner">
		<?php testmatik_site_logo(); ?>
		<nav class="nav" id="site-nav" aria-label="<?php esc_attr_e( 'Ana menü', 'testmatik' ); ?>" data-nav>
			<?php testmatik_primary_nav(); ?>
		</nav>
		<div class="site-header__actions">
			<button class="icon-btn" type="button" data-theme-toggle aria-label="<?php esc_attr_e( 'Açık / koyu tema', 'testmatik' ); ?>">
				<span class="icon-btn__sun"><?php echo testmatik_icon( 'sun', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<span class="icon-btn__moon"><?php echo testmatik_icon( 'moon', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
			</button>
			<?php $first = testmatik_tool_url( 'klavye-testi' ); ?>
			<?php if ( $first ) : ?>
				<a class="btn btn--primary btn--sm site-header__cta" href="<?php echo esc_url( home_url( '/#testler' ) ); ?>"><?php esc_html_e( 'Test seç', 'testmatik' ); ?></a>
			<?php endif; ?>
			<button class="icon-btn nav-toggle" type="button" aria-controls="site-nav" aria-expanded="false" data-nav-toggle aria-label="<?php esc_attr_e( 'Menüyü aç', 'testmatik' ); ?>">
				<span class="nav-toggle__open"><?php echo testmatik_icon( 'menu', 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<span class="nav-toggle__close"><?php echo testmatik_icon( 'close', 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
			</button>
		</div>
	</div>
</header>
<main id="main" class="site-main">
