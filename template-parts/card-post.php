<?php
/**
 * 投稿カード（汎用）
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'card' ); ?>>
	<a class="card__link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
		<div class="card__media">
			<?php takemap_thumbnail( 'takemap-card' ); ?>
			<?php if ( has_tag( 'newopen' ) ) : ?><span class="card__badge">NEW</span><?php endif; ?>
			<?php if ( has_tag( 'pr' ) ) : ?><span class="card__badge card__badge--pr">PR</span><?php endif; ?>
		</div>
		<div class="card__body">
			<?php takemap_post_categories(); ?>
			<h3 class="card__title"><?php the_title(); ?></h3>
			<div class="card__meta">
				<?php takemap_post_date(); ?>
				<?php takemap_post_areas(); ?>
			</div>
		</div>
	</a>
</article>
