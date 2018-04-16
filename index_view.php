<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>MyAbroad | Trip Share! Photo Upload!</title>
	<link href="css/style2.css" type="text/css" rel="stylesheet">
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-100944431-1', 'auto');
		ga('send', 'pageview');
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="js/jquery.leanModal.js"></script>
	<script type="text/javascript" src="js/jquery.easing.js"></script>
</head>
<body>


<!-- ヘッダー／ナビ -->
<div id="header">
	<div class="inner">
		<a href="index.php"><img src="img/MyAbroad_logo.png" alt="MyAbroad_logo"></a>
		<p id="version">ver=<span>2.2</span></p>
		<!-- 2.1：ぴっクエストに投稿されたぴクエスト数が表示されるように。 -->
	</div><!-- .inner -->
</div><!-- #header -->


<!-- ナビ -->
<div id="nav">
	<ul>
		<li class="navli01"><a href="picquest/picquest.php">ぴっクエスト投稿</a></li>
		<li class="navli02"><a href="picquest/picquest_watch.php">画像アップロード</a></li>
		<li class="navli03"><a href="picquest/picquest_all.php">ぴっクエスト閲覧</a></li>
	</ul>
</div><!-- #nav -->


<!-- ボディコンテンツ -->
<div id="container">
<div class="inner">
<div id="content">


<!-- トップへボタン -->
<div id="to_top">
	<a href="#">TOPへ<div id="arrow_to_top">↑</div></a>
</div>

<!-- モーダル部分 -->
<a href="#thxforsend" id="showDivId" style="display:block" rel="leanModal" name="DivId"></a>
<dl id="thxforsend" style="display:none">
	<dt>はじめに</dt>
	<dd><p>閲覧ありがとうございます！以前6月にこのサイトのお知らせをしてから5カ月が経ち、
		始めた当初はWebプログラミングのことは殆ど知らない状態でした。今では制作メンバーも増え、学習の成果をこの度バージョン2.2としてお知らせさせて頂きます。</p>
		<p>MyAbroadは画像のマッチングサイトです。欲しい画像をリクエストしたり、リクエストに応えて画像をアップロードしたりすることができます。</p>
		<p>まずはお気軽にリクエストを出してみてください！ひょっとして観ている誰かがそれに応えてくれるかもしれません？！<br>これ以降も完成度を高め、より実用的なサイトを目指してまいりますので応援よろしくお願いいたします！</p>
	</dd>
</dl>


<!--メイン画像-->
<div class="main_pic">
	<a href="./picquest/picquest.php">
		<img src="img/main_picquest01.png" width="544" height="428" alt="main_pic" onmouseover="this.src='img/main_picquest02.png'" onmouseout="this.src='img/main_picquest01.png'">
	</a>
</div>


<!-- サイト説明3つのボタン -->
<div class="nav2">
	<ul>
		<li id="whatma"><a href="#description1">MyAbroadってなに？</a></li>
		<li id="whatpq"><a href="#description2">Picquestってなに？</a></li>
		<li id="whattrp"><a href="#description3">Trippiiって何もの？</a></li>
	</ul>
</div>


<!-- MyAbroadってなに詳細説明 -->
<div class="descriptions" id="description1">
	<h2><span class="bold">MyAbroad</span>ってなに？</h2>
	<p class="description_body">
	一言でいえば写真のマッチングサイトのようなものでしょうか。
	<br>
	こんな写真が欲しい！とぴっクエストを投稿してください。
	<br>
	それに応えて写真をアップロードすれば、「それよいな」でポイントゲット！
	<br>
	もちろん閲覧するだけでの参加もウェルカムです。
	<br>
	お題に合った写真や好きな写真に「それよいな」をポチリとしてあげて下さい！
	</p>
</div>


