<?php
/**
 * 検索フォーム
 */
?>
<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="s">検索</label>
	<input type="search" id="s" name="s" placeholder="気になる店、エリア、キーワード…" value="<?php echo get_search_query(); ?>">
	<button type="submit" aria-label="検索する">
		<svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="2"/><path d="M16 16l5 5" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
	</button>
</form>
