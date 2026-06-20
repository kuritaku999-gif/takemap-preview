/* ============================================================
   竹マップ 共通クローム（ヘッダー＋フル幅メガ＋フッター＋ドロワー＋認証モーダル）
   全ページで読み込み、#tm-header / #tm-footer に注入する。
   ─ メガメニュー画像は assets/img/mega/ の名前付きファイル（差し替え可）
   ============================================================ */
(function(){
  // カテゴリ定義（aruku more と同じ構成・竹ノ塚向けにローカライズ）
  // 画像は assets/img/sozai/NN.png を参照（番号は assets/img/_sozai-index.png で確認）
  const CATS = [
    {key:'taberu', name:'食べる・飲む', short:'食べる', en:'EAT & DRINK', chara:'04',
     desc:'カフェ、ラーメン、町中華、お酒まで。竹ノ塚の"美味しい"を地図のように。',
     items:[['カフェ','51'],['スイーツ','41'],['ラーメン','61'],['お酒','38'],['洋食','62'],['中華','17'],['和食','18'],['わんぱく','24'],['竹ノ塚ローカルグルメ','63'],['パン','08'],['アジア・エスニック','35'],['テイクアウト','43'],['ランチ','47'],['その他','02']]},
    {key:'asobu', name:'遊ぶ・でかける', short:'遊ぶ', en:'GO OUT', chara:'03',
     desc:'舎人公園、おでかけ、体験、温泉。歩いて楽しい竹ノ塚の休日。',
     items:[['舎人公園','24'],['泊まる','30'],['家族で','46'],['デート・友達と','68'],['ひとりで','09'],['アウトドア','20'],['温泉','67'],['体験','27'],['名所','25'],['レジャー・スポーツ施設','66'],['非日常','42'],['イベントレポート','49'],['その他','03']]},
    {key:'kirei', name:'キレイ・健康になる', short:'キレイ・健康', en:'BEAUTY & HEALTH', chara:'10',
     desc:'美容室、ネイル、エステ、整体。きれいと元気を支えるお店たち。',
     items:[['美容室','45'],['ネイルサロン','06'],['エステ','07'],['美容アイテム','52'],['エイジングケア','10'],['メンズ','13'],['フィットネス・やせたい','09'],['鍼灸・整体・リラク','11'],['まつ毛サロン','44'],['脱毛','12'],['温活・サウナ','67'],['歯列矯正・審美歯科','05'],['その他','01']]},
    {key:'kaimono', name:'買い物する', short:'買い物', en:'SHOPPING', chara:'19',
     desc:'ファッション、雑貨、ギフト。竹ノ塚で見つける、お気に入り。',
     items:[['ファッション','36'],['雑貨','37'],['かわいい','40'],['スポーツ・アウトドア','66'],['ギフト・お土産','39'],['キッズ','14'],['インテリア','31'],['食品・酒','21'],['生活を彩るモノ','64'],['その他','04']]},
    {key:'seikatsu', name:'生活する', short:'生活', en:'LIFE', chara:'12',
     desc:'お仕事、お金、病院、習い事。竹ノ塚で暮らす毎日のあれこれ。',
     items:[['お仕事探し','30'],['お金のこと','32'],['ウェディング・婚活','46'],['保険','33'],['病院・クリニック','11'],['ペット','03'],['趣味・スキルアップ','27'],['保育園・こども園','14'],['子どもの習い事・塾','15'],['幼稚園','16'],['教育','65'],['ライフイベント','68'],['その他','05']]},
    {key:'sumu', name:'竹ノ塚に住む', short:'住む', en:'LIVING', chara:'02',
     desc:'家づくり、リフォーム、自治体情報。竹ノ塚に住む・住み続けるために。',
     items:[['家づくり','30'],['新築体験談','31'],['住宅イベント','25'],['リフォーム・リノベ','31'],['自治体インフォ','32'],['その他','34']]},
  ];
  // 機能ページ（メガなしのリンク）
  const LINKS = [
    {name:'求人', href:'jobs.html', key:'jobs', badge:'募集'},
    {name:'クーポン', href:'coupons.html', key:'coupons'},
    {name:'掲示板', href:'board.html', key:'board'},
    {name:'レンタル', href:'rental.html', key:'rental', badge:'NEW'},
  ];

  // 公式SNS（アカウントを作ったら url を入れて on:true にするだけで表示されます）
  const SNS = [
    {key:'instagram', label:'Instagram', url:'https://www.instagram.com/takenotsuka_takemap/', on:true},
    {key:'threads',   label:'Threads',   url:'https://www.threads.com/@takenotsuka_takemap',  on:true},
    {key:'line',      label:'公式LINE',  url:'#', on:true},
    {key:'x',         label:'X',         url:'', on:false},   // ← 開設したら url を入れて on:true
    {key:'facebook',  label:'Facebook',  url:'', on:false},   // ← 同上
    {key:'tiktok',    label:'TikTok',    url:'', on:false},   // ← 同上
  ];
  const SNS_ICON = {
    instagram:'<svg viewBox="0 0 24 24" width="20" height="20"><rect x="3" y="3" width="18" height="18" rx="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.2" fill="currentColor"/></svg>',
    threads:'<svg viewBox="0 0 24 24" width="20" height="20"><path d="M16.5 11.3c-.1 0-.2-.1-.3-.1-.2-2.9-1.8-4.6-4.4-4.6-1.6 0-2.9.7-3.7 1.9l1.5 1c.5-.8 1.4-1 2.2-1 1 0 2.3.6 2.5 2.3-.5-.1-1-.2-1.6-.2-2.3 0-3.9 1.4-3.8 3.2.1 1.5 1.4 2.5 3.1 2.5 1.4 0 3-.7 3.4-3.1.3.2 1 .9 1.1 2 .1.7-.4 2.3-2.5 3.3-1.8.8-4.2.6-5.8-1C6.9 17.5 6.3 15.9 6.2 13c.1-2.9.7-4.5 2.2-5.8 1.6-1.6 4-1.8 5.8-1 1.6.7 2.3 2.1 2.6 3.3l1.8-.5C18.4 7 17.4 5.1 15.2 4.1 12.7 2.9 9.5 3.3 7.2 5.6 5.4 7.4 4.5 9.6 4.5 13s.9 5.6 2.7 7.4c1.5 1.5 3.4 2.3 5.4 2.3.5 0 1 0 1.4-.1 2-.4 3.6-1.5 4.4-3.3.7-1.4.6-3-.2-4.1-.4-.7-1-1.2-1.7-1.6zm-3.5 3.9c-.9 0-1.5-.4-1.5-1 0-.6.7-1.1 1.8-1.1.5 0 .9.1 1.4.2-.2 1.5-1 1.9-1.7 1.9z" fill="currentColor"/></svg>',
    line:'<svg viewBox="0 0 24 24" width="20" height="20"><path d="M12 3C6.5 3 2 6.6 2 11c0 2.6 1.7 4.9 4.3 6.3-.2.7-1 2.3-1.1 2.7 0 .2.1.3.3.2.3-.1 3.1-2 4-2.6.8.1 1.7.2 2.5.2 5.5 0 10-3.6 10-8s-4.5-8-10-8z" fill="currentColor"/></svg>',
    x:'<svg viewBox="0 0 24 24" width="19" height="19"><path d="M3 3l8 10L3 21h2.5l6.7-7L17.5 21H21l-8.4-10.5L20.5 3H18l-6 6.5L7 3z" fill="currentColor"/></svg>',
    facebook:'<svg viewBox="0 0 24 24" width="20" height="20"><path d="M22 12a10 10 0 10-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.8 3.7-3.8 1.1 0 2.2.2 2.2.2v2.4h-1.2c-1.2 0-1.6.8-1.6 1.5V12h2.7l-.4 2.9h-2.3v7A10 10 0 0022 12z" fill="currentColor"/></svg>',
    tiktok:'<svg viewBox="0 0 24 24" width="19" height="19"><path d="M16.5 5.6c-1-.7-1.6-1.8-1.8-3.1H12v11.5a2.4 2.4 0 11-1.7-2.3V9c-.3 0-.6-.1-.9-.1a5.3 5.3 0 105.3 5.3V8.6a6.4 6.4 0 003.8 1.2V7.1c-.8 0-1.5-.2-2-.6-.4-.2-.7-.5-1-.9z" fill="currentColor"/></svg>',
  };
  const snsLinksHTML = SNS.filter(s=>s.on).map(s=>`<li><a href="${s.url||'#'}" target="_blank" rel="noopener" aria-label="${s.label}">${SNS_ICON[s.key]}</a></li>`).join('');

  const active = document.body.getAttribute('data-page') || '';

  const megaHTML = c => `
    <div class="mega">
      <div class="mega__inner">
        <div class="mega__feature">
          <img class="mega__chara anim-float" src="assets/img/chara/${c.chara}.png" alt="">
          <div class="mega__ftitle">${c.name}</div>
          <div class="mega__ften">${c.en}</div>
          <p class="mega__fdesc">${c.desc}</p>
          <a class="mega__more" href="#">${c.name}の記事をすべて見る →</a>
        </div>
        <div class="mega__grid">
          ${c.items.map(([label,img])=>`
            <a class="mega__item" href="#">
              <span class="mega__thumb"><img src="assets/img/sozai/${img}.png" alt=""></span>
              <span class="mega__label">${label}</span>
            </a>`).join('')}
        </div>
      </div>
    </div>`;

  const headerHTML = `
    <header class="site-header">
      <div class="site-header__bar">
        <a class="logo" href="index.html" aria-label="竹マップ ホーム">
          <img class="logo__chara anim-bob" src="assets/img/chara/00.png" alt="竹マップくん">
          <span class="logo__text"><span class="logo__main">竹マップ</span><span class="logo__sub">TAKENOTSUKA LOCAL</span></span>
        </a>
        <nav aria-label="グローバルメニュー">
          <ul class="gnav">
            ${CATS.map(c=>`<li class="gnav__item"><a href="#">${c.short||c.name}<span class="chev"></span></a>${megaHTML(c)}</li>`).join('')}
            ${LINKS.map(l=>`<li class="gnav__item gnav__item--link"><a class="${active===l.key?'is-active':''}" href="${l.href}">${l.name}${l.badge?`<span class="gnav__badge">${l.badge}</span>`:''}</a></li>`).join('')}
          </ul>
        </nav>
        <div class="header-actions">
          <button class="icon-btn" aria-label="検索"><svg viewBox="0 0 24 24" width="20" height="20"><circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="2.2"/><path d="M16 16l5 5" stroke="currentColor" stroke-width="2.2" fill="none" stroke-linecap="round"/></svg></button>
          <button class="btn-auth js-login">ログイン</button>
          <button class="btn-auth btn-auth--solid js-register">新規登録</button>
          <button class="icon-btn icon-btn--menu js-menu" aria-label="メニュー"><span class="bar"></span><span class="bar"></span><span class="bar"></span></button>
        </div>
      </div>
    </header>`;

  const footerHTML = `
    <footer class="site-footer">
      <div class="footer-top">
        <div class="footer-brand">
          <a class="logo" href="index.html"><img class="logo__chara anim-bob" src="assets/img/chara/00.png" alt=""><span class="logo__text"><span class="logo__main">竹マップ</span><span class="logo__sub">TAKENOTSUKA LOCAL</span></span></a>
          <p class="footer-tag">あるいて、たべて、まいにちアップデート。</p>
          <p class="footer-desc">竹マップは、足立区竹ノ塚エリアの「食べる・暮らす・遊ぶ」を網羅するローカルWebマガジンです。</p>
        </div>
        <nav><h3 class="footer-h">さがす</h3><ul class="footer-list"><li><a href="#">食べる・飲む</a></li><li><a href="#">遊ぶ・でかける</a></li><li><a href="#">キレイ・健康になる</a></li><li><a href="#">買い物する</a></li><li><a href="#">生活する</a></li><li><a href="#">竹ノ塚に住む</a></li></ul></nav>
        <nav><h3 class="footer-h">サービス</h3><ul class="footer-list"><li><a href="jobs.html">求人</a></li><li><a href="coupons.html">クーポン</a></li><li><a href="board.html">掲示板</a></li><li><a href="rental.html">スタッフレンタル</a></li><li><a href="event-post.html">イベント掲載</a></li></ul></nav>
        <nav><h3 class="footer-h">フォローする</h3><ul class="sns">${snsLinksHTML}</ul></nav>
        <nav><h3 class="footer-h">竹マップについて</h3><ul class="footer-list"><li><a href="about.html">運営について</a></li><li><a href="contact.html">お問い合わせ</a></li><li><a href="advertising.html">広告掲載</a></li><li><a href="privacy.html">プライバシーポリシー</a></li></ul></nav>
      </div>
      <div class="footer-bottom"><img class="anim-sway" src="assets/img/chara/00.png" alt="">© 2026 竹マップ — Takenotsuka Local Map.</div>
    </footer>`;

  const drawerHTML = `
    <div class="mobile-drawer js-drawer">
      <div class="mobile-drawer__panel">
        <button class="mobile-drawer__close js-drawer-close" aria-label="閉じる">×</button>
        ${CATS.map(c=>`<div class="macc"><button class="macc__btn">${c.name}<span class="chev"></span></button><div class="macc__panel">${c.items.map(([l])=>`<a href="#">${l}</a>`).join('')}</div></div>`).join('')}
        ${LINKS.map(l=>`<a class="macc__link" href="${l.href}">${l.name}</a>`).join('')}
        <div style="display:flex;gap:8px;margin-top:18px;">
          <button class="btn btn--ghost btn--sm btn--block js-login">ログイン</button>
          <button class="btn btn--primary btn--sm btn--block js-register">新規登録</button>
        </div>
      </div>
    </div>`;

  const modalHTML = `
    <div class="modal js-auth-modal">
      <div class="modal__box">
        <button class="modal__close js-auth-close" aria-label="閉じる">×</button>
        <img class="modal__chara anim-bob" src="assets/img/chara/10.png" alt="">
        <div class="modal__title">竹マップへようこそ</div>
        <div class="modal__tabs">
          <button class="modal__tab js-auth-t on" data-pane="login">ログイン</button>
          <button class="modal__tab js-auth-t" data-pane="register">新規登録</button>
        </div>
        <form class="modal__pane on" data-pane="login" onsubmit="return false;">
          <div class="form-row"><label>メールアドレス</label><input class="input" type="email" placeholder="you@example.com"></div>
          <div class="form-row"><label>パスワード</label><input class="input" type="password" placeholder="••••••••"></div>
          <button class="btn btn--primary btn--block" type="submit">ログイン</button>
          <p class="modal__alt">パスワードをお忘れですか？</p>
        </form>
        <form class="modal__pane" data-pane="register" onsubmit="return false;">
          <div class="form-row"><label>ニックネーム<span class="req">必須</span></label><input class="input" placeholder="たけのこ太郎"></div>
          <div class="form-row"><label>メールアドレス<span class="req">必須</span></label><input class="input" type="email" placeholder="you@example.com"></div>
          <div class="form-row"><label>パスワード<span class="req">必須</span></label><input class="input" type="password" placeholder="8文字以上"></div>
          <div class="terms-box">
            <h4>竹マップ掲示板 利用規約（抜粋）</h4>
            <p>竹ノ塚エリアの健全な情報交換の場として、以下を守ってご利用ください。</p>
            <h4 class="ng">禁止事項</h4>
            <p>・<b>出会い・交際・ナンパを目的とした投稿</b>、わいせつな内容<br>・誹謗中傷、晒し、個人情報の無断掲載<br>・営利目的の無断宣伝・スパム・勧誘<br>・他の利用者が不快に感じる迷惑行為</p>
            <h4>ブロック・通報機能</h4>
            <p>不快な相手は<b>ブロック</b>でき、以後その投稿は表示されません。違反投稿は<b>通報</b>でき、運営が確認のうえ削除・利用停止を行います。</p>
            <h4>その他</h4>
            <p>投稿内容の責任は投稿者に帰属します。規約違反と判断した場合、予告なくアカウントを停止することがあります。</p>
          </div>
          <label class="check-row"><input type="checkbox" class="js-agree">利用規約・コミュニティガイドライン（出会い目的の投稿禁止、迷惑行為時のブロック／利用停止を含む）に同意します。</label>
          <button class="btn btn--primary btn--block js-reg-submit" type="submit" disabled>同意して登録する</button>
          <p class="modal__alt">登録すると、掲示板への投稿・お気に入り保存ができます。</p>
        </form>
      </div>
    </div>`;

  // トップへ戻るボタン（吹き出し付きキャラ）
  const toTopHTML = `
    <button class="to-top js-to-top" aria-label="ページの先頭へ戻る">
      <span class="to-top__bubble">上に移動する！</span>
      <img class="to-top__chara" src="assets/img/chara/03.png" alt="">
    </button>`;

  // 注入
  const h=document.getElementById('tm-header'); if(h) h.outerHTML=headerHTML;
  const f=document.getElementById('tm-footer'); if(f) f.outerHTML=footerHTML;
  document.body.insertAdjacentHTML('beforeend', drawerHTML+modalHTML+toTopHTML);

  // トップへ戻る挙動
  const toTop=document.querySelector('.js-to-top');
  const onScroll=()=>toTop.classList.toggle('show', window.scrollY>400);
  window.addEventListener('scroll', onScroll, {passive:true}); onScroll();
  toTop.addEventListener('click',()=>window.scrollTo({top:0,behavior:'smooth'}));

  // ドロワー
  const drawer=document.querySelector('.js-drawer');
  document.querySelector('.js-menu').addEventListener('click',()=>drawer.classList.add('open'));
  document.querySelector('.js-drawer-close').addEventListener('click',()=>drawer.classList.remove('open'));
  drawer.addEventListener('click',e=>{if(e.target===drawer)drawer.classList.remove('open');});
  document.querySelectorAll('.macc__btn').forEach(b=>b.addEventListener('click',()=>b.parentElement.classList.toggle('open')));

  // 認証モーダル
  const modal=document.querySelector('.js-auth-modal');
  const openModal=(pane)=>{modal.classList.add('open');setPane(pane||'login');};
  const setPane=(p)=>{
    document.querySelectorAll('.js-auth-t').forEach(t=>t.classList.toggle('on',t.dataset.pane===p));
    document.querySelectorAll('.modal__pane').forEach(pn=>pn.classList.toggle('on',pn.dataset.pane===p));
  };
  document.querySelectorAll('.js-login').forEach(b=>b.addEventListener('click',()=>openModal('login')));
  document.querySelectorAll('.js-register').forEach(b=>b.addEventListener('click',()=>openModal('register')));
  document.querySelector('.js-auth-close').addEventListener('click',()=>modal.classList.remove('open'));
  modal.addEventListener('click',e=>{if(e.target===modal)modal.classList.remove('open');});
  document.querySelectorAll('.js-auth-t').forEach(t=>t.addEventListener('click',()=>setPane(t.dataset.pane)));

  // 利用規約への同意で登録ボタンを有効化
  const agree=document.querySelector('.js-agree'), regBtn=document.querySelector('.js-reg-submit');
  if(agree&&regBtn) agree.addEventListener('change',()=>{regBtn.disabled=!agree.checked;});

  // ローディング画面を隠す
  const loader=document.querySelector('.js-loader');
  if(loader){
    const hide=()=>loader.classList.add('hide');
    if(document.readyState==='complete'){setTimeout(hide,650);}
    else{window.addEventListener('load',()=>setTimeout(hide,550));}
    setTimeout(hide,3500); // フォールバック
  }

  // 出現アニメ
  const io=new IntersectionObserver((es)=>{es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target);}})},{threshold:.12});
  document.querySelectorAll('.reveal').forEach((el,i)=>{el.style.transitionDelay=(i%4*60)+'ms';io.observe(el);});
})();