<!-- picquestってなに？詳細説明 -->
<div id="description2" class="descriptions">
	<h2><span class="bold">Picquest</span>ってなに？</h2>


	<div class="example-box clearfix">
		<!-- サンプル説明文章 -->
		<div class="exampleA">
			<dl>
				<dt>picquest【ピッくえすと】</dt>
				<dd>picture+request</dd>
				<dd>リクエストされた写真をアップロードすること。<br>またはそのアップロードされた写真。</dd>
			</dl>
			<p>（例）画像のリクエスト</p>
			<h3>『ぬいぐるみや人形が写りこんだ風景写真』</h3>
		</div><!-- class="exampleA" -->


		<!-- サンプル画像 -->
		<div class="exampleB">
			<img src="img/sample.png" alt="sample">
			<p>（例）<br>リクエストに応えて画像をアップロード</p>
		</div><!--exampleB-->
	</div><!-- class="example-box" -->


	<div class="ex-example">
		<p>リクエストのある写真をアップロードして、「＜」をもらったり、<br>「～な写真がみたい︕」「～な画像がほしい︕」といった写真のリクエストをしたり、<br>写真のリクエストとクエストを楽しむ画像共有サイトです。</p>
		<h3>Let's Try!</h3>
		<h4>＼＼&nbsp;&nbsp;picquest を投稿しよう︕&nbsp;&nbsp;／／</h4>
		<p id="btn1" class="btn"><a href="picquest/picquest_all.php">picquest投稿</a></p>
		<h4>＼＼&nbsp;&nbsp;画像をアップロードしよう︕&nbsp;&nbsp;／／</h4>
		<p id="btn2" class="btn"><a href="picquest/picquest.php">画像アップロード</a></p>
	</div><!-- class="ex-example" -->


	</div><!-- id="description2" class="descriptions" -->

	<!-- Trippiiってなにもの？説明詳細 -->
	<div class="descriptions" id="description3">
		<h2><span class="bold">Trippii</span>って何もの？？</h2>


		<div class="example-box clearfix">
			<!-- サンプル説明文章 -->
			<div class="exampleA">
				<dl>
					<dt>Trippii【とりっぴー】</dt>
					<dd>trip+鳥</dd>
					<dd>世界を旅する鳥、トリッピー<br>飛ぶのはチョットぉ～。移動はもっぱら公共機関を利用。</dd>
				</dl>
			</div><!-- class="exampleA" -->


			<!-- サンプル画像 -->
			<div class="exampleB2">
				<img id="trippii_image" src="img/trippi.png" alt="sample2">
				<p>MyAbroad公式キャラクターTrippii<br>「トリッピー」とよんでな～</p>
			</div><!--exampleB-->
		</div><!-- class="example-box" -->


	</div><!-- class="descriptions" id="description3" -->

</div><!-- id="content" -->
</div><!-- class="inner" -->


<!-- 注意事項 -->
<div id="caution">
	<div class="inner">
		<dl>
			<dt>【注意事項】</dt>
			<dd>ご登録された個人情報はこのサービス（※1）以外には使用しません。<br>あくまでも登録者、閲覧者同士、お互いが楽しむためのサイトです。<br>アップロードする写真の内容にはディグニティ（品格／品位）を持って望むようお願いいたします。<br>写真の内容に苦情があったり、サイト管理者がディグニティ（品格、品位）に欠くと感じた場合、同意なく削除される場合がございます。<br>写真画像自体には加工を施しませんが、他の写真と組み合わせる承認をお願いいたします。<br>サイト登録時の同意事項に含まれています。<a href="#">コチラ</a>からご確認ください。写真の登録者のみ自身の写真を削除することは常に可能です。</dd>
		</dl>
	</div>
</div><!-- id="caution" -->

</div><!--id="container"-->

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

//モーダルウィンドウ用
$(function(){
		$("showDivId").leanModal({top:200, target:"#thxforsend", closeButton: ".modal_close", auto:true});
		$("a[rel*=leanModal]").leanModal({top:200, closeButton: ".modal_close"});
});

//スムーズスクロール
var flag = false;
$(function(){
	$('a[href^="#"]').click(function(){
		console.log(flag);
			flag = true;
			var speed = 1000;
			var href= $(this).attr("href");
			var target = $(href == "#" || href == "" ? 'html' : href);
			var position = target.offset().top-60;
			$("html, body").animate({scrollTop:position}, speed, "easeOutExpo");
			return false;
	});
});

</script>


</body>
</html>
