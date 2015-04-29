<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till content wrapper
 *
 * @package MuLo
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php
    wp_head();
    ?>
</head>

<body <?php body_class(); ?>>
<header id="cd-header">
    <!--    <div id="header">-->
    <!--        <div id="sitebranding">-->
    <?php if (function_exists('has_site_logo') && has_site_logo()) : ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
            <img src="<?php echo esc_url(get_site_logo('url')); ?>" class="site-logo"
                 alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
        </a>
    <?php endif; // End site logo check. ?>
    <h1 class="sitetitle">
        <a href="<?php echo esc_url(home_url('/')); ?>"
           title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"
           rel="home"><?php bloginfo('name'); ?></a>
    </h1>
<!--    <div>--><?php //bloginfo('description'); ?><!--</div>-->
    <!--        </div>-->
    <!--End Site Branding -->
    <!--    </div>-->
</header>
<!--End Header -->