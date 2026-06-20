<?php
/**
 * フッター
 */
?>

<footer class="site-footer">
	<div class="site-footer__top">
		<div class="site-footer__brand">
			<?php takemap_logo(); ?>
			<p class="site-footer__tag">あるいて、たべて、まいにちアップデート。</p>
			<p class="site-footer__desc">竹マップは、足立区竹ノ塚エリアの「食べる・暮らす・遊ぶ」を網羅するローカルWebマガジンです。</p>
		</div>

		<nav class="site-footer__nav" aria-label="フッターメニュー">
			<h3 class="site-footer__heading">カテゴリ</h3>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'menu_class' => 'fnav' ) );
			} else {
				takemap_default_menu();
			}
			?>
		</nav>

		<nav class="site-footer__sns" aria-label="SNS">
			<h3 class="site-footer__heading">フォローする</h3>
			<ul class="sns">
				<li><a href="https://www.instagram.com/takenotsuka_takemap/" aria-label="Instagram" rel="noopener" target="_blank">
					<svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.2" fill="currentColor"/></svg>
				</a></li>
				<li><a href="#" aria-label="X (Twitter)" rel="noopener">
					<svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><path d="M3 3l8 10L3 21h2.5l6.7-7L17.5 21H21l-8.4-10.5L20.5 3H18l-6 6.5L7 3z" fill="currentColor"/></svg>
				</a></li>
				<li><a href="#" aria-label="LINE" rel="noopener">
					<svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><path d="M12 3C6.5 3 2 6.6 2 11c0 2.6 1.7 4.9 4.3 6.3-.2.7-1 2.3-1.1 2.7 0 .2.1.3.3.2.3-.1 3.1-2 4-2.6.8.1 1.7.2 2.5.2 5.5 0 10-3.6 10-8s-4.5-8-10-8z" fill="currentColor"/></svg>
				</a></li>
				<li><a href="#" aria-label="TikTok" rel="noopener">
					<svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><path d="M14 3v10.5a2.5 2.5 0 11-2.5-2.5h.5V8a5.5 5.5 0 105.5 5.5V8.7a7 7 0 003.5 1V6.5a4 4 0 01-3.5-3.5z" fill="currentColor"/></svg>
				</a></li>
			</ul>
		</nav>

		<div class="site-footer__about">
			<h3 class="site-footer__heading">竹マップについて</h3>
			<ul class="footer-links">
				<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">運営について</a></li>
				<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">お問い合わせ</a></li>
				<li><a href="<?php echo esc_url( home_url( '/ad/' ) ); ?>">広告掲載</a></li>
				<li><a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">プライバシーポリシー</a></li>
			</ul>
		</div>
	</div>

	<div class="site-footer__bottom">
		<p class="site-footer__copy">© <?php echo esc_html( date_i18n( 'Y' ) ); ?> 竹マップ — Takenotsuka Local Map.</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
