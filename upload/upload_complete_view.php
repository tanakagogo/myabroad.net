<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>MyAbroad | Trip Share! Photo Upload!</title>
	<link href="css/ul_comp_style.css" type="text/css" rel="stylesheet">
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


	<div class="inner height-setting">


		<div class="form005">
			<p><?= h($upload_message); ?></p><br>
		</div>
		<a href="../picquest/each_picquest.php?id=<?= h($picquest_id); ?>"><?= h($picquest); ?>へもどる</a><br>
		<a href="../index.php">トップページに戻る</a><br>
		<a href="../picquest/picquest.php">ぴっクエスト一覧に戻る</a>



	</div><!-- class="inner" -->


	<div id="caution">
		<div class="inner">
			<dl>
				<dt>【注意事項】</dt>
				<dd>ご登録された個人情報はこのサービス（※1）以外には使用しません。<br>あくまでも登録者、閲覧者同士、お互いが楽しむためのサイトです。<br>アップロードする写真の内容にはディグニティ（品格／品位）を持って望むようお願いいたします。<br>内容に苦情があったり、サイト管理者がディグニティ（品格、品位）に欠くと感じた場合、同意なく削除される場合がございます。<br>写真画像自体には加工を施しませんが、他の写真と組み合わせる承認をお願いいたします。<br>サイト登録時の同意事項に含まれています。<a href="#">コチラ</a>からご確認ください。写真の登録者のみ自身の写真を削除することが可能です。</dd>
			</dl>
		</div><!--.inner-->
	</div><!-- #cauution -->


</div><!--#container-->


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
