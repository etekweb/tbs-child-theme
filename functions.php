<?php
/**
 * Theme Functions.
 */

/* Theme Setup */
if ( ! function_exists( 'tech_startup_setup' ) ) :

function tech_startup_setup() {

	$GLOBALS['content_width'] = apply_filters( 'tech_startup_content_width', 640 );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'f1f1f1'
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support('responsive-embeds');
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', advance_startup_font_url() ) );
}
endif;
add_action( 'after_setup_theme', 'tech_startup_setup' );

/* Theme Widgets Setup */
function tech_startup_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'tech-startup' ),
		'description'   => __( 'Appears on blog page sidebar', 'tech-startup' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'tech-startup' ),
		'description'   => __( 'Appears on page sidebar', 'tech-startup' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Third Column Sidebar', 'tech-startup' ),
		'description'   => __( 'Appears on page sidebar', 'tech-startup' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	//Footer widget areas
	$bb_mobile_application_widget_areas = get_theme_mod('bb_mobile_application_footer_widget_areas', '4');
	for ($i=1; $i<=$bb_mobile_application_widget_areas; $i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Nav ', 'tech-startup' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s py-3">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title pb-2 mb-3">',
			'after_title'   => '</h3>',
		) );
	}

	register_sidebar( array(
		'name'          => __( 'Shop Page Sidebar', 'tech-startup' ),
		'description'   => __( 'Appears on shop page', 'tech-startup' ),
		'id'            => 'woocommerce_sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Single Product Page Sidebar', 'tech-startup' ),
		'description'   => __( 'Appears on shop page', 'tech-startup' ),
		'id'            => 'woocommerce-single-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'tech_startup_widgets_init' );

add_action( 'wp_enqueue_scripts', 'tech_startup_enqueue_styles' );
function tech_startup_enqueue_styles() {
	$parent_style = 'advance-startup-basic-style'; // Style handle of parent theme.
	wp_enqueue_style( $parent_style, esc_url(get_template_directory_uri()) . '/style.css' );
	wp_enqueue_style( 'tech-startup-style', get_stylesheet_uri(), array( $parent_style ) );
	wp_enqueue_style( 'tech-startup-modified-style', get_stylesheet_directory_uri() . '/style-overrides.css');
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function tbs_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+ ()-]/', '', $phone );
}

function tech_startup_customize_register() {     
	global $wp_customize;
	$wp_customize->remove_section( 'advance_startup_theme_color_option' );
	
	$wp_customize->remove_setting( 'advance_startup_time' );
	$wp_customize->remove_control( 'advance_startup_time' );

	$wp_customize->remove_setting( 'advance_startup_responsive_sticky_header' );
	$wp_customize->remove_control( 'advance_startup_responsive_sticky_header' );

	$wp_customize->remove_setting( 'advance_startup_sticky_header' );
	$wp_customize->remove_control( 'advance_startup_sticky_header' );

	$wp_customize->remove_setting( 'advance_startup_sticky_header_padding_settings' );
	$wp_customize->remove_control( 'advance_startup_sticky_header_padding_settings' );

	$wp_customize->remove_setting( 'advance_startup_theme_options' );
	$wp_customize->remove_control( 'advance_startup_theme_options' );	
} 
add_action( 'customize_register', 'tech_startup_customize_register', 11 );

