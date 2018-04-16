<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>MyAbroad | Trip Share! Photo Upload! | upload/select</title>
	<link href="css/epq_style.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" href="colorbox.css" />
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-100944431-1', 'auto');
		ga('send', 'pageview');
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../js/jquery.colorbox.js"></script>
	<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				// $(".group1").colorbox({rel:'group1'});
				$(".group1").colorbox({rel:'group1'});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});


				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
</head>
<body class="bodyclass">


<!-- ヘッダー／ナビ -->
<div id="header">
	<div class="inner">
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

<div id="container">
	<div class="inner">
	<div id="all_picquests">
			<div class="picquests picquest_word">
				<?= h($picquest_rs['picquest']); ?>
			</div>
		<div class="pic_num"><?= h($resultSet4); ?>pic</div>


<?php if($delete_flag_rs['delete_flag'] != 1): ?>
		<h2>＼＼&nbsp;画像をアップロードする！&nbsp;／／</h2>

<form action="../upload/upload_confirm.php" enctype="multipart/form-data" method="post">
	<div class="flex_box">
		<div>
			<p>&#9312;写真を選択</p>
			<div class="grandfather">
				<label class="parents">
					<input type="file" name="userfile">
					<span id="select_pic_btn">ここをクリックして写真を選択</span>
				</label>
				<div class="triangles_parents">
					<div class="triangles"></div>
				</div>
			</div>
		</div>
		<div>
			<p>&#9313;コメント欄</p>
			<div class="grandfather grandfather2">
				<input class="parents" type="text" name="comment" value="<?= $comment; ?>" autocomplete="off" placeholder="画像にコメントを入力してな～。">
				<div class="triangles_parents">
					<div class="triangles"></div>
				</div>
			</div>
		</div>
		<div>
			<p>&#9314;写真をアップロード</p>
			<div class="grandfather">
				<input class="parents" type="submit" name="btn1" value="ファイルを送信">
				<div class="triangles_parents"><div class="triangles">temp_letter</div></div>
			</div>
		</div>
	</div>
	<input type="hidden" name="MAX_FILE_SIZE" value=3000000>
	<input type="hidden" name="action" value="insert"><!-- POST sender -->
	<input type="hidden" name="token" value="<?=CsrfValidator::generate()?>">
</form>
<?php else: ?>
	<h2>&nbsp;過去のぴっクエストです。楽しんで！&nbsp;</h2>
<?php endif; ?>


		<!-- メッセージ -->
		<? if($search_message || $delete_message): ?>
			<div id="message">
				<p>
					<?php
						echo ($search_message);
						echo h($delete_message);
						unset($_SESSION['delete_message']);
					?>
				</p>
			</div>
		<?php endif; ?>

<!-- 画像一覧 -->
	<div id = "contents">


		<? if($result2): ?>
			<?php while($picquest_rs2 = $result2->fetch_assoc()): ?>
				<div class="pic">
					<ul>
						<li><?=$picquest_rs2['id']?></li>
						<li><a class="group1" href="../user_img/<?= $picquest_rs2['name']?>" style="background-image: url('../user_img/<?= $picquest_rs2['name']?>'); " title="<?=$picquest_rs2['comment']?>">temp_letter</a></li>
						<li><?=$picquest_rs2['name']?></li>
						<li>コメント：<?=$picquest_rs2['comment']?></li>
						<li id = "regi_time">登録時間：<?=$picquest_rs2['up_time']?></li>
						<li><a href="../upload/upload_delete_confirm.php?pic_del_id=<?=$picquest_rs2['id']?>" onclick="return window.confirm('このぴっクエスト画像を削除しても良いですか。')">削除</a></li>
					</ul>
				</div><!-- class="pic" -->
			<?php endwhile; ?>
		<?php endif; ?>
	</div><!-- id = "contents" -->
	</div><!--.inner-->
</div><!--#container-->

<!-- 注意書き -->
		<div id="caution">
			<div class="inner">
				<dl>
					<dt>【注意事項】</dt>
					<dd>ご登録された個人情報はこのサービス（※1）以外には使用しません。<br>あくまでも登録者、閲覧者同士、お互いが楽しむためのサイトです。<br>アップロードする写真の内容にはディグニティ（品格／品位）を持って望むようお願いいたします。<br>内容に苦情があったり、サイト管理者がディグニティ（品格、品位）に欠くと感じた場合、同意なく削除される場合がございます。<br>写真画像自体には加工を施しませんが、他の写真と組み合わせる承認をお願いいたします。<br>サイト登録時の同意事項に含まれています。<a href="#">コチラ</a>からご確認ください。写真の登録者のみ自身の写真を削除することが可能です。</dd>
				</dl>
			</div><!-- class="inner" -->
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
