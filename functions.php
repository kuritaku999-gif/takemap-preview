<?php
/**
 * 竹マップ (Takemap) テーマ functions.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'TAKEMAP_VERSION', '0.1.0' );
define( 'TAKEMAP_DIR', get_template_directory() );
define( 'TAKEMAP_URI', get_template_directory_uri() );

require_once TAKEMAP_DIR . '/inc/post-types.php';
require_once TAKEMAP_DIR . '/inc/taxonomies.php';
require_once TAKEMAP_DIR . '/inc/template-tags.php';

/* テーマセットアップ */
function takemap_setup() {
	load_theme_textdomain( 'takemap', TAKEMAP_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 220,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	add_image_size( 'takemap-card', 640, 400, true );
	add_image_size( 'takemap-hero', 1600, 900, true );
	add_image_size( 'takemap-thumb', 320, 200, true );

	register_nav_menus( array(
		'primary'   => 'グローバルメニュー',
		'footer'    => 'フッターメニュー',
		'sns'       => 'SNSメニュー',
	) );
}
add_action( 'after_setup_theme', 'takemap_setup' );

/* CSS / JS の読み込み */
function takemap_enqueue() {
	wp_enqueue_style( 'takemap-fonts', 'https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@400;500;700;800;900&family=Mochiy+Pop+One&family=Kaisei+Decol:wght@400;500;700&family=Yusei+Magic&family=RocknRoll+One&display=swap', array(), null );
	wp_enqueue_style( 'takemap-style', get_stylesheet_uri(), array(), TAKEMAP_VERSION );
	wp_enqueue_style( 'takemap-main', TAKEMAP_URI . '/assets/css/main.css', array( 'takemap-style' ), TAKEMAP_VERSION );

	wp_enqueue_script( 'takemap-main', TAKEMAP_URI . '/assets/js/main.js', array(), TAKEMAP_VERSION, true );
	wp_localize_script( 'takemap-main', 'TAKEMAP', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'takemap-nonce' ),
		'homeUrl' => home_url( '/' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'takemap_enqueue' );

/* ウィジェットエリア */
function takemap_widgets_init() {
	register_sidebar( array(
		'name'          => 'サイドバー',
		'id'            => 'sidebar-1',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => 'フッターウィジェット',
		'id'            => 'footer-1',
		'before_widget' => '<section id="%1$s" class="widget widget--footer %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'takemap_widgets_init' );

/* 抜粋の調整 */
function takemap_excerpt_length( $length ) { return 60; }
add_filter( 'excerpt_length', 'takemap_excerpt_length', 999 );
function takemap_excerpt_more( $more ) { return '…'; }
add_filter( 'excerpt_more', 'takemap_excerpt_more' );

/* body_class に竹マップ専用クラスを追加 */
function takemap_body_class( $classes ) {
	$classes[] = 'takemap';
	if ( is_front_page() ) $classes[] = 'is-front';
	return $classes;
}
add_filter( 'body_class', 'takemap_body_class' );

/* ページネーションをシンプルに */
function takemap_pagination() {
	$args = array(
		'mid_size'  => 1,
		'prev_text' => '前へ',
		'next_text' => '次へ',
		'type'      => 'list',
	);
	echo '<nav class="pagination" aria-label="ページネーション">' . paginate_links( $args ) . '</nav>';
}
