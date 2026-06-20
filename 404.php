<?php
/**
 * 404
 */
get_header(); ?>

<main id="main" class="site-main not-found">
	<div class="container not-found__inner">
		<div class="not-found__visual" aria-hidden="true">
			<span class="not-found__pin">📍</span>
		</div>
		<h1 class="not-found__title">この場所、地図に載っていません。</h1>
		<p class="not-found__lead">お探しのページは見つかりませんでした。<br>下のリンクから、街の中心へ戻りましょう。</p>
		<div class="not-found__cta">
			<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">トップへ戻る</a>
		</div>
		<div class="not-found__search">
			<?php get_search_form(); ?>
		</div>
	</div>
</main>

<?php get_footer();
