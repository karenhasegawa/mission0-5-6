<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
  		<meta name="viewport" content="width=320, height=480, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes"><!-- for smartphone. ここは一旦、いじらなくてOKです。 -->
		<meta charset="utf-8"><!-- 文字コード指定。ここはこのままで。 -->
		<title>長谷川佳蓮(はせ)のプロフィール</title>
		<link rel="stylesheet" href="Style_seet.css">
	</head>
	<body>
		<img id="back" src="プロフィール画像.jpg" alt="自分を象徴する写真など" title="プロフィール画像" width="100%">
		<header>
				<!-- 見出し 第１レベル -->
				<!--（氏名）の公開を避ける場合はイニシャルやニックネームでOK-->
				<h1 class="midashi_1"> 長谷川佳蓮(はせ)のプロフィール </h1>
				
				<?php
					if($_SESSION['login'] == true){
						echo "<a href='logout.php'>ログアウト</a>";
						echo "<a href='user_post.php'>投稿履歴</a>";
					}else{
						echo "<a href='top.php'>ログイン</a>";
					}
				?>
				<!--自分を象徴するような画像を入れてみよう-->
				<!--画像も同じフォルダに保存すること-->
		</header>
		<div id="continer">			
			<main>
				<div class="mypictuer">
					<img id="top_img" src="プロフィール画像.jpg" alt="自分を象徴する写真など" title="プロフィール画像" width="320px">
						<h6>（ 画像についてひとこと：ディズニーのマーメードラグーンで撮った写真です。）</h6>
				</div>
				<hr>

				<!-- 見出し 第２レベル ・以下、h2レベルで項目を色々書いていきましょう -->
				<!-- 自己紹介で言いたい項目を見出しにいれて、文章をつくりましょう。項目名は編集OK。項目を足してもOK。 -->
				<div class="profile_1">
					<h2>所属など</h2>
							<span> アカペラサークルに所属、ゼミはAIや画像処理などをテーマにしているが、実際は自由度が高くためゲームを作ったり、プレゼンをしたりしている。
							<br>アルバイトはドラックストアで1年間、訪問介護を3ヶ月間やりました。
					</span>
				</div>
				<div class="profile_2">
					<h2>趣味や属性</h2>
						<span>歌を歌うこと、アニメや映画の鑑賞が好きです。あと、運動部だったので球技系のスポーツが好きです。<br>口下手ですが、仲良くしてください！よろしくお願いします。
						</span>
				</div>
				<div class="profile_3">
					<!-- HTMLで出来る色々な表現を試す -->
					<!-- ↑文字に意味を持たせることもできます。strong は太字。ググったりして色々と調べてみましょう -->
					<!-- 例として今回は「リスト表示」を作ってみましょう。項目数が３で足りないなら足してもOKです -->
					<!-- 番号をふるなら ol タグ、番号がいらないなら ul タグ で囲って、項目は li タグで括ります。 -->
					<!-- ol ・ ul 片方でOK -->
					<h2>私の好きなアニメ＆映画トップ3</h2>
					<span id="anime">
						<strong> 私のアニメトップ３！</strong>
						<!-- ↑文字に意味を持たせることもできます。strong は強調。太字になります。 -->
						<ol>
							<li>ＨＵＮＴＥＲ×ＨＵＮＴＥＲ </li>
							<li>僕のヒーローアカデミア</li>
						<li>進撃の巨人（アニメしか見てません。。）</li>
						</ol>
					</span>
					<span id="jiburi">
						<strong> 私のジブリ映画トップ３！</strong><br>
						<ol>
							<li> もののけ姫</li>
							<li> 天空の城ラピュタ</li>
							<li> 千と千尋の神隠し</li>
						</ol>
					</span>				
				</div>
					
				<hr>

				<div class="profile_4">
					<!-- 以下は、見出しの名前は固定で、内容を編集してみましょう -->
					<h2>その他</h2>
					<!-- 見出し 第３レベル -->
					<h3>使用PC</h3><!-- 編集して、自分の使うPCだけ残しましょう -->
					<span>Windows</span>

					<h3>PC利用経験や、普段の使い方</h3>
					<span>大学のレポート課題(プログラミングを含む)
					zoomや通話など</span>

					<h3>自分の強みや弱みなど</h3>
					<span>強み：新しいことに挑戦するのをためらいなくできることと、人を思いやれるところです。<br>
					弱み：後回しにしがちなところです。（気をつけてはいます。。）<br></span>


					<h3>TECH-BASE参加にあたり、意気込み</h3>
					<span>プログラミングの経験はありますが、PHPは初めてなので頑張ります！！<br></span>
				</div>		
			<div id="coment">
				<!-- 以下は投稿フォーム欄ですが、今は＆このままでは機能しておらずエラーが発生します。 -->
				<!-- したがって今はコピペするだけでOKです。スタートアップ以降のPHPミッションを進める際に、参考にしてください。 -->
				<h3>新規投稿</h3>
				<form class="form1" action="" method="post">
					名前<br>
					<?php
						if(isset($_SESSION['login']) == true){
							echo $_SESSION['name'];
						}else{
							echo "ゲスト様";
							$_SESSION['name']='ゲスト様';
						}
					?>
					<br><br>コメント<br>
					<input id="form_comment" type="text" name="comment" value="コメント" placeholder="コメントを入力してください" width="300px"><br>
					<input type="submit" name="new_submit" value="送信"><br>
				</form>
				<div id="post_view">
				</div>
				<script type='text/javascript'>
					document.addEventListener('DOMContentLoaded', function(){	
						const veiw_1 = document.getElementById('post_view');
					})
				</script>
			</div>
		</main>				
		<footer>
			<hr>	
			<a href="#top_img"> このページのTOPへ </a> ／ <a href="https://www.google.co.jp/" target="_blank"> ググる </a>
			<hr>			
		</footer>			
	</body>
</html>

<?php
	require("post_process.php");
?>