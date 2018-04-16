<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>MyAbroad | Trip Share! Photo Upload!</title>
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
<body>
<!-- ヘッダー／ナビ -->
<div id="header">
	<div class="inner">
		<a href="../index.php"><img src="../img/MyAbroad_logo.png" alt="MyAbroad_logo"></a>
	</div>
</div>

<div class="inner height-setting4">
	<p class="message">下記のぴっクエストを削除しますか。</p>
		<div class="form007">
			<p>ぴっクエストID：<?= h($rs['id']); ?></p>
			<p>ぴっクエスト：<?= h($rs['picquest']); ?></p>
		</div>


			<p id="text_center2">削除する</p>
			<form action="picquest_delete_complete.php" method="post">
				<input class="btn_design2" class="confirm_btn" type="submit" name="btn1" value="削除する">
				<input type="hidden" name="token" value="<?=CsrfValidator::generate()?>">
			</form>


			<p id="text_center2">削除をやめる</p>
			<form action="picquest.php" method="post">
				<input class="btn_design2" class="confirm_btn" type="submit" name="btn1" value="もどる">
				<input type="hidden" name="token" value="<?=CsrfValidator::generate()?>">
			</form>


</div><!-- class="inner" -->

<div id="caution">
	<div class="inner">
		<p>【注意事項】</p>
		<p>ご登録された個人情報はこのサービス（※1）以外には使用しません。
		<br>あくまでも登録者、閲覧者同士、お互いが楽しむためのサイトです。
		<br>アップロードする写真の内容にはディグニティ（品格／品位）を持って望むようお願いいたします。
		<br>内容に苦情があったり、サイト管理者がディグニティ（品格、品位）に欠くと感じた場合、同意なく削除される場合がございます。
		<br>写真画像自体には加工を施しませんが、他の写真と組み合わせる承認をお願いいたします。
		<br>サイト登録時の同意事項に含まれています。
		<a href="#">コチラ</a>からご確認ください。写真の登録者のみ自身の写真を削除することが可能です。
		</p>
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

<script>
// ナビスクロール固定
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
