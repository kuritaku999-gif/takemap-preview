<?php
/**
 * テンプレート用ヘルパー関数
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* 投稿に紐づくカテゴリーを最大2つ表示 */
function takemap_post_categories( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	$cats = get_the_category( $post_id );
	if ( empty( $cats ) ) return;
	echo '<ul class="card__cats">';
	$count = 0;
	foreach ( $cats as $cat ) {
		if ( $count >= 2 ) break;
		echo '<li><a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
		$count++;
	}
	echo '</ul>';
}

/* 投稿のエリア表示 */
function takemap_post_areas( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	$terms = get_the_terms( $post_id, 'area' );
	if ( empty( $terms ) || is_wp_error( $terms ) ) return;
	echo '<ul class="card__areas">';
	foreach ( $terms as $term ) {
		echo '<li><a href="' . esc_url( get_term_link( $term ) ) . '"><span class="pin" aria-hidden="true">📍</span>' . esc_html( $term->name ) . '</a></li>';
	}
	echo '</ul>';
}

/* 投稿日表示 */
function takemap_post_date( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	echo '<time class="card__date" datetime="' . esc_attr( get_the_date( 'c', $post_id ) ) . '">' . esc_html( get_the_date( 'Y.m.d', $post_id ) ) . '</time>';
}

/* サムネイル（フォールバック付き） */
function takemap_thumbnail( $size = 'takemap-card', $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	if ( has_post_thumbnail( $post_id ) ) {
		echo get_the_post_thumbnail( $post_id, $size, array( 'class' => 'card__img', 'loading' => 'lazy' ) );
	} else {
		echo '<div class="card__img card__img--placeholder" aria-hidden="true"><span>竹</span></div>';
	}
}

/* SVGロゴ（テキストフォールバック） */
function takemap_logo() {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}
	$home = esc_url( home_url( '/' ) );
	echo <<<HTML
<a class="logo" href="{$home}" aria-label="竹マップ ホーム">
	<svg class="logo__mark" viewBox="0 0 48 48" aria-hidden="true">
		<circle cx="24" cy="24" r="22" fill="#3a8055"/>
		<path d="M24 12 L18 30 L30 30 Z" fill="#faf7f0"/>
		<circle cx="24" cy="33" r="3" fill="#d9542b"/>
	</svg>
	<span class="logo__text">
		<span class="logo__main">竹マップ</span>
		<span class="logo__sub">TAKENOTSUKA</span>
	</span>
</a>
HTML;
}

/**
 * メガメニュー定義
 * 各カテゴリにサブカテゴリ（絵文字＋ラベル＋slug）
 */
