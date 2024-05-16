<?php

if (!defined('ABSPATH')) {
    exit;
}

define('TIP_THEME_DIR', get_template_directory());
define('TIP_THEME_URL', get_template_directory_uri());

define('TIP_VERSION', '1.0');

if (! function_exists('tip_setup')) {
    /**
     * Set up theme support.
     *
     * @return void
     */
    function tip_setup()
    {
        load_theme_textdomain('tip', get_template_directory() . '/languages');

        register_nav_menus([ 'menu-1' => __('Header', 'tip') ]);

        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support(
            'custom-logo',
            [
                'height'      => 100,
                'width'       => 350,
                'flex-height' => true,
                'flex-width'  => true,
            ]
        );
    }
}
add_action('after_setup_theme', 'tip_setup');

add_filter('wp_sitemaps_add_provider', function ($provider, $name) {
    return ($name == 'users') ? false : $provider;
}, 10, 2);

if (! function_exists('tip_scripts_styles')) {
    function tip_scripts_styles()
    {
        wp_enqueue_style(
            'tip',
            get_template_directory_uri() . '/style.css',
            [],
            TIP_VERSION
        );
    }
}
add_action('wp_enqueue_scripts', 'tip_scripts_styles');

function add_favicon_meta()
{
    ?>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo TIP_THEME_URL;?>/assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo TIP_THEME_URL;?>/assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo TIP_THEME_URL;?>/assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo TIP_THEME_URL;?>/assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo TIP_THEME_URL;?>/assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo TIP_THEME_URL;?>/assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo TIP_THEME_URL;?>/assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo TIP_THEME_URL;?>/assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo TIP_THEME_URL;?>/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo TIP_THEME_URL;?>/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo TIP_THEME_URL;?>/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo TIP_THEME_URL;?>/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo TIP_THEME_URL;?>/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo TIP_THEME_URL;?>/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo TIP_THEME_URL;?>/assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <?php
}

add_action('wp_head', 'add_favicon_meta');

/*
* Copyright
* Usage: [copyright year="2024"]
*/
function copyright_shortcode($atts)
{

    // Attributes
    $atts = shortcode_atts(
        array(
            'year' => '2024',
        ),
        $atts,
        'copyright'
    );

    if(date('Y') == $atts['year']) {
        return '&copy; ' . $atts['year'];
    } else {
        return '&copy; ' . $atts['year'] . '-' . date('Y');
    }

}
add_shortcode('copyright', 'copyright_shortcode');


function tip_tab_shortcode($atts)
{
    // Attributes
    $atts = shortcode_atts(
        array(
            'color' => 'black',
            'count' => '2023',
            'href' => '#',
        ),
        $atts,
        'tip_tab'
    );
    return '<div class="tip-tab"><a href="' . $atts['href'] . '" class="tip-link"><span class="tip-label">' . $atts['count'] . '</span><span class="tip-arrow arrow-' . $atts['color'] . '"></span></a></div>';
}
add_shortcode('tip_tab', 'tip_tab_shortcode');

if(!function_exists('ntis_sitemap')){
    require_once TIP_THEME_DIR .'/inc/shortcodes/sitemap/sitemap.php';
}