<?php
/**
 * サイドバー
 */
?>
<div class="sidebar">

	<section class="widget">
		<h3 class="widget__title">エリアで探す</h3>
		<ul class="area-list area-list--side">
			<?php
			$areas = get_terms( array( 'taxonomy' => 'area', 'hide_empty' => false ) );
			if ( ! is_wp_error( $areas ) && ! empty( $areas ) ) {
				foreach ( $areas as $a ) {
					echo '<li><a href="' . esc_url( get_term_link( $a ) ) . '"><span class="pin">📍</span>' . esc_html( $a->name ) . '</a></li>';
				}
			} ?>
		</ul>
	</section>

	<section class="widget">
		<h3 class="widget__title">人気タグ</h3>
		<ul class="tag-list">
			<li><a href="#">#ラーメン</a></li>
			<li><a href="#">#町中華</a></li>
			<li><a href="#">#銭湯</a></li>
			<li><a href="#">#子連れ</a></li>
			<li><a href="#">#テイクアウト</a></li>
			<li><a href="#">#新店</a></li>
			<li><a href="#">#商店街</a></li>
		</ul>
	</section>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) dynamic_sidebar( 'sidebar-1' ); ?>
</div>