function takemap_mega_data() {
	return array(
		'taberu' => array(
			'label' => '食べる',
			'emoji' => '🍴',
			'items' => array(
				array( '🍜', 'ラーメン',     'ramen' ),
				array( '🥢', '町中華',       'machichuka' ),
				array( '🍻', '居酒屋',       'izakaya' ),
				array( '☕', 'カフェ',       'cafe' ),
				array( '🍰', 'スイーツ',     'sweets' ),
				array( '🍞', 'パン',         'bread' ),
				array( '🍱', 'テイクアウト', 'takeout' ),
				array( '🍣', '和食',         'washoku' ),
				array( '🍝', '洋食',         'yoshoku' ),
				array( '🥘', 'アジアン',     'asian' ),
				array( '🍦', 'スタンド',     'stand' ),
				array( '🍕', 'ピザ・宅配',   'delivery' ),
			),
		),
		'kurasu' => array(
			'label' => '暮らす',
			'emoji' => '🏠',
			'items' => array(
				array( '🏪', '商店街',       'shotengai' ),
				array( '🛒', 'スーパー',     'super' ),
				array( '♨️', '銭湯・サウナ', 'sento' ),
				array( '🌳', '公園',         'park' ),
				array( '📚', '図書館',       'library' ),
				array( '🚮', 'リサイクル',   'recycle' ),
				array( '🐈', 'ペット',       'pet' ),
				array( '🌸', '季節の花',     'season' ),
			),
		),
		'kirei' => array(
			'label' => 'キレイ・健康',
			'emoji' => '💆',
			'items' => array(
				array( '💇', '美容室',     'salon' ),
				array( '💅', 'ネイル',     'nail' ),
				array( '🧖', 'エステ',     'esthe' ),
				array( '💪', 'フィットネス', 'fitness' ),
				array( '🦴', '整体・整骨', 'seitai' ),
				array( '🏥', '病院',       'hospital' ),
				array( '🦷', '歯科',       'dental' ),
				array( '👨', 'メンズ',     'mens' ),
			),
		),
		'kosodate' => array(
			'label' => '子育て',
			'emoji' => '👶',
			'items' => array(
				array( '🍼', 'ベビーOK',   'baby' ),
				array( '🏫', '保育園',     'preschool' ),
				array( '📖', '習い事',     'lesson' ),
				array( '🎈', '室内遊び場', 'indoor' ),
				array( '🛝', '公園',       'kid-park' ),
				array( '🍴', '子連れランチ', 'kid-lunch' ),
			),
		),
		'asobu' => array(
			'label' => '遊ぶ',
			'emoji' => '🎉',
			'items' => array(
				array( '🚶', '散歩コース', 'walk' ),
				array( '🎭', 'イベント',   'event' ),
				array( '🌸', '舎人公園',   'toneri' ),
				array( '🎨', 'ワークショップ', 'workshop' ),
				array( '🎬', '映画',       'cinema' ),
				array( '🎮', 'アミューズメント', 'amusement' ),
				array( '🏯', '近隣おでかけ', 'around' ),
				array( '📷', '撮影スポット', 'photo' ),
			),
		),
		'sumu' => array(
			'label' => '住む',
			'emoji' => '🏘️',
			'items' => array(
				array( '🔑', '不動産',     'real-estate' ),
				array( '🔨', 'リフォーム', 'reform' ),
				array( '🏛️', '行政',       'admin' ),
				array( '🚸', '通学路',     'school-route' ),
				array( '🚉', '交通',       'transport' ),
				array( '📑', '暮らしTIPS', 'tips' ),
			),
		),
	);
}

function takemap_mega_menu() {
	$data = takemap_mega_data();
	echo '<ul class="gnav">';
	foreach ( $data as $slug => $cat ) {
		$cat_obj = get_category_by_slug( $slug );
		$url = $cat_obj ? get_category_link( $cat_obj->term_id ) : '#';
		echo '<li class="gnav__item gnav__item--has-mega" data-mega="' . esc_attr( $slug ) . '">';
		echo '<a href="' . esc_url( $url ) . '" data-emoji="' . esc_attr( $cat['emoji'] ) . '">' . esc_html( $cat['label'] ) . '</a>';
		echo '<div class="mega">';
		echo '<div class="mega__head">';
		echo '<div class="mega__title"><span class="mega__title-emoji">' . esc_html( $cat['emoji'] ) . '</span>' . esc_html( $cat['label'] ) . 'のサブカテゴリ</div>';
		echo '<a class="mega__more" href="' . esc_url( $url ) . '">すべて見る →</a>';
		echo '</div>';
		echo '<div class="mega__grid">';
		foreach ( $cat['items'] as $item ) {
			list( $emoji, $label, $sub ) = $item;
			$href = home_url( '/' . $slug . '/' . $sub . '/' );
			echo '<a class="mega__item" href="' . esc_url( $href ) . '">';
			echo '<span class="mega__icon">' . esc_html( $emoji ) . '</span>';
			echo '<span class="mega__label">' . esc_html( $label ) . '</span>';
			echo '</a>';
		}
		echo '</div></div></li>';
	}
	echo '</ul>';
}

/* 月号テキスト（FV右上の小さな表記） */
function takemap_issue_label() {
	$m = (int) date_i18n( 'n' );
	$y = date_i18n( 'Y' );
	echo '<span class="issue-label"><span class="issue-label__y">' . esc_html( $y ) . '</span><span class="issue-label__m">' . esc_html( $m ) . '月号</span></span>';
}
