<?php
/**
 * フォールバック index.php
 */
get_header(); ?>

<main id="main" class="site-main">
	<div class="container">
		<header class="page-head">
			<h1 class="page-head__title"><?php
				if ( is_home() ) echo '記事一覧';
				elseif ( is_archive() ) the_archive_title();
				else single_post_title();
			?></h1>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="card-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/card', 'post' ); ?>
				<?php endwhile; ?>
			</div>
			<?php takemap_pagination(); ?>
		<?php else : ?>
			<p class="empty">記事が見つかりませんでした。</p>
		<?php endif; ?>
	</div>
</main>

<?php get_footer();
