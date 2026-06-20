<?php
/**
 * 個別記事
 */
get_header(); ?>

<main id="main" class="site-main single">

	<?php while ( have_posts() ) : the_post(); ?>

		<header class="single-head">
			<div class="container">
				<nav class="breadcrumb" aria-label="パンくず">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a>
					<?php
					$cats = get_the_category();
					if ( ! empty( $cats ) ) {
						$c = $cats[0];
						echo '<span>›</span><a href="' . esc_url( get_category_link( $c->term_id ) ) . '">' . esc_html( $c->name ) . '</a>';
					}
					?>
					<span>›</span><span><?php the_title(); ?></span>
				</nav>
				<?php takemap_post_categories(); ?>
				<h1 class="single-head__title"><?php the_title(); ?></h1>
				<div class="single-head__meta">
					<?php takemap_post_date(); ?>
					<?php takemap_post_areas(); ?>
				</div>
			</div>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="single-head__hero">
					<?php the_post_thumbnail( 'takemap-hero', array( 'loading' => 'eager' ) ); ?>
				</div>
			<?php endif; ?>
		</header>

		<div class="container single__body">
			<article <?php post_class( 'single__main' ); ?>>
				<div class="single__content">
					<?php the_content(); ?>
				</div>

				<footer class="single__footer">
					<?php
					$tags = get_the_tags();
					if ( ! empty( $tags ) ) {
						echo '<ul class="tag-list">';
						foreach ( $tags as $t ) echo '<li><a href="' . esc_url( get_tag_link( $t ) ) . '">#' . esc_html( $t->name ) . '</a></li>';
						echo '</ul>';
					}
					?>
					<div class="share">
						<span class="share__label">SHARE</span>
						<a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo urlencode( get_the_title() ); ?>" target="_blank" rel="noopener">X</a>
						<a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>" target="_blank" rel="noopener">Facebook</a>
						<a href="https://social-plugins.line.me/lineit/share?url=<?php echo urlencode( get_permalink() ); ?>" target="_blank" rel="noopener">LINE</a>
					</div>
				</footer>

				<?php if ( comments_open() || get_comments_number() ) comments_template(); ?>
			</article>

			<aside class="single__side">
				<?php get_sidebar(); ?>
			</aside>
		</div>

		<!-- 関連記事 -->
		<section class="related">
			<div class="container">
				<h2 class="section__title"><span class="ja">関連する記事</span><span class="en">RELATED</span></h2>
				<div class="card-grid card-grid--3">
					<?php
					$cat_ids = wp_get_post_categories( get_the_ID() );
					$rel = new WP_Query( array(
						'posts_per_page' => 3,
						'category__in'   => $cat_ids,
						'post__not_in'   => array( get_the_ID() ),
						'orderby'        => 'rand',
					) );
					if ( $rel->have_posts() ) :
						while ( $rel->have_posts() ) : $rel->the_post();
							get_template_part( 'template-parts/card', 'post' );
						endwhile;
						wp_reset_postdata();
					endif; ?>
				</div>
			</div>
		</section>

	<?php endwhile; ?>

</main>

<?php get_footer();
