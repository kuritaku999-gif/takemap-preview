<?php
/**
 * 固定ページ
 */
get_header(); ?>

<main id="main" class="site-main page">
	<?php while ( have_posts() ) : the_post(); ?>
		<header class="archive-head">
			<div class="container">
				<nav class="breadcrumb" aria-label="パンくず">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a>
					<span>›</span>
					<span><?php the_title(); ?></span>
				</nav>
				<h1 class="archive-head__title"><?php the_title(); ?></h1>
			</div>
		</header>
		<div class="container">
			<article <?php post_class( 'page__main' ); ?>>
				<div class="single__content"><?php the_content(); ?></div>
			</article>
		</div>
	<?php endwhile; ?>
</main>

<?php get_footer();
