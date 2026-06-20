<?php
/**
 * アーカイブ（カテゴリ・タグ・エリア・投稿タイプ共通）
 */
get_header(); ?>

<main id="main" class="site-main archive">

	<header class="archive-head">
		<div class="container">
			<nav class="breadcrumb" aria-label="パンくず">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a>
				<span>›</span>
				<span><?php
					if ( is_category() || is_tag() || is_tax() ) single_term_title();
					elseif ( is_post_type_archive() ) post_type_archive_title();
					else the_archive_title();
				?></span>
			</nav>
			<h1 class="archive-head__title">
				<?php
				if ( is_category() || is_tag() || is_tax() ) single_term_title();
				elseif ( is_post_type_archive() ) post_type_archive_title();
				else the_archive_title();
				?>
			</h1>
			<?php if ( $desc = get_the_archive_description() ) : ?>
				<div class="archive-head__desc"><?php echo wp_kses_post( $desc ); ?></div>
			<?php endif; ?>
		</div>
	</header>

	<div class="container archive__body">
		<div class="archive__main">
			<?php if ( have_posts() ) : ?>
				<div class="card-grid card-grid--3">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/card', 'post' ); ?>
					<?php endwhile; ?>
				</div>
				<?php takemap_pagination(); ?>
			<?php else : ?>
				<p class="empty">該当する記事が見つかりませんでした。</p>
			<?php endif; ?>
		</div>

		<aside class="archive__side">
			<?php get_sidebar(); ?>
		</aside>
	</div>

</main>

<?php get_footer();
