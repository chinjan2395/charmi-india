<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section
 *
 * @link     https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package  Brook
 * @since    1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php Brook_THA::instance()->head_top(); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php Brook_THA::instance()->head_bottom(); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php Brook::body_attributes(); ?>>

<?php Brook_Templates::pre_loader(); ?>

<?php Brook_THA::instance()->body_top(); ?>

<div id="page" class="site">
	<div class="content-wrapper">
		<?php Brook_Templates::slider( 'above' ); ?>
		<?php Brook_Templates::top_bar(); ?>
		<?php Brook_Templates::header(); ?>
		<?php Brook_Templates::slider( 'below' ); ?>
