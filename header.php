<?php
/**
 * ヘッダー（メガメニュー対応）
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<meta name="theme-color" content="#4dd896">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main">本文へスキップ</a>

<header class="site-header" id="site-header">
	<div class="site-header__inner">
		<div class="site-header__logo"><?php takemap_logo(); ?></div>

		<nav class="site-header__nav" aria-label="グローバルメニュー">
			<?php takemap_mega_menu(); ?>
		</nav>

		<div class="site-header__actions">
			<button class="icon-btn js-search-toggle" aria-label="検索を開く" aria-controls="search-overlay" aria-expanded="false">
				<svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="2.4"/><path d="M16 16l5 5" stroke="currentColor" stroke-width="2.4" fill="none" stroke-linecap="round"/></svg>
			</button>
			<button class="icon-btn icon-btn--menu js-menu-toggle" aria-label="メニューを開く" aria-controls="site-header" aria-expanded="false">
				<span class="bar" aria-hidden="true"></span>
				<span class="bar" aria-hidden="true"></span>
				<span class="bar" aria-hidden="true"></span>
			</button>
		</div>
	</div>

	<div id="search-overlay" class="search-overlay" hidden>
		<div class="search-overlay__inner">
			<?php get_search_form(); ?>
			<div class="search-overlay__hot">
				<span>人気タグ：</span>
				<a href="#">#ラーメン</a>
				<a href="#">#町中華</a>
				<a href="#">#子連れ</a>
				<a href="#">#銭湯</a>
				<a href="#">#新店</a>
			</div>
			<button class="search-overlay__close js-search-toggle" aria-label="検索を閉じる">×</button>
		</div>
	</div>
</header>
