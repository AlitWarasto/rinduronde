<?php

if ( ! defined( 'ABSPATH' ) ) exit; # Exit if accessed directly
$siteurl  = get_option('siteurl');
$sitename = get_option('blogname');
$sitedesc = get_option('blogdescription');
$themeurl = get_bloginfo('template_url');

/*=== Mobile View Detection ===
require get_template_directory().'/inc/md/Mobile_Detect.php';*/

function load_stylesheets(){
   /* wp_register_style('bootstrap', get_template_directory_uri(). '/assets/css/bootstrap.min.css', '',4.0,'all');
    wp_register_style('fontawesome', get_template_directory_uri(). '/assets/fa/css/fontawesome.min.css', '',5.1,'all');
    wp_register_style('swiper', get_template_directory_uri(). '/assets/css/swiper-bundle.min.css', '',3.0,'all');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('swiper');
    wp_enqueue_style('fontawesome');
    $detect = new Mobile_Detect; #mobile detect#
    if ( $detect->isMobile() && !$detect->isTablet() ){
        wp_register_style('appcssm', get_template_directory_uri(). '/assets/css/appm.css', '',0.1,'all');
        wp_enqueue_style('appcssm');
    }else{*/
        wp_register_style('appcss', get_template_directory_uri(). '/assets/css/app.css', '',0.1,'all');
        wp_enqueue_style('appcss');
 /*   }*/
}

add_action('wp_enqueue_scripts','load_stylesheets',1);
/*function load_javascript(){
    wp_register_script('jquery351', get_template_directory_uri(). '/assets/js/jquery351.js','', 3.5, true);
    wp_register_script('bootstrap', get_template_directory_uri(). '/assets/js/bootstrap.min.js','', 4.0, true);
    wp_register_script('fontawesome', get_template_directory_uri(). '/assets/fa/js/fontawesome.min.js','', 4.0, true);
    wp_register_script('swiper', get_template_directory_uri(). '/assets/js/swiper-bundle.min.js','jquery', 3, true);
    wp_register_script('appjs', get_template_directory_uri(). '/assets/js/app.js','',0.1, true);
    wp_enqueue_script('jquery351');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('fontawesome');
    wp_enqueue_script('swiper');
    wp_enqueue_script('appjs');
}
add_action('wp_enqueue_scripts', 'load_javascript');*/

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