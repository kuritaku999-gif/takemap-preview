<?php
/**
 * カスタムタクソノミー
 * - area       : エリア（西竹ノ塚・東竹ノ塚・保木間 等）
 * - shop_genre : ジャンル（ラーメン・町中華 等、shop専用）
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function takemap_register_taxonomies() {

	/* エリア（記事・スポット・イベント・クーポン共通） */
	register_taxonomy( 'area', array( 'post', 'shop', 'event', 'coupon' ), array(
		'labels' => array(
			'name'          => 'エリア',
			'singular_name' => 'エリア',
			'menu_name'     => 'エリア',
		),
		'public'            => true,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => 'area' ),
		'show_in_rest'      => true,
		'show_admin_column' => true,
	) );

	/* ジャンル（スポット専用、グルメジャンル等） */
	register_taxonomy( 'shop_genre', array( 'shop' ), array(
		'labels' => array(
			'name'          => 'ジャンル',
			'singular_name' => 'ジャンル',
			'menu_name'     => 'ジャンル',
		),
		'public'            => true,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => 'genre' ),
		'show_in_rest'      => true,
		'show_admin_column' => true,
	) );
}
add_action( 'init', 'takemap_register_taxonomies' );

/**
 * 初期データ：カテゴリ・エリアの自動作成
 * テーマ有効化時に1回だけ走る
 */
function takemap_seed_terms() {
	if ( get_option( 'takemap_seeded' ) ) return;

	/* メインカテゴリ */
	$cats = array(
		'食べる'       => 'taberu',
		'暮らす'       => 'kurasu',
		'キレイ・健康' => 'kirei',
		'子育て'       => 'kosodate',
		'遊ぶ'         => 'asobu',
		'住む'         => 'sumu',
	);
	foreach ( $cats as $name => $slug ) {
		if ( ! term_exists( $name, 'category' ) ) {
			wp_insert_term( $name, 'category', array( 'slug' => $slug ) );
		}
	}

	/* エリア */
	$areas = array(
		'西竹ノ塚' => 'nishi-takenotsuka',
		'東竹ノ塚' => 'higashi-takenotsuka',
		'竹の塚駅前' => 'takenotsuka-eki',
		'保木間'   => 'hogima',
		'伊興'     => 'ikou',
		'入谷'     => 'iriya',
		'舎人'     => 'toneri',
		'西新井'   => 'nishiarai',
		'谷在家'   => 'yazaike',
		'六町'     => 'rokucho',
	);
	foreach ( $areas as $name => $slug ) {
		if ( ! term_exists( $name, 'area' ) ) {
			wp_insert_term( $name, 'area', array( 'slug' => $slug ) );
		}
	}

	update_option( 'takemap_seeded', 1 );
}
add_action( 'after_switch_theme', 'takemap_seed_terms' );
