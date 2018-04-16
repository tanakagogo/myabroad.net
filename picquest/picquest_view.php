<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>MyAbroad | Trip Share! Photo Upload! | picquest/input</title>
	<link href="css/pq_style.css" type="text/css" rel="stylesheet">
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-100944431-1', 'auto');
		ga('send', 'pageview');
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body class="bodyclass">


<!-- ヘッダー／ナビ -->
<div id="header">
	<div class="inner">
		<!-- MyAbroadロゴ -->
		<a href="../index.php"><img src="../img/MyAbroad_logo.png" alt="MyAbroad_logo"></a>
	</div><!-- .inner -->
</div><!-- #header -->

<div id="nav">
	<ul>
		<li class="navli01"><a href="picquest.php">ぴっクエスト投稿</a></li>
		<li class="navli02"><a href="picquest_watch.php">画像アップロード</a></li>
		<li class="navli03"><a href="picquest_all.php">ぴっクエスト閲覧</a></li>
	</ul>
</div><!-- #nav -->


<div id="container>">
<div class="inner">

<!-- コンテンツ例・説明 -->
		<div id="eycatch">
			<dl class="picquest01">
				<dt>picture+request</dt>
				<dd>＼＼&nbsp;picquestを贈ろう&nbsp;／／</dd>
			</dl>
			<dl class="picquest02">
				<dt>picquest【ピッくえすと】</dt>
				<dd>（動）リクエストをアップロードすること。<br>（名）そのリクエストに応え、アップロードした写真。</dd>
			</dl>
		</div><!-- #eyecatch -->


		<div id="form">
			<p class="form003"><a href="#caution">→アップロード前に注意事項をご確認ください</a></p>
			<form action="picquest_confirm.php" method="post">
				<ul>
					<p>&#9312;下記に"ぴっクエスト"を入力してください。</p>
					<div class="form005">
						<table>
							<tr>
								<td id="kuchibashi" width="50px"></td>
								<td><textarea type="textarea" name="picquest" value="<?= $picquest; ?>" placeholder="あなたの ”Picquest” をみんなが待ってます！"></textarea></td>
							</tr>
						</table>
					</div>
					<p>&#9313;ぴっクエストを投稿</p>
					<input class="btn_design" type="submit" name="btn1" value="飛べ！ぴっクエスト">
					<!-- <input type="hidden" name="action" value="pq_insert"> -->
					<input type="hidden" name="token" value="<?= CsrfValidator::generate(); ?>">
				</ul>
			</form>
		</div><!-- #form -->


		<!-- メッセージ -->
		<? if($delete_message): ?>
			<div id="message">
				<p>
					<?php
						echo h($delete_message);
						unset($_SESSION['delete_message']);
					?>
				</p>
			</div>
		<?php endif; ?>


	<div class="text_center"><p>picquest一覧</p></div>

	<div id="all_picquests">


		<?php for($i=0; $i<count($picquest_rs); $i++): ?>
			<div class="picquests">
				<a class="picquest_word" href="./each_picquest.php?id=<?= h($picquest_rs[$i]['id']); ?>"><?= h($picquest_rs[$i]['picquest']); ?></a>
				<div class="delete_x"><a href="picquest_delete_confirm.php?id=<?= h($picquest_rs[$i]['id']) ?>" onclick="return window.confirm('このぴっクエストを削除しても良いですか。');">×</a></div>
				<div class="pic_num"><?= h($resultSet4[$i]); ?>pic</div>
			</div>
		<?php endfor; ?>


		<?php if($fake != 0): ?>
			<?php for($i=0; $i<$fake; $i++): ?>
				<div class="fake_picquests">
					<a class="picquest_word"></a>
				</div>
			<?php endfor; ?>
		<?php endif; ?>


	</div><!-- id="all_picquests" -->
</div><!-- class="inner" -->




<div id="caution">
<div class="inner">
	<dl>
		<dt>【注意事項】</dt>
		<dd>ご登録された個人情報はこのサービス（※1）以外には使用しません。<br>あくまでも登録者、閲覧者同士、お互いが楽しむためのサイトです。<br>アップロードする写真の内容にはディグニティ（品格／品位）を持って望むようお願いいたします。<br>内容に苦情があったり、サイト管理者がディグニティ（品格、品位）に欠くと感じた場合、同意なく削除される場合がございます。<br>写真画像自体には加工を施しませんが、他の写真と組み合わせる承認をお願いいたします。<br>サイト登録時の同意事項に含まれています。<a href="#">コチラ</a>からご確認ください。写真の登録者のみ自身の写真を削除することが可能です。</dd>
	</dl>
</div><!--.inner-->
</div><!-- #cauution -->


<!-- フッターコンテンツ -->
<div id="footer">
	<div class="inner">
		<ul>
			<li>HOME</li>
			<li>ABOUT</li>
			<li>NOTES</li>
		</ul>
		<p>copyright&copy;2017 Takakkei&nbsp;All rights reseved</p>
	</div><!--.inner-->
</div><!-- #footer -->
</div><!--#container-->

<script>
//ナビスクロール固定
$(function() {
	var $win = $(window),
	$container = $('#container'),
	$nav = $('#nav'),
	navHeight = $nav.outerHeight(),
	navPos = $nav.offset().top,
	fixedClass = 'is-fixed';

	$win.on('load scroll', function() {
		var value = $(this).scrollTop();
		if ( value > navPos ) {
			$nav.addClass(fixedClass);
			$container.css('margin-top', navHeight);
		} else {
			$nav.removeClass(fixedClass);
			$container.css('margin-top', '0');
		}
	});
});
</script>


</body>
</html>
