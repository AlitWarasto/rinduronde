<?php

if ( ! defined( 'ABSPATH' ) ) exit; # Exit if accessed directly
$siteurl  = get_option('siteurl');
$sitename = get_option('blogname');
$sitedesc = get_option('blogdescription');
$themeurl = get_bloginfo('template_url');

/*=== Mobile View Detection ===
require get_template_directory().'/inc/md/Mobile_Detect.php';*/

function load_stylesheets(){
   /**/ 
		wp_register_style('mobiriseicon', get_template_directory_uri(). '/assets/web/assets/mobirise-icons2/mobirise2.css', '',2.0,'all');
		wp_register_style('tether', get_template_directory_uri(). '/assets/tether/tether.min.css', '',1.0,'all');
		wp_register_style('bootstrap', get_template_directory_uri(). '/assets/bootstrap/css/bootstrap.min.css', '',4.0,'all');
		wp_register_style('bootstrapgrid', get_template_directory_uri(). '/assets/bootstrap/css/bootstrap-grid.min.css', '',4.0,'all');
		wp_register_style('bootstrapreboot', get_template_directory_uri(). '/assets/bootstrap/css/bootstrap-reboot.min.css', '',4.0,'all');
		wp_register_style('dropdown', get_template_directory_uri(). '/assets/dropdown/css/style.css', '',5.1,'all');
		wp_register_style('socicon', get_template_directory_uri(). '/assets/socicon/css/styles.css', '',3.0,'all');
		wp_register_style('themestyle', get_template_directory_uri(). '/assets/theme/css/style.css', '',3.0,'all');
		wp_register_style('addstyle', get_template_directory_uri(). '/assets/mobirise/css/mbr-additional.css', '',3.0,'all');
		wp_register_style('appcss', get_template_directory_uri(). '/assets/css/app.css', '',0.1,'all');
    
    wp_enqueue_style('mobiriseicon');
    wp_enqueue_style('tether');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('bootstrapgrid');
    wp_enqueue_style('bootstrapreboot');
    wp_enqueue_style('dropdown');
    wp_enqueue_style('socicon');
    wp_enqueue_style('themestyle');
    wp_enqueue_style('addstyle');
    wp_enqueue_style('appcss');
}

add_action('wp_enqueue_scripts','load_stylesheets',1);
/**/
function load_javascript(){
    wp_register_script('jquery351', get_template_directory_uri(). '/assets/web/assets/jquery/jquery.min.js','', 3.5, true);
    wp_register_script('popper', get_template_directory_uri(). '/assets/popper/popper.min.js','', 4.0, true);
    wp_register_script('tether', get_template_directory_uri(). '/assets/tether/tether.min.js','jquery', 3, true);
    wp_register_script('bootstrap', get_template_directory_uri(). '/assets/bootstrap/js/bootstrap.min.js','', 4.0, true);
    wp_register_script('scroll', get_template_directory_uri(). '/assets/smoothscroll/smooth-scroll.js','', 4.0, true);
    wp_register_script('parallax', get_template_directory_uri(). '/assets/parallax/jarallax.min.js','', 4.0, true);
    wp_register_script('dropdown', get_template_directory_uri(). '/assets/dropdown/js/nav-dropdown.js','', 4.0, true);
    wp_register_script('dropdownNav', get_template_directory_uri(). '/assets/dropdown/js/navbar-dropdown.js','', 4.0, true);
    wp_register_script('touchswipe', get_template_directory_uri(). '/assets/touchswipe/jquery.touch-swipe.min.js','', 4.0, true);
    wp_register_script('theme', get_template_directory_uri(). '/assets/theme/js/script.js','', 4.0, true);
    wp_register_script('appjs', get_template_directory_uri(). '/assets/js/app.js','',0.1, true);

    wp_enqueue_script('jquery351');
    wp_enqueue_script('popper');
    wp_enqueue_script('tether');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('scroll');
    wp_enqueue_script('parallax');
    wp_enqueue_script('dropdown');
    wp_enqueue_script('dropdownNav');
    wp_enqueue_script('touchswipe');
    wp_enqueue_script('theme');
    wp_enqueue_script('appjs');
}
add_action('wp_enqueue_scripts', 'load_javascript');

function fle_logo() {
    $defaults = array(
        'height'               => '',
        'width'                => '',
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => true, 
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'fle_logo' );

function change_logo_class( $html ) {

    $html = str_replace( 'custom-logo', 'img-fluid', $html );
    $html = str_replace( 'img-fluid-link', 'aLogo', $html );
    $html = str_replace( 'width', '', $html );
    $html = str_replace( 'height', '', $html );

    return $html;
}
add_filter( 'get_custom_logo', 'change_logo_class' );

#remove width & height attributes from images
function remove_img_attr ($html)
{
    return preg_replace('/(width|height)="\d+"\s/', "", $html);
}
add_filter( 'post_thumbnail_html', 'remove_img_attr' );
add_filter( 'image_send_to_editor', 'remove_img_attr' );
add_filter( 'the_content', 'remove_img_attr', 10 );

#disable srcset on frontend
function disable_wp_responsive_images() {
    return 1;
}
add_filter('max_srcset_image_width', 'disable_wp_responsive_images');