// Customizer Section
function tech_startup_customizer ( $wp_customize ) {
	
	$wp_customize->add_setting('tech_startup_tob_bar_info_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tech_startup_tob_bar_info_text',array(
		'label'	=> __('Tob Bar Announcement Text','tech-startup'),
		'section'	=> 'advance_startup_topbar',
		'setting'	=> 'tech_startup_tob_bar_info_text',
		'type'	=> 'text',
	));

	$wp_customize->remove_setting('advance_startup_phone1');
	$wp_customize->remove_control('advance_startup_phone1');
	$wp_customize->add_setting('tbs_phone1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'tbs_sanitize_phone_number',
	));
	$wp_customize->add_control('tbs_phone1',array(
		'label'	=> __('Phone Number','advance-startup'),
		'section'	=> 'advance_startup_topbar',
		'setting'	=> 'tbs_phone1',
		'type'	=> 'text'
	));

	// Partners
	$wp_customize->add_section('tbs_partners',array(
		'title'	=> __('Partners','advance-startup'),
		'description'	=> __('Update partner images','advance-startup'),
		'priority'	=> null,
		'panel' => 'advance_startup_panel_id',
	));
	$wp_customize->add_setting('tbs-logo1', array(
        'transport'     => 'refresh',
        'height'        => 180,
        'width'        => 160,
    ));
    $wp_customize->add_setting('tbs-logo2', array(
        'transport'     => 'refresh',
        'height'        => 180,
        'width'        => 160,
    ));
    $wp_customize->add_setting('tbs-logo3', array(
        'transport'     => 'refresh',
        'height'        => 180,
        'width'        => 160,
    ));
    $wp_customize->add_setting('tbs-logo4', array(
        'transport'     => 'refresh',
        'height'        => 180,
        'width'        => 160,
    ));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tbs-logo1', array(
        'label'             => __('Logo 1', 'tbs-child-theme'),
        'section'           => 'tbs_partners',
        'settings'          => 'tbs-logo1',    
    )));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tbs-logo2', array(
        'label'             => __('Logo 2', 'tbs-child-theme'),
        'section'           => 'tbs_partners',
        'settings'          => 'tbs-logo2',
    ))); 
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tbs-logo3', array(
        'label'             => __('Logo 3', 'tbs-child-theme'),
        'section'           => 'tbs_partners',
        'settings'          => 'tbs-logo3',    
    )));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tbs-logo4', array(
        'label'             => __('Logo 4', 'tbs-child-theme'),
        'section'           => 'tbs_partners',
        'settings'          => 'tbs-logo4',
    ))); 
    $wp_customize->add_setting( 'tbs-partners-page', array(
		'default' => '',
	));
	$wp_customize->add_control( 'tbs-partners-page', array(
		'label' => 'Select Partners Page',
		'type'  => 'dropdown-pages',
		'section' => 'tbs_partners',
		'settings' => 'tbs-partners-page'
	));

}
add_action( 'customize_register', 'tech_startup_customizer', 11 );

if ( ! defined( 'PRO_THEME_LINK' ) ) {
	define( 'PRO_THEME_LINK',__('https://www.themeshopy.com/themes/tech-startup-wordpress-theme/','tech-startup') );
}

if ( ! defined( 'PRO_THEME_TEXT' ) ) {
	define( 'PRO_THEME_TEXT', __('Tech Startup Pro Theme','tech-startup') );
}

if (!function_exists('tech_startup_credit')) {
	function tech_startup_credit() {
		echo "<a href=".esc_url(TECH_STARTUP_CREDIT)." target='_blank''>".esc_html__('Tech Startup WordPress Theme', 'tech-startup')."</a>";
	}
}

define('TECH_STARTUP_BUY_NOW',__('https://www.themeshopy.com/themes/tech-startup-wordpress-theme/', 'tech-startup'));
define('TECH_STARTUP_LIVE_DEMO',__('https://www.themeshopy.com/tech-startup-pro/', 'tech-startup'));
define('TECH_STARTUP_CONTACT',__('https://wordpress.org/support/theme/tech-startup/', 'tech-startup'));
define('TECH_STARTUP_PRO_DOC',__('https://themeshopy.com/demo/docs/free-tech-startup/', 'tech-startup'));
define('TECH_STARTUP_CREDIT',__('https://www.themeshopy.com/themes/free-tech-startup-wordpress-theme/', 'tech-startup'));

add_action( 'init', 'tech_startup_remove_action');
function tech_startup_remove_action() {
    remove_action( 'admin_menu','advance_startup_abouttheme' );
    remove_action( 'admin_notices','advance_startup_activation_notice' );
}

/* Admin about theme */
require get_theme_file_path('/inc/admin/admin.php');

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_separate', trailingslashit( get_stylesheet_directory_uri() ) . 'ctc-style.css', array( 'bootstrap-style','advance-startup-block-style','advance-startup-basic-style','advance-startup-basic-style','advance-startup-customcss','font-awesome-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION

// function console_log($output, $with_script_tags = true) {
//     $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
// ');';
//     if ($with_script_tags) {
//         $js_code = '<script>' . $js_code . '</script>';
//     }
//     echo $js_code;
// }
