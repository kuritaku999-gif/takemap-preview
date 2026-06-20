<?php
/**
 * フロントページ（v0.2: ポップ版）
 */
get_header(); ?>

<main id="main" class="site-main front">

	<!-- HERO -->
	<section class="hero">
		<span class="hero__deco hero__deco--1" aria-hidden="true">🍜</span>
		<span class="hero__deco hero__deco--2" aria-hidden="true">🍡</span>
		<span class="hero__deco hero__deco--3" aria-hidden="true">♨️</span>
		<span class="hero__deco hero__deco--4" aria-hidden="true">🌸</span>

		<div class="hero__inner">
			<div class="hero__copy reveal">
				<p class="hero__eyebrow"><span class="dot"></span>足立区 竹ノ塚エリア・ローカルマガジン</p>
				<h1 class="hero__title">
					<span class="accent-1">あるいて</span>、<br>
					<span class="accent-2">たべて</span>、<br>
					まいにち<span class="stamp">アップデート</span>
				</h1>
				<p class="hero__sub">下町・竹ノ塚の "いま" を、地図のように網羅する。<br>新店、商店街、銭湯、子連れスポット、暮らしの裏ワザまで。</p>
				<div class="hero__cta">
					<a class="btn btn--primary" href="<?php echo esc_url( get_post_type_archive_link( 'shop' ) ); ?>">スポットをマップで見る 📍</a>
					<a class="btn btn--ghost" href="<?php echo esc_url( get_category_link( get_category_by_slug( 'taberu' ) ) ); ?>">グルメを読む 🍴</a>
				</div>
			</div>

			<!-- HERO SLIDER -->
			<div class="hero-slider js-slider reveal" data-autoplay="4500">
				<div class="hero-slider__track">
					<div class="hero-slider__slide is-active" style="background:linear-gradient(135deg,#ff7a59,#ffd454);">
						<div class="hero-slider__bg" aria-hidden="true">🍜</div>
						<div class="hero-slider__caption">
							<span class="hero-slider__tag">特集</span>
							<h2 class="hero-slider__title">竹ノ塚ラーメン10選 ─ 駅前から保木間まで歩いて確かめた一杯</h2>
							<p class="hero-slider__excerpt">町中華の名店から、新進気鋭の一杯まで。編集部が実際に歩いて、食べて、まとめました。</p>
						</div>
					</div>
					<div class="hero-slider__slide" style="background:linear-gradient(135deg,#4dd896,#6ec9e8);">
						<div class="hero-slider__bg" aria-hidden="true">♨️</div>
						<div class="hero-slider__caption">
							<span class="hero-slider__tag">連載</span>
							<h2 class="hero-slider__title">下町銭湯めぐり ─ 煙突のある暮らし</h2>
							<p class="hero-slider__excerpt">竹ノ塚に残る銭湯文化。100年続く「竹の湯」さんから始める下町散歩。</p>
						</div>
					</div>
					<div class="hero-slider__slide" style="background:linear-gradient(135deg,#c8b5e8,#ffb3a0);">
						<div class="hero-slider__bg" aria-hidden="true">🌸</div>
						<div class="hero-slider__caption">
							<span class="hero-slider__tag">遊ぶ</span>
							<h2 class="hero-slider__title">舎人公園の春 ─ ベビーカーでも歩けるピクニックガイド</h2>
							<p class="hero-slider__excerpt">桜、お弁当、ベビーカー動線まで。家族で過ごす春の一日プラン。</p>
						</div>
					</div>
					<div class="hero-slider__slide" style="background:linear-gradient(135deg,#ffd454,#4dd896);">
						<div class="hero-slider__bg" aria-hidden="true">🥐</div>
						<div class="hero-slider__caption">
							<span class="hero-slider__tag">新店</span>
							<h2 class="hero-slider__title">保木間に新ベーカリー、3代目が継ぐ味</h2>
							<p class="hero-slider__excerpt">地元で50年、商店街の真ん中で焼き続けるパン屋の物語。</p>
						</div>
					</div>
				</div>
				<button class="hero-slider__nav hero-slider__nav--prev" aria-label="前へ">
					<svg viewBox="0 0 24 24" width="20" height="20"><path d="M15 6l-6 6 6 6" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</button>
				<button class="hero-slider__nav hero-slider__nav--next" aria-label="次へ">
					<svg viewBox="0 0 24 24" width="20" height="20"><path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</button>
				<div class="hero-slider__dots" role="tablist"></div>
			</div>
		</div>
	</section>

	<!-- 流れるテキストバンド -->
	<div class="marquee" aria-hidden="true">
		<div class="marquee__track">
			<span class="marquee__item">あるいて</span>
			<span class="marquee__item">たべて</span>
			<span class="marquee__item">あそんで</span>
			<span class="marquee__item">くらして</span>
			<span class="marquee__item">竹ノ塚をまるごと</span>
			<span class="marquee__item">TAKEMAP</span>
			<span class="marquee__item">あるいて</span>
			<span class="marquee__item">たべて</span>
			<span class="marquee__item">あそんで</span>
			<span class="marquee__item">くらして</span>
			<span class="marquee__item">竹ノ塚をまるごと</span>
			<span class="marquee__item">TAKEMAP</span>
		</div>
	</div>

	<!-- 新店舗情報 -->
	<section class="section section--newshop">
		<div class="container">
			<div class="section__head reveal">
				<h2 class="section__title"><span class="ja" data-emoji="✨">新店舗オープン</span><span class="en">NEW OPEN</span></h2>
				<a class="section__more" href="#">すべて見る →</a>
			</div>
			<div class="card-grid card-grid--3 reveal stagger">
				<?php
				$q = new WP_Query( array(
					'post_type'      => array( 'post', 'shop' ),
					'posts_per_page' => 3,
					'tag'            => 'newopen',
				) );
				if ( $q->have_posts() ) :
					while ( $q->have_posts() ) : $q->the_post();
						get_template_part( 'template-parts/card', 'post' );
					endwhile;
					wp_reset_postdata();
				else :
					takemap_demo_cards( 3, 'NEW OPEN' );
				endif; ?>
			</div>
		</div>
	</section>

	<!-- 特集 -->
	<section class="section section--feature">
		<div class="container">
			<div class="section__head reveal">
				<h2 class="section__title"><span class="ja" data-emoji="🎯">いま、竹ノ塚で。</span><span class="en">FEATURE</span></h2>
			</div>
			<div class="feature-grid reveal stagger">
				<a class="feature feature--lg" href="#">
					<div class="feature__img" style="background:linear-gradient(135deg,#4dd896,#6ec9e8);"><span class="feature__emoji">🍜</span></div>
					<div class="feature__body">
						<span class="feature__tag">特集</span>
						<h3 class="feature__title">竹ノ塚ラーメン10選 ─ 駅前から保木間まで</h3>
						<p class="feature__excerpt">町中華の名店から最新の一杯まで、編集部が歩いて確かめた竹ノ塚のラーメン地図。</p>
					</div>
				</a>
				<a class="feature" href="#">
					<div class="feature__img" style="background:linear-gradient(135deg,#ff7a59,#ffd454);"><span class="feature__emoji">♨️</span></div>
					<div class="feature__body">
						<span class="feature__tag">暮らす</span>
						<h3 class="feature__title">下町銭湯めぐり</h3>
					</div>
				</a>
				<a class="feature" href="#">
					<div class="feature__img" style="background:linear-gradient(135deg,#c8b5e8,#ffb3a0);"><span class="feature__emoji">🌸</span></div>
					<div class="feature__body">
						<span class="feature__tag">遊ぶ</span>
						<h3 class="feature__title">舎人公園の春</h3>
					</div>
				</a>
			</div>
		</div>
	</section>

	<!-- 最新記事 -->
	<section class="section section--latest">
		<div class="container">
			<div class="section__head reveal">
				<h2 class="section__title"><span class="ja" data-emoji="📰">最新の記事</span><span class="en">LATEST</span></h2>
			</div>
			<div class="filter-tabs js-filter-tabs reveal" role="tablist">
				<button class="filter-tabs__btn is-active" data-cat="all" role="tab">すべて</button>
				<?php
				$tabs = array( 'taberu' => '🍴 食べる', 'kurasu' => '🏠 暮らす', 'kirei' => '💆 キレイ・健康', 'kosodate' => '👶 子育て', 'asobu' => '🎉 遊ぶ', 'sumu' => '🏘️ 住む' );
				foreach ( $tabs as $slug => $label ) {
					echo '<button class="filter-tabs__btn" data-cat="' . esc_attr( $slug ) . '" role="tab">' . esc_html( $label ) . '</button>';
				} ?>
			</div>
			<div class="card-grid card-grid--4 js-filter-target reveal stagger">
				<?php
				$q = new WP_Query( array( 'posts_per_page' => 8 ) );
				if ( $q->have_posts() ) :
					while ( $q->have_posts() ) : $q->the_post();
						get_template_part( 'template-parts/card', 'post' );
					endwhile;
					wp_reset_postdata();
				else :
					takemap_demo_cards( 8 );
				endif; ?>
			</div>
		</div>
	</section>

	<!-- エリアセレクタ -->
	<section class="section section--area">
		<div class="container">
			<div class="section__head reveal">
				<h2 class="section__title"><span class="ja" data-emoji="📍">エリアで探す</span><span class="en">BY AREA</span></h2>
				<p class="section__lead">駅・町名から、その街の記事へジャンプ。</p>
			</div>
			<ul class="area-list reveal stagger">
				<?php
				$areas = get_terms( array( 'taxonomy' => 'area', 'hide_empty' => false ) );
				if ( ! is_wp_error( $areas ) && ! empty( $areas ) ) {
					foreach ( $areas as $a ) {
						echo '<li><a href="' . esc_url( get_term_link( $a ) ) . '"><span class="pin" aria-hidden="true">📍</span>' . esc_html( $a->name ) . '</a></li>';
					}
				} ?>
			</ul>
		</div>
	</section>

	<!-- 連載 -->
	<section class="section section--series">
		<div class="container">
			<div class="section__head reveal">
				<h2 class="section__title"><span class="ja" data-emoji="📚">連載</span><span class="en">SERIES</span></h2>
			</div>
			<div class="series-grid reveal stagger">
				<?php
				$series = array(
					array( '🍜', '町中華 月イチ巡礼' ),
					array( '🥐', 'ベーカリー散歩' ),
					array( '👶', '竹ノ塚ベビ連れ' ),
					array( '🍻', '今宵ここで一杯' ),
					array( '🏪', '商店街のひと' ),
					array( '🚶', '駅から歩く20分' ),
				);
				foreach ( $series as $s ) {
					echo '<a class="series-card" href="#">';
					echo '<div class="series-card__icon">' . $s[0] . '</div>';
					echo '<div class="series-card__title">' . esc_html( $s[1] ) . '</div>';
					echo '</a>';
				} ?>
			</div>
		</div>
	</section>

	<!-- 人気 -->
	<section class="section section--popular">
		<div class="container">
			<div class="section__head reveal">
				<h2 class="section__title"><span class="ja" data-emoji="🏆">人気の記事</span><span class="en">POPULAR</span></h2>
			</div>
			<ol class="rank-list reveal stagger">
				<?php
				$q = new WP_Query( array( 'posts_per_page' => 5, 'orderby' => 'comment_count', 'order' => 'DESC' ) );
				$i = 1;
				if ( $q->have_posts() ) :
					while ( $q->have_posts() ) : $q->the_post(); ?>
						<li class="rank-item">
							<span class="rank-item__num"><?php echo esc_html( str_pad( $i, 2, '0', STR_PAD_LEFT ) ); ?></span>
							<a class="rank-item__link" href="<?php the_permalink(); ?>">
								<div class="rank-item__img"><?php takemap_thumbnail( 'takemap-thumb' ); ?></div>
								<div class="rank-item__body">
									<?php takemap_post_categories(); ?>
									<h3 class="rank-item__title"><?php the_title(); ?></h3>
									<?php takemap_post_date(); ?>
								</div>
							</a>
						</li>
					<?php $i++; endwhile;
					wp_reset_postdata();
				else :
					for ( $j = 1; $j <= 5; $j++ ) : ?>
						<li class="rank-item">
							<span class="rank-item__num"><?php echo str_pad( $j, 2, '0', STR_PAD_LEFT ); ?></span>
							<div class="rank-item__link">
								<div class="rank-item__img card__img--placeholder"><span>竹</span></div>
								<div class="rank-item__body">
									<ul class="card__cats"><li><a href="#">食べる</a></li></ul>
									<h3 class="rank-item__title">サンプル記事タイトル <?php echo $j; ?> ─ ここに記事タイトルが入ります</h3>
									<time class="card__date">2026.05.01</time>
								</div>
							</div>
						</li>
					<?php endfor;
				endif; ?>
			</ol>
		</div>
	</section>

	<!-- CTA -->
	<section class="cta-band">
		<div class="container cta-band__inner">
			<div>
				<h2 class="cta-band__title">竹ノ塚の "いま" を、メールで。</h2>
				<p class="cta-band__sub">月イチ更新・新店舗とイベントだけ厳選。</p>
			</div>
			<form class="cta-band__form" onsubmit="return false;">
				<input type="email" placeholder="メールアドレス" aria-label="メールアドレス">
				<button class="btn btn--ghost" type="submit">登録する 📩</button>
			</form>
		</div>
	</section>

