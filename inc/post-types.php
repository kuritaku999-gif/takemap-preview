<?php
/**
 * カスタム投稿タイプ
 * - shop  : 店舗・スポット
 * - event : イベント
 * - coupon: クーポン
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function takemap_register_post_types() {

	register_post_type( 'shop', array(
		'labels' => array(
			'name'          => 'スポット',
			'singular_name' => 'スポット',
			'add_new_item'  => '新規スポットを追加',
			'edit_item'     => 'スポットを編集',
			'menu_name'     => 'スポット',
		),
		'public'       => true,
		'has_archive'  => 'spot',
		'rewrite'      => array( 'slug' => 'spot' ),
		'menu_icon'    => 'dashicons-store',
		'menu_position'=> 5,
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'event', array(
		'labels' => array(
			'name'          => 'イベント',
			'singular_name' => 'イベント',
			'menu_name'     => 'イベント',
		),
		'public'       => true,
		'has_archive'  => 'event',
		'rewrite'      => array( 'slug' => 'event' ),
		'menu_icon'    => 'dashicons-calendar-alt',
		'menu_position'=> 6,
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'coupon', array(
		'labels' => array(
			'name'          => 'クーポン',
			'singular_name' => 'クーポン',
			'menu_name'     => 'クーポン',
		),
		'public'       => true,
		'has_archive'  => 'coupon',
		'rewrite'      => array( 'slug' => 'coupon' ),
		'menu_icon'    => 'dashicons-tickets-alt',
		'menu_position'=> 7,
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'takemap_register_post_types' );
