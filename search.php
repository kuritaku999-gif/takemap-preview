<?php
/**
 * 検索結果
 */
get_header(); ?>

<main id="main" class="site-main search">
	<header class="archive-head">
		<div class="container">
			<nav class="breadcrumb" aria-label="パンくず">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a>
				<span>›</span><span>検索結果</span>
			</nav>
			<h1 class="archive-head__title">「<?php echo esc_html( get_search_query() ); ?>」の検索結果</h1>
			<div class="archive-head__searchform"><?php get_search_form(); ?></div>
		</div>
	</header>
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="card-grid card-grid--3">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/card', 'post' ); ?>
				<?php endwhile; ?>
			</div>
			<?php takemap_pagination(); ?>
		<?php else : ?>
			<p class="empty">「<?php echo esc_html( get_search_query() ); ?>」に一致する記事は見つかりませんでした。</p>
		<?php endif; ?>
	</div>
</main>

<?php get_footer();