</main>

<?php
function takemap_demo_cards( $n = 4, $tag = '' ) {
	$labels = array( '食べる', '暮らす', '遊ぶ', '子育て' );
	$titles = array(
		'駅前にオープンした町中華「龍の郷」を訪ねて',
		'保木間の銭湯文化、煙突の見える暮らし',
		'舎人公園で過ごす春の休日 ─ 子連れガイド',
		'竹ノ塚商店街の老舗パン屋、3代目の挑戦',
		'西新井大師から歩く、下町散歩30分コース',
		'伊興エリアの隠れ家カフェ5選',
		'竹ノ塚で見つけた、深夜営業の名店たち',
		'子育てママに聞いた、本当に使える公園マップ',
	);
	for ( $i = 0; $i < $n; $i++ ) {
		$cat = $labels[ $i % count( $labels ) ];
		$title = $titles[ $i % count( $titles ) ];
		?>
		<article class="card">
			<a class="card__link" href="#" aria-label="<?php echo esc_attr( $title ); ?>">
				<div class="card__media">
					<div class="card__img card__img--placeholder"><span>竹</span></div>
					<?php if ( $tag ) echo '<span class="card__badge">' . esc_html( $tag ) . '</span>'; ?>
				</div>
				<div class="card__body">
					<ul class="card__cats"><li><span><?php echo esc_html( $cat ); ?></span></li></ul>
					<h3 class="card__title"><?php echo esc_html( $title ); ?></h3>
					<div class="card__meta">
						<time class="card__date">2026.0<?php echo ( $i % 5 ) + 1; ?>.<?php echo str_pad( ( $i + 1 ) * 3, 2, '0', STR_PAD_LEFT ); ?></time>
						<ul class="card__areas"><li><span class="pin">📍</span>竹ノ塚</li></ul>
					</div>
				</div>
			</a>
		</article>
		<?php
	}
}

get_footer();
