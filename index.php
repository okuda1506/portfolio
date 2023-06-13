<?php
session_start();
// クリックジャッキング対策
header('X-FRAME-OPTIONS: DENY');

if (isset($_POST['check']) && !empty($_POST)) {
	$error = array();

	// バリデーション
	if (empty($_POST['name'])) {
		$error['name'] = '* 名前を入力してください';
	}
	if (empty($_POST['email'])) {
		$error['email'] = '* メールアドレスを入力してください';
	} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$error['email'] = '* 正しいメールアドレスを入力してください';
	}
	if (empty($_POST['message'])) {
		$error['message'] = '* お問い合わせ内容を入力してください';
	} elseif (mb_strlen($_POST['message']) > 500) {
		$error['message'] = '* 500文字以内で入力してください';
	}

	if (empty($error)) {
		$_SESSION['send'] = $_POST;
		$token = bin2hex(random_bytes(32));
		$_SESSION['token'] = $token;
		header('Location: checkContact.php');
		exit();
	}
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'rewrite') {
	$_POST = $_SESSION['send'];
}

function h($str)
{
	return htmlspecialchars($str, ENT_QUOTES);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
	<meta property="og:url" content="https://okudatakuya.com" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="TAKUYA OKUDA PORTFOLIO" />
	<meta property="og:description" content="奥田拓也のポートフォリオです" />
	<meta property="og:site_name" content="TAKUYA OKUDA PORTFOLIO" />
	<meta property="og:image" content="img/main_visual_ogp.jpg" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="TAKUYA OKUDA PORTFOLIO">
	<title>TAKUYA OKUDA PORTFOLIO</title>
	<!-- CSS -->
	<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&family=Noto+Serif+JP:wght@600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&family=Crimson+Text&family=Noto+Serif+JP:wght@600&family=STIX+Two+Text&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/slick.css">
	<link rel="icon" href="img/favicon.ico">
	<!-- slick -->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
</head>

<body>
	<header id="top">
		<div class="left-box">
			<h1 class="title">TAKUYA OKUDA</h1>
		</div>
		<div class="right-box" id="sp">
			<ul class="nav_menu">
				<li><a href="#profile">Profile</a></li>
				<li><a href="#works">Works</a></li>
				<li><a href="#skills">Skills</a></li>
				<li><a href="#contact">Contact</a></li>
			</ul>
			<div class="hamburger_btn"><span></span><span></span><span></span></div>
		</div>
		<nav class="slide-in">
			<ul class="nav_menu">
				<li><a href="#top">TOP</a></li>
				<li><a href="#profile">Profile</a></li>
				<li><a href="#works">Works</a></li>
				<li><a href="#skills">Skills</a></li>
				<li><a href="#contact">Contact</a></li>
			</ul>
		</nav>
	</header>
	<div class="header_line"></div>
	<main>
		<section id="myPic">
			<div class="container">
				<div class="main_visual">
					<img src="img/main_visual.jpg" alt="メインビジュアル">
				</div>
				<nav>
					<ul class="nav_menu">
						<li><a href="#profile">Profile</a></li>
						<li><a href="#works">Works</a></li>
						<li><a href="#skills">Skills</a></li>
						<li><a href="#contact">Contact</a></li>
					</ul>
				</nav>
			</div>
		</section>
		<section id="profile">
			<div class="container">
				<div class="title fade-in">
					<div class="txt profile">
						<h2>Profile</h2>
					</div>
					<div class="line"></div>
				</div>
				<div class="name fade-in">
					<div class="ruby_under">
						<ruby>奥田<rt>Okuda</rt></ruby>
					</div>
					<div class="ruby_under">
						<ruby>拓也<rt>Takuya</rt></ruby>
					</div>
				</div>
				<div class="birth fade-in">
					<p>生年月日：1995年5月6日</p>
				</div>
				<div class="fade-in">
					<div class="timeline">
						<div class="event">
							<p class="date">1995</p>
							<p class="description">島根県飯南町出身。小・中学は野球部・陸上部に所属</p>
						</div>
						<div class="event">
							<p class="date">2011</p>
							<p class="description">高校へ進学。未経験からスキー部に所属し、インターハイや全国選抜大会出場を経験</p>
						</div>
						<div class="event">
							<p class="date">2014</p>
							<p class="description">岡山理科大学理学部化学科へ進学。生分解性プラスチック素材の機能向上に関する研究を行う</p>
						</div>
						<div class="event">
							<p class="date">2018</p>
							<p class="description">岡山理科大学理学部化学科卒業。都内の製造会社に就職し、家電製品等のプラスチック部品開発に従事</p>
						</div>
						<div class="event">
							<p class="date">2019</p>
							<p class="description">ITに興味を持ち始め、独学でプログラミング(Java)を学び、都内SES企業へ転職。某大手海運会社様の情報システム部にて、RPAシステムの開発を担当</p>
						</div>
						<div class="event">
							<p class="date">2022</p>
							<p class="description">Web系の言語を独学後、都内Webシステムの受託開発会社へ転職。いくつかのプロジェクトの内、主にシウマイ弁当の販売を行う某大手食品企業様向けのECサイト追加機能開発・保守を中心に担当</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="works">
			<div class="container">
				<div class="title fade-in">
					<div class="txt">
						<h2>Works</h2>
					</div>
					<div class="line"></div>
				</div>
				<div class="worksList fade-in">
					<ul class="slider">
						<li>
							<a href="#">
								<img src="img/portfolio.jpg" alt="ポートフォリオ">
								<div class="works_description">
									<p>ポートフォリオ</p>
									<p>使用技術：HTML / CSS / PHP / JavaScript(slick.js) / jQuery</p>
									<a class="source" href="https://github.com/okuda1506/potofolio" target="_blank" rel="noopener noreferrer">
										<p>ソースコード <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"></p>
									</a>
								</div>
							</a>
						</li>
						<li>
							<a href="works/wcb/wcb.html" target="_blank" rel="noopener noreferrer">
								<img src="img/cafe.jpg" alt="架空カフェサイト">
								<div class="works_description">
									<p>カフェサイトデモ</p>
									<p>使用技術：HTML / CSS</p>
									<a class="source" href="https://github.com/okuda1506/potofolio/tree/main/works/wcb" target="_blank" rel="noopener noreferrer">
										<p>ソースコード <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"></p>
									</a>
								</div>
							</a>
						</li>
						<li>
							<a href="works/corporate/corporate.html" target="_blank" rel="noopener noreferrer">
								<img src="img/corporate.jpg" alt="架空コーポレートサイト">
								<div class="works_description">
									<p>コーポレートサイトデモ</p>
									<p>使用技術：HTML / CSS / JavaScript</p>
									<a class="source" href="https://github.com/okuda1506/potofolio/tree/main/works/corporate" target="_blank" rel="noopener noreferrer">
										<p>ソースコード <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"></p>
									</a>
								</div>
							</a>
						</li>
						<li>
							<a href="works/bulletinBoard/post/" target="_blank" rel="noopener noreferrer">
								<img src="img/bulletinBoard.jpg" alt="ひとことSNS">
								<div class="works_description">
									<p>SNSサイトデモ</p>
									<p>使用技術：HTML / CSS / PHP / MySQL</p>
									<a class="source" href="https://github.com/okuda1506/potofolio/tree/main/works/bulletinBoard" target="_blank" rel="noopener noreferrer">
										<p>ソースコード <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"></p>
									</a>
								</div>
							</a>
						</li>
						<li>
							<a href="works/registerapp/" target="_blank" rel="noopener noreferrer">
								<img src="img/registerapp.jpg" alt="情報登録アプリ">
								<div class="works_description">
									<p>情報登録サイトデモ（情報の入出力・csvダウンロード機能）</p>
									<p>使用技術：HTML / CSS / PHP / MySQL</p>
									<a class="source" href="https://github.com/okuda1506/potofolio/tree/main/works/registerapp" target="_blank" rel="noopener noreferrer">
										<p>ソースコード <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"></p>
									</a>
								</div>
							</a>
						</li>
						<li>
							<a href="https://twitter.com/VirtualTakuya" target="_blank" rel="noopener noreferrer">
								<img src="img/wheatherTweetBot.jpg" alt="天気予報を自動でツイートするBot">
								<div class="works_description">
									<p>東京の天気予報をツイートするBot</p>
									<p>使用技術：PHP / 気象庁のAPI</p>
									<a class="source" href="https://github.com/okuda1506/weatherTweetBot" target="_blank" rel="noopener noreferrer">
										<p>ソースコード <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"></p>
									</a>
								</div>
							</a>
						</li>
						<li>
							<a href="https://todo-app-ts-ecru.vercel.app/" target="_blank" rel="noopener noreferrer">
								<img src="img/todo-app.jpg" alt="TODOアプリ">
								<div class="works_description">
									<p>TODOアプリ（PWA）</p>
									<p>使用技術：React / TypeScript / Material-UI</p>
									<a class="source" href="https://github.com/okuda1506/todo_app_ts" target="_blank" rel="noopener noreferrer">
										<p>ソースコード <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"></p>
									</a>
								</div>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<img src="img/myblog.jpg" alt="自作ブログ">
								<div class="works_description">
									<p>自作ブログ（※実装中 ソースコードはGitHubにて随時更新しています）</p>
									<p>使用技術：Laravel / jQuery / microCMS</p>
									<a class="source" href="https://github.com/okuda1506/myblog" target="_blank" rel="noopener noreferrer">
										<p>ソースコード <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"></p>
									</a>
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</section>
		<section id="skills">
			<div class="container">
				<div class="title fade-in">
					<div class="txt">
						<h2>Skills</h2>
					</div>
					<div class="line"></div>
				</div>
				<div class="skill_type annotation fade-in">
					<h3>※スキルレベルの基準</h3>
					<p>★★★：基礎知識がある前提で、自力でググりながら実装できる</p>
					<p>★★★★★：自分が持つ知識だけで実装できる</p>
				</div>
				<div class="skill_type fade-in">
					<h3>開発言語</h3>
					<p>HTML / CSS：デザインカンプを基にしたWebサイトのマークアップが可能</p>
					<p>JavaScript：動きのあるサイト制作が可能、DOM操作についても実務で経験済み</p>
					<p>TypeScript：独学で基礎を習得。Reactを用いたTODOアプリを作成</p>
					<p>PHP：バックエンド開発で主に使用</p>
				</div>
				<table class="fade-in">
					<thead>
						<tr>
							<th>技術名</th>
							<th>経験年数</th>
							<th>スキルレベル</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<p class="skill_name"><svg viewBox="0 0 128 128" width="30px" height="30px">
										<path fill="#E44D26" d="M9.032 2l10.005 112.093 44.896 12.401 45.02-12.387 10.015-112.107h-109.936zm89.126 26.539l-.627 7.172-.276 3.289h-52.665000000000006l1.257 14h50.156000000000006l-.336 3.471-3.233 36.119-.238 2.27-28.196 7.749v.002l-.034.018-28.177-7.423-1.913-21.206h13.815000000000001l.979 10.919 15.287 4.081h.043v-.546l15.355-3.875 1.604-17.579h-47.698l-3.383-38.117-.329-3.883h68.939l-.33 3.539z"></path>
									</svg>HTML</p>
							</td>
							<td>2年</td>
							<td><span class="stars">★★★★</span><span class="stars_residue">★</span></td>
						</tr>
						<tr>
							<td>
								<p class="skill_name"><svg viewBox="0 0 128 128" width="30px" height="30px">
										<path fill="#1572B6" d="M18.814 114.123L8.76 1.352h110.48l-10.064 112.754-45.243 12.543-45.119-12.526z"></path>
										<path fill="#33A9DC" d="M64.001 117.062l36.559-10.136 8.601-96.354h-45.16v106.49z"></path>
										<path fill="#fff" d="M64.001 51.429h18.302l1.264-14.163H64.001V23.435h34.682l-.332 3.711-3.4 38.114h-30.95V51.429z"></path>
										<path fill="#EBEBEB" d="M64.083 87.349l-.061.018-15.403-4.159-.985-11.031H33.752l1.937 21.717 28.331 7.863.063-.018v-14.39z"></path>
										<path fill="#fff" d="M81.127 64.675l-1.666 18.522-15.426 4.164v14.39l28.354-7.858.208-2.337 2.406-26.881H81.127z"></path>
										<path fill="#EBEBEB" d="M64.048 23.435v13.831H30.64l-.277-3.108-.63-7.012-.331-3.711h34.646zm-.047 27.996v13.831H48.792l-.277-3.108-.631-7.012-.33-3.711h16.447z"></path>
									</svg>CSS</p>
							</td>
							<td>2年</td>
							<td><span class="stars">★★★</span><span class="stars_residue">★★</span></td>
						</tr>
						<tr>
							<td>
								<p class="skill_name"><svg viewBox="0 0 128 128" width="30px" height="30px">
										<path fill="#F0DB4F" d="M1.408 1.408h125.184v125.185H1.408z"></path>
										<path fill="#323330" d="M116.347 96.736c-.917-5.711-4.641-10.508-15.672-14.981-3.832-1.761-8.104-3.022-9.377-5.926-.452-1.69-.512-2.642-.226-3.665.821-3.32 4.784-4.355 7.925-3.403 2.023.678 3.938 2.237 5.093 4.724 5.402-3.498 5.391-3.475 9.163-5.879-1.381-2.141-2.118-3.129-3.022-4.045-3.249-3.629-7.676-5.498-14.756-5.355l-3.688.477c-3.534.893-6.902 2.748-8.877 5.235-5.926 6.724-4.236 18.492 2.975 23.335 7.104 5.332 17.54 6.545 18.873 11.531 1.297 6.104-4.486 8.08-10.234 7.378-4.236-.881-6.592-3.034-9.139-6.949-4.688 2.713-4.688 2.713-9.508 5.485 1.143 2.499 2.344 3.63 4.26 5.795 9.068 9.198 31.76 8.746 35.83-5.176.165-.478 1.261-3.666.38-8.581zM69.462 58.943H57.753l-.048 30.272c0 6.438.333 12.34-.714 14.149-1.713 3.558-6.152 3.117-8.175 2.427-2.059-1.012-3.106-2.451-4.319-4.485-.333-.584-.583-1.036-.667-1.071l-9.52 5.83c1.583 3.249 3.915 6.069 6.902 7.901 4.462 2.678 10.459 3.499 16.731 2.059 4.082-1.189 7.604-3.652 9.448-7.401 2.666-4.915 2.094-10.864 2.07-17.444.06-10.735.001-21.468.001-32.237z"></path>
									</svg>JavaScript</p>
							</td>
							<td>1年</td>
							<td><span class="stars">★★</span><span class="stars_residue">★★★</span></td>
						</tr>
						<tr>
							<td>
								<p class="skill_name">
									<svg viewBox="0 0 128 128" width="30px" height="30px">
										<path fill="#fff" d="M22.67 47h99.67v73.67H22.67z"></path>
										<path data-name="original" fill="#007acc" d="M1.5 63.91v62.5h125v-125H1.5zm100.73-5a15.56 15.56 0 017.82 4.5 20.58 20.58 0 013 4c0 .16-5.4 3.81-8.69 5.85-.12.08-.6-.44-1.13-1.23a7.09 7.09 0 00-5.87-3.53c-3.79-.26-6.23 1.73-6.21 5a4.58 4.58 0 00.54 2.34c.83 1.73 2.38 2.76 7.24 4.86 8.95 3.85 12.78 6.39 15.16 10 2.66 4 3.25 10.46 1.45 15.24-2 5.2-6.9 8.73-13.83 9.9a38.32 38.32 0 01-9.52-.1 23 23 0 01-12.72-6.63c-1.15-1.27-3.39-4.58-3.25-4.82a9.34 9.34 0 011.15-.73L82 101l3.59-2.08.75 1.11a16.78 16.78 0 004.74 4.54c4 2.1 9.46 1.81 12.16-.62a5.43 5.43 0 00.69-6.92c-1-1.39-3-2.56-8.59-5-6.45-2.78-9.23-4.5-11.77-7.24a16.48 16.48 0 01-3.43-6.25 25 25 0 01-.22-8c1.33-6.23 6-10.58 12.82-11.87a31.66 31.66 0 019.49.26zm-29.34 5.24v5.12H56.66v46.23H45.15V69.26H28.88v-5a49.19 49.19 0 01.12-5.17C29.08 59 39 59 51 59h21.83z"></path>
									</svg>TypeScript
								</p>
							</td>
							<td>1ヶ月</td>
							<td><span class="stars">★</span><span class="stars_residue">★★★★</span></td>
						</tr>
						<tr>
							<td>
								<p class="skill_name"><svg viewBox="0 0 128 128" width="30px" height="30px">
										<defs>
											<path id="php-original-a" d="M64.026 96.076c33.676 0 60.976-14.361 60.976-32.076s-27.3-32.075-60.976-32.075S3.051 46.285 3.051 64s27.3 32.076 60.975 32.076"></path>
										</defs>
										<defs>
											<path id="php-original-c" d="M2.998 31.924h122.004v64.1H2.998z"></path>
										</defs>
										<clipPath id="php-original-b">
											<use xlink:href="#php-original-a" overflow="visible"></use>
										</clipPath>
										<clipPath id="php-original-d" clip-path="url(#php-original-b)">
											<use xlink:href="#php-original-c" overflow="visible"></use>
										</clipPath>
										<g clip-path="url(#php-original-d)">
											<defs>
												<path id="php-original-e" d="M2.998 31.924h122.004v64.1H2.998z"></path>
											</defs>
											<clipPath id="php-original-f">
												<use xlink:href="#php-original-e" overflow="visible"></use>
											</clipPath>
											<g clip-path="url(#php-original-f)">
												<image overflow="visible" width="1160" height="609" xlink:href="data:image/jpeg;base64,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 Hnfonne2dsuvF1nS2yxbKurKXWdRdZ0tssaspqyy6sprWdRdZ0assutZ1F1nRrWdS61nRrWdRrWd S63jZrNkYzrNZzrNmc6yZzrNZzrNZliZzrNTOsmZZZnOskzrNTOs2TOskllZliZlhJZWZYkllZli SWVmWJJZYEoS0KEBKlkAoRAqWQESWKlkJYJZEliyWElkSWGZZGc6yuc6yZxvEYzrKgAO/wDQO/nc QmPOvRfOts9WXXi6zV1ZYtlXVlLrOous1dWWNWU1ZZdWU1rNjWs6LrOpdazTWs6jWs2XesaNazY/ S40u7mxqSFzcjFzZJckzc1M6zWZcpM6zWZYZlzZM6zUzrJM6zZM6ySXNSWJmWEzrNSWJM6zUliTO s1JYkllgShLQoQEqWQChECpZARJYqWQlglkSWLJYSWRJcklzLM6yZzrJjOsxjOsqAA7/ANA7+dxC Y869F862z1c614tlW6zotljVzpbZY1ZV1c6i6zous6i6zpdXOo1c6NazZdazo1c6jWsal1rGjdzY 3rFN3FXTIuURlBm5qRCZubGbDMuamdZqZsSZsrMsMyyzMsJmypnWUksJmypLEmbKksSZsqSxJLLA lCWhQgJUsgFCIFSyBISxUshLBLIksWSwksiZ1kmdZlmdZM51kxnWIznWVAAd/wCgd/O4hMedei+d bZ2y7caudRbKurnUWyrqyxdZ0Wyy6spq51GrnS6udRq50a1jUutY0bubGtY0bubLrWKbuKbZsVBZ IWSUiDNzUiJJc1IhM2WTNhM2VM2EzZZM6ySWVmWJM6zUlhM2JJZUzYkllSWJIWBKEtChASpZAKEQ SpYJZCWKlkJYQRJYslhJZEzYTOsyzNhnOsmMbxGc6yoADv8A0Dv53EJjzr0XzrbO2Xbi2WNWVbZY 1c6W6zY1c6NXNXWs2NXOjVzqXVzo1c6jVzTdzZd3NN3NjWsU3cpds01cU0zDUgskLJKREkQZuaZu RmyyZsJmypmxJEqS5GbKkRJLKmbCSxJnWaksSSypmxILAlCVSUAJYIBUsgJUsEshLFSyECSyEsWS yJnWSSwzLJc51kmNZM41mMSxQAHf+gd/O4hMec+jec7Z3Wbtxq51Fsq6ubGrKurmmrLGrnS3WbGr nRq5sbuautZsa1jRq5q7ubG7im7ixu4ptku2UaZGpJWpIiIWSCJTKDNlkiEiVJcjNlkiElhM2WSX JJZUlyjNlSWEiJJZZJYQWBKssoShALBASpYBLAJZCWKlkQElkILJZEzYSXJJZLnOsmc6yYzrEZli gAO/9A7+dxCY859G842z1ZduLZYus1dWWLrNXVzTVljVzpbZY1c01rNNXOpdXNN3Go1c01rFl3cU 3cU2zY0g0yNMjUgsgskqyQuUESxEJEpmwkRJLmmbCS5pmxJLkZsqSxJEqSxJLKkuUZsAAFiWiUJQ IJQhLAJYBCIFgiAkslksESJLCZ1kmdZlzLkmNZMZ1mXAAAHf+gd/O4hJ8Q65U6igoqgBQUFEUCiq CgoKQoAUFABQAAAIAEAgAQEFQEBAQIgICFICABAkBBSAAEAoCkQAAKAEQAAEAEQALAQEBBEgIEgQ AAD64fTB/9oACAECAAEFAP8AljGRkZGRkZGRkZGRkZGRkZGRkZGRkZGRkZGRkZGRkZGRkZGRkZGR kZGMYxjPu/8AnqV/z1K/46lf8dSv+OpX/HUr/jqV2fUrs+pXZ9Suz6ldl1K7LqV2XUrsupXZdSux 6ldj1K7HqV2PUrsepXY9Sux6ldj1K7HqV2PUrsepXY9Sux6ldj1K7HqV2PUrsepXY9Sux6ldj1K7 HqV/z1K//9oACAEDAAEFAL9HWta1rWta1rWta1rWta1rW/iL1KvUq9Sr1KvUr/rqV/11K/66lf8A XUr/AK6lf9dSv++pX/fUr/vqV/31K/76ldp1K7TqV2nUrtOpXadSu06ldp1K7TqV2nUrtOpXadSu 06ldp1K7TqV2nUrtOpXadSu06ldp1K7TqV2nUr/rqV//2gAIAQEAAQUA7S2dn675u9d83eu+bvXf N3rvm713zd655u9d83euebvXPN3rnm71zzd655u9c82euebPXPNnrnmz1zzZ655s9c82et+bPXPN nrnmz1zzZ635s9b82et+bPW/Nnrfmz1vzZ635s9b82et+bPW/Nnrfmz1vzZ635s9b82et+bPW/Nn rfmz1vzZ635s9b82et+bPW/Nnrfmz1vzZ635s9b82et+bPW/Nnrfmz1vzZ635s9b82et+bPW/Nnr fmz1vzZ635s9b82et+bPXPNnrnmz1zzZ635s9c82euebPXPNnrnmz1zzZ655s9c82euebvXPN3rn m71zzd655u9d83euebvXfN3rvm713zd675u9d83eu+bvXfOHr3nD17zh695w9e84evecPXvOXr/n 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 Qv4arxV4qqqqv0PjjwTte74nM4icTiczmJxETiJxOInGJGMYxjGMYxjGMYxixZxYs4vFXiqvFXm8 Veaq8Xm8VfwtVVXiqqqqr0/jjwTte7ROZzEROYicRE4nERE4icSJEnGMYxjGMYxjGMZxixZxV4qq vF4qrxVXiqqrzeavFX8JVVV4qqqqq9P448E7Xu+IiJzOYnE4iJxEREROIiIk6GJGMYxjGMYxixjO KsXirzV4qrxVXi8VebzVVeb+Gq8VVVVVVXp/HHgna93zOYicxOInERERERERERE5kScYxjGMYxjG cWLOaqqqqqqqqqrxV4q81V5vQq/havFVVVVVV6fxx4J2vd9CcRETicRE4iIiIiJxEREREScYxjGM YxjGMZxYqqqqqqqqqqqqqqvF4qqvTq/havFVVVVVV6fxx4J2vdxOZzERE4iIiIiIiIiIiIiIk4kS JGMYxjGMYsWc2Kqqqqqqqqqqqqq8VVVebzVVfwtXiqqqqqq9P448E7Xu4nM5iIicRERERERERERE REREiRIxjGMYxjFixVVVVVVVVVVVXiqqrxVVV5vNXir+Eq8VVVVVVXp/HHgnad3E5nM5icRERERE RERERERERESJxIxjGMWcVViqqqqqqqqqqqqqqrxV5vN5q8Vfwt4q8VVVVXp/HHgnad2iInM5icRO IiIiIiIiIiIiIiIiRIxjGMWLFVVVVVVVVVVVVVVXirxV5vNVV5q/hKvFVVVVVV6fxx4J2ndoiJxE 5icROIiIiIiIiIiIiIiIiREjGMWLFiqqqqqqqqqqqqqqrxV4q81eKqr0L+EvNVVVVVV6fxx4J2nd oiIiJzE4icREREREREREREREREREjFiqqqqqqqqqqqqqqqqrxV4q81VVVXoX8JeavFVVVV6fxx4J 2ndoiIiJzE4iIiIiIiIiIiIiIiIiIiIxVVVVVVVVVVVVVVVVVVVXirxVVV4q81fwlXirxVVVVen8 ceCdp3aIiIicxOIiIiIiIiIiIiIiIiIiIiVq1VVVVVVVVVVVVVVVVVVV4q8VVVVVeav4SrxV4qqq qvT+OPBO07tEROInMTiJxEREREREREREREREREStWrVVVVVVVVVVVVVVVVV4q8Veaqqqr0L+EvNV VVVVV6fxx4J2ndoiJzOYnETiIiIiIiIiIiIiIiIlRK1rVqrVVVVVVVVVVVVVVVXirxV5q8VVXmr+ EvNVVVVVV6fxx4J2ndxOInM5icROIiIiIiIiIiIiIiIiVK1rWtWrVVVVVVVVVVVVVVVXirxV5vNX i81fwlXiqqqqqq9P448E7Tu4nM5nMTiIiIiIiIiIiIiIiIiVLxrWta1rVq1VVVVVVVVVVVVVVVXi rzebzV4q/hKvFXiqqqq9P448E7Xu4nM5iIicRERERERERERERERESpWta1rWta1aqqqqqqqqqqqq qqqrxVVV5vNVVX8JV4qqqqqqvT+OPBO17tOZzEROYiIiIiJxEREREREvMrWta1rWtatbzaqqqqvF VVVVVeKq8VVVebzeKv4WrxVVVVVVen8ceCdr3fM5iInE5icRERERERERETiJeda1rWta1rW8W81V VVVVXiqqrxV5vFVV5vQv4arxVVVVVVen8ceCdr3fETmInMTiIiJxEREROIiIl6ErWta1rWta1rVq 3m1VVeKqqqrxVVV4q81eLxV5q/havFVVVVVV6fxx4J2vd8TmcziInETiIiInETiIiIlS861rWta1 rWta1vNq1VVVVV4qqqqqrxVXi81eL+JqqqqqqqqvT+OPBO17tE5nMRE6ETiJxE4iInE5iVK3jWta 1rWta1rebWreKvFVVVVVV4q9GqvN5q8VfwlVVXiqqqqr0/jjwTte7nTiJzE4nMTiInERE4nMrWta 1rWta1rWta1a1vN4qqvFVeKvN4q81V6dX8LV4q8VVVVVen8ceCdr3c6E4nM5iczmJxETmcTjW8a1 rWta1rWta1rWta3i3i8W81V4q8VV4qrxebxV5v4arxV4qqqqv0PjjwT/AKz/AOPtV7We1ntd7Ye2 Htl7ae2ntt7ce3Ht17ee3nt9+gfoX6F+ifo36N+kfpX6Z+mfp36h+ofqX6p+qfq36x+sfrX61+uf rn65+vfr369+vfr369+vfrn65+ufrX61+sfrH6t+qfqn6l+ofqH6d+mfpn6V+kfo36N+ifoX6F+g e33t57ee3Xtx7ce23tp7ae2Xth7Ye13tZ7We1XtR7Ue03tR7Ue1HtR7Ue1HtR7Ue1HtR7Ue1HtR7 Ue1HtN7Te03tN7Te0ntJ7Se0ntF7Re0XtB7Qe0Hs97Pezns57NezHst7Leynsl7Iex3sZ7Few3sJ 7Af+fv8Az9/5+/8AP3/n7/z9/wCfvJfQ/wD6n//aAAgBAgIGPwD4YIIIIIIIIIIIIIIIIIIIIIII IIIWLop0U6KdFOinRTop0U6KdFOinRTop0U6KdFPxFPxFPxFfbiK+3EU/EU/EU/EU/EU/EU/EU/E U/EU/EU/EU/EU/EU/EU/EU/EU/8AX+T0PQ2bNmzZs2bNGjRo0aNGjRZZZZZo0aNGjRo0bNmzZs2b Nnoeh6Hoeh6GzZs2bNGjRo0WWWWWX8n/2gAIAQMCBj8A/ZcyKZFMimRTIpkUyKZFMimRTIpkUyKZ FMimRTIpkUyKZFMimRTIpkUyKZFMiq6ZMmTJkyZKKKKKKKKKKK+CiiiiiiiiijJkyZMmTJkwYMmT JkyUUUUUUV+D/9oACAEBAQY/AFGX9kRmThV7jyFXuPIVe48hV7jyFUt5CqW8hVLeQqlvIVS3kKpb yFUt5CqW8hVLeQqlvIVS3kKpbyFUt5CqW8hVLeQqlvIVS3kKpbyFUt5CqW8hVLgKpcBVLeQqlvIV S3kKpbyFUt5CqW8hVLeQqlwFUuAqlwFUuAqlwFUuAqlwFUuAqlwFUuAqlwFUuAqlwFUuAqlwFUuA qlwFUuAqlwFUuAqlwFUt5CqW8hVLeQqlvIVS3kKpbyFUt5CqXAVS4CqW8hVLeQqlvIVS3kKpbyFU t5CqW8hVLeQqlvIVS3kKpbyFUt5CqW8hVLeQqlvIVS3kKpbyFUt5CqW8hVLeQq9x5Cq3HkKvceQq 9x5Cr3HkKvceQq9x5Cr3HkKvceWAq9x5YCr3HlgKvceWAq9x5YCr3HlgKvceWArNx5YCs3HlgKzc eWArNx5YCs3HlgKzceWArNx5YCs3HlgK3ceWArdx5YCt3HlgK3ceWArd15YCu3XlgK7deWArt15Y Cu3XlgK7deWArt15YCu3XlgK7deWArt15YCu3XlgK7deWArt15YCu3XlgK7deWArt15YCu3XlgK7 deWArt15YCu3XlgK7deWArt15YCu3XlgK7deWArt15YCu3XlgK7deWArt15YCu3XlgK7deWArt15 YCu3XlgK7deWArt15YDtL7u8rfUjcSSTV/gjSxeU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSxeU7r Ee5yp0sXlO6xHucqdLF5TusR7nKnSxeU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSxeU7rEe5yp0sX lO6xHucqdLF5TusR7nKnSxeU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSxeU7rEe5yp0sXlO6xHucq dLF5TusR7nKnSxeU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSxeU7rEe5yp0sXlO6xHucqdLF5TusR 7nKnSxeU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSxeU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSxeU 7rEe5yp0sXlO6xHucqdLF5TusR7nKnSxeU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSxeU7rEe5yp0 sXlO6xHucqdLF5TusR7nKnSxeU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSxeU7rEe5yp0sXlO6xHu cqdLF5TusR7nKnSxeU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSxeU7rEe5yp0sXlO6xHucqdLF5Tu sR7nKnSxeU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSxeU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSx eU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSxeU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSxeU7rEe5y p0sXlO6xHucqdLF5TusR7nKnSxeU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSxeU7rEe5yp0sXlO6x HucqdLF5TusR7nKnSxeU7rEe5yp0sXlO6xHucqdLF5TusR7nKnSw/wAv6+P5/wCCTESYiTESYiTE SYiTESYiTESoiVESoiVESoiVESoiVESoiVES4iXES4iXES4iXES4iXES4jwiPCI8IjwiPCI8B4Dw HgPAeA8B4jxHiPEeI8R4jwHgPAeA8B4DwHgPCI8IjwiPCIlxEuIlxEuIlxEuIlxEuIlxEqIlREqI lREqIlREqIlREqIlREmIkxEmIkxEmIkxEmIkxEmIkxEiIkREiIkREiIkREiIkREiIkREiIkREiIk REiIkREiIkREiIkREiIkREiIkREiIkREiIkREiIkREiIkREiIkREiI9eI9eI9eI9eI9eI9eI9eI9 eI9eI9aI9aI9b7D1vsPW+w9X7D1fsPV+w9X7D1fsPV+w9X7Dd/8AF/X+v8i/b+r5+Py+P4+fn/TP /9k=" transform="matrix(.106 0 0 -.106 2.825 96.168)"></image>
											</g>
										</g>
										<path fill="#6181B6" d="M64.026 93.694c32.36 0 58.594-13.295 58.594-29.694S96.387 34.306 64.026 34.306 5.433 47.601 5.433 64s26.233 29.694 58.593 29.694z"></path>
										<path fill="#fff" d="M75.896 73.598l2.906-14.958c.656-3.377.11-5.896-1.62-7.486-1.677-1.54-4.523-2.288-8.703-2.288h-5.033l1.44-7.412a.955.955 0 00-.935-1.135h-6.947a.954.954 0 00-.936.771l-3.086 15.881c-.28-1.787-.973-3.323-2.079-4.591-2.038-2.332-5.261-3.515-9.58-3.515H27.856a.951.951 0 00-.935.771L20.674 81.78a.953.953 0 00.935 1.134h7.002a.953.953 0 00.936-.771l1.511-7.775h5.213c2.735 0 5.032-.296 6.827-.881 1.834-.596 3.522-1.607 5.011-3.001a15.364 15.364 0 002.96-3.676l-1.248 6.424a.95.95 0 00.935 1.134h6.947a.954.954 0 00.936-.771l3.429-17.645h4.767c2.031 0 2.626.404 2.787.578.147.159.452.718.11 2.48l-2.764 14.223a.95.95 0 00.935 1.134h7.058a.951.951 0 00.935-.769zm-32.208-12.36c-.437 2.242-1.259 3.842-2.444 4.755-1.205.927-3.132 1.397-5.727 1.397h-3.104l2.244-11.548h4.012c2.948 0 4.136.63 4.612 1.158.662.734.802 2.199.407 4.238zm61.916-8.858c-2.038-2.332-5.261-3.515-9.581-3.515H82.559a.952.952 0 00-.936.771L75.375 81.78a.953.953 0 00.935 1.134h7.003a.953.953 0 00.935-.771l1.512-7.775h5.212c2.735 0 5.033-.296 6.827-.881 1.835-.596 3.522-1.607 5.011-3.001 1.241-1.141 2.264-2.421 3.037-3.806a15.404 15.404 0 001.65-4.588c.797-4.094.16-7.363-1.893-9.712zm-7.262 8.858c-.437 2.242-1.259 3.842-2.444 4.755-1.204.927-3.131 1.397-5.727 1.397h-3.104l2.245-11.548h4.012c2.948 0 4.136.63 4.612 1.158.662.734.801 2.199.406 4.238z"></path>
										<path fill="#000004" d="M38.67 54.89c2.66 0 4.434.491 5.32 1.474.885.982 1.097 2.668.633 5.057-.484 2.488-1.416 4.264-2.798 5.328-1.382 1.063-3.485 1.595-6.308 1.595h-4.26l2.614-13.453h4.799v-.001zM21.609 81.962h7.002l1.661-8.546h5.998c2.646 0 4.823-.277 6.532-.834 1.709-.556 3.263-1.488 4.661-2.797a14.369 14.369 0 002.85-3.569c.727-1.3 1.242-2.734 1.547-4.305.741-3.811.182-6.778-1.676-8.904s-4.812-3.189-8.862-3.189H27.856l-6.247 32.144zm35.394-40.691h6.947l-1.661 8.546h6.189c3.894 0 6.58.68 8.059 2.037 1.479 1.359 1.921 3.561 1.33 6.603l-2.906 14.959h-7.058l2.763-14.223c.314-1.618.199-2.722-.347-3.311-.546-.587-1.708-.882-3.485-.882h-5.553l-3.578 18.416h-6.947l6.247-32.145zM93.324 54.89c2.66 0 4.434.491 5.319 1.474.887.982 1.097 2.668.634 5.057-.484 2.488-1.417 4.264-2.799 5.328-1.382 1.063-3.484 1.595-6.308 1.595h-4.259l2.614-13.453h4.799v-.001zm-17.06 27.072h7.002l1.661-8.546h5.997c2.646 0 4.823-.277 6.532-.834 1.71-.556 3.264-1.488 4.661-2.797a14.35 14.35 0 002.851-3.569c.726-1.3 1.242-2.734 1.547-4.305.74-3.811.182-6.778-1.676-8.904s-4.812-3.189-8.863-3.189H82.511l-6.247 32.144z"></path>
									</svg>PHP</p>
							</td>
							<td>2年</td>
							<td><span class="stars">★★★</span><span class="stars_residue">★★</span></td>
						</tr>
					</tbody>
				</table>
				<div class="skill_type fade-in">
					<h3>フレームワーク / ライブラリ</h3>
					<p>Symfony：EC-CUBE(Ver.4系)を使用したECサイトの開発経験</p>
					<p>Laravel：独学で習得。趣味で個人ブログを自作中</p>
					<p>React：独学で習得後、TypeScriptとMaterial-UIを用いたTODOアプリを作成 </p>
					<p>UiPath：PCにおける定型業務（書類作成や転記処理等）の自動化やOCR、Webページのスクレイピング等が可能</p>
				</div>
				<table class="fade-in">
					<thead>
						<tr>
							<th>技術名</th>
							<th>経験年数</th>
							<th>スキルレベル</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<p class="skill_name"><svg viewBox="0 0 128 128" width="30px" height="30px">
										<path fill="#1A171B" d="M64 2.3C29.9 2.3 2.3 29.9 2.3 64s27.6 61.7 61.7 61.7 61.7-27.6 61.7-61.7S98.1 2.3 64 2.3zM97.3 38c-2.9.1-4.8-1.6-4.9-4.2 0-1 .2-1.8.9-2.8.6-1.2.8-1.4.8-1.9-.1-1.6-2.5-1.7-3.2-1.7-9.3.3-11.7 12.8-13.7 23l-1 5.4c5.3.8 9.1-.2 11.2-1.5 3-1.9-.8-3.9-.4-6.1.5-2.2 2.5-3.3 4.1-3.4 2.3-.1 3.9 2.3 3.8 4.7-.1 3.9-5.3 9.4-15.8 9.1-1.3 0-2.4-.1-3.5-.2l-2 10.9c-1.8 8.2-4.1 19.5-12.5 29.3-7.2 8.6-14.5 9.9-17.8 10-6.1.2-10.2-3.1-10.3-7.4-.1-4.2 3.6-6.5 6-6.6 3.3-.1 5.5 2.3 5.6 5 .1 2.3-1.1 3-1.9 3.5-.5.4-1.3.9-1.3 1.8 0 .4.5 1.3 1.8 1.3 2.6-.1 4.3-1.4 5.5-2.2 6-5 8.3-13.7 11.3-29.4l.6-3.8c1-5.1 2.2-10.9 3.9-16.6-4.2-3.2-6.7-7.1-12.4-8.6-3.9-1.1-6.2-.2-7.9 1.9-2 2.5-1.3 5.7.6 7.6l3.1 3.5c3.9 4.5 6 7.9 5.2 12.6-1.1 7.3-10 13-20.5 9.8-9-2.8-10.6-9.1-9.5-12.6.9-3.1 3.4-3.7 5.8-2.9 2.6.8 3.6 3.9 2.8 6.3-.1.3-.2.7-.5 1.2-.3.7-.8 1.2-1.1 2-.6 1.9 2 3.2 3.8 3.8 4 1.2 7.9-.9 8.9-4.1.9-3-1-5.1-1.7-5.9l-3.8-4.1c-1.7-1.9-5.6-7.3-3.7-13.4.7-2.3 2.2-4.8 4.4-6.4 4.6-3.5 9.7-4 14.5-2.6 6.2 1.8 9.2 5.9 13.1 9.1 2.2-6.3 5.2-12.6 9.7-17.8 4.1-4.8 9.5-8.2 15.8-8.5 6.3-.2 11 2.6 11.2 7.1-.1 2-1.2 5.7-5 5.8z"></path>
									</svg>Symfony</p>
							</td>
							<td>1年</td>
							<td><span class="stars">★★★</span><span class="stars_residue">★★</span></td>
						</tr>
						<tr>
							<td>
								<p class="skill_name"><svg viewBox="0 0 128 128" width="30px" height="30px">
										<path fill-rule="evenodd" clip-rule="evenodd" fill="#FD4F31" d="M16.934 1.719c-1.127.088-2.234.074-3.325.373-2.387.655-4.508 1.702-6.379 3.316-1.1.948-2.06 1.97-2.875 3.174-1.258 1.859-2.115 3.857-2.545 6.106.172.301.353.617.545.938 1.219 2.038 2.439 4.062 3.661 6.098l3.212 5.341c.988 1.646 1.974 3.293 2.96 4.939l4.608 7.688 3.143 5.244c1.527 2.545 3.058 5.088 4.583 7.634l5.609 9.371c1.617 2.699 3.237 5.396 4.857 8.093l.216.314c.235.075.422.011.616-.035 2.134-.512 4.268-1.021 6.402-1.531 3.461-.827 6.922-1.651 10.383-2.479l5.421-1.297c3.499-.836 6.999-1.67 10.498-2.508 3.537-.846 7.073-1.696 10.611-2.543 1.788-.429 3.576-.856 5.365-1.283 3.461-.826 6.922-1.65 10.383-2.474l11.308-2.693.611-.165-.167-.331-3.086-4.362-3.048-4.315-3.26-4.604-3.116-4.413-3.088-4.361-3.188-4.507c-1.041-1.47-2.084-2.938-3.126-4.407l-1.647-2.326a4.275 4.275 0 01-.587-1.159c-.326-1.011.046-1.684.636-2.181.382-.323.822-.56 1.298-.7a20.898 20.898 0 012.01-.51c1.359-.257 2.727-.475 4.091-.702l4.624-.754c.975-.161 1.949-.33 2.924-.495 1.325-.224 2.65-.449 3.976-.67 1.287-.216 2.574-.43 3.861-.642l4.213-.689 2.924-.491c1.112-.186 2.223-.371 3.334-.553 1.386-.226 2.771-.454 4.157-.671.826-.129 1.652-.174 2.472.062a5.63 5.63 0 011.696.833l.721.503c.072-.166-.032-.256-.08-.351a16.543 16.543 0 00-4.26-5.422 16.399 16.399 0 00-5.636-3.09c-1.229-.389-2.492-.208-3.778-.305M55.689 127c-.062 0-.117-.45-.187-.569-1.5-2.56-3.016-5.308-4.498-7.877a1335.74 1335.74 0 01-5.557-9.74c-1.965-3.478-3.913-6.966-5.863-10.452a5709.989 5709.989 0 01-5.549-9.948c-1.115-2.005-2.223-4.014-3.337-6.02l-.296-.459-.542.107c-1.072.277-2.142.556-3.212.838-1.49.392-2.979.791-4.47 1.18-3.347.871-6.694 1.737-10.041 2.605-3.404.884-6.951 1.77-10.356 2.65-.207.053.219.071-.781.106v21.145c.412.656.373.347.399.563.079.626.207 1.257.317 1.877.412 2.31 1.339 4.425 2.679 6.351 1.965 2.826 4.582 4.846 7.788 6.082 1.145.44 2.34.75 3.562.9l1.241.328"></path>
										<path fill-rule="evenodd" clip-rule="evenodd" fill="#FD4F31" d="M4.976 77.742c3.939-.937 7.879-1.873 11.818-2.808 1.73-.41 3.461-.815 5.191-1.227.865-.206 1.732-.402 2.59-.634.764-.206.858-.459.465-1.148-.568-.996-1.146-1.986-1.721-2.979l-5.064-8.72-5.062-8.721c-1.717-2.958-3.436-5.916-5.154-8.873l-4.412-7.59c-.636-1.094-1.408-2.191-2.047-3.284-.119-.199.42-.437-.58-.543v47.396c0-.032.453-.059.606-.096l3.37-.773zm121.248 33.878c-1.544.549-3.089 1.102-4.632 1.655l-10.545 3.781c-1.953.701-3.902 1.41-5.856 2.108-3.982 1.421-7.966 2.837-11.949 4.255-2.308.822-4.617 1.838-6.924 2.664-.632.227-1.255.917-1.881.917h26.49l.57-.327c.674-.029 1.337-.229 1.999-.35 2.719-.497 5.154-1.673 7.311-3.392 1.657-1.321 3.005-2.936 4.061-4.778 1.086-1.896 1.731-3.947 2.041-6.101.027-.186.085-.397-.071-.589-.22-.017-.414.086-.614.157zm-2.275-35.571c-1.168-1.598-2.339-3.193-3.505-4.792-1.609-2.207-3.215-4.416-4.822-6.624-.653-.896-1.315-1.785-1.952-2.691-.192-.273-.411-.346-.71-.265l-.171.049c-2.958.719-5.917 1.436-8.876 2.153l-5.302 1.287-10.372 2.519c-3.419.831-6.838 1.663-10.258 2.492l-10.662 2.582c-3.497.849-6.992 1.701-10.488 2.551l-10.142 2.462c-1.787.434-3.574.866-5.359 1.302-.263.064-.546.08-.826.292l.239.455a5999.968 5999.968 0 009.598 16.529c1.874 3.213 3.753 6.424 5.63 9.636 1.079 1.845 2.151 3.692 3.239 5.532a661.851 661.851 0 003.653 6.115c.369.607.788 1.187 1.21 1.759a3.64 3.64 0 001.046.957c.426.257.885.338 1.369.229.25-.057.495-.139.737-.223l.89-.33c3.237-1.107 6.473-2.214 9.711-3.317 2.526-.86 5.055-1.716 7.583-2.571 2.509-.851 5.02-1.698 7.53-2.545l7.474-2.524c2.548-.861 5.095-1.722 7.642-2.585 3.126-1.061 6.251-2.126 9.379-3.185 3.015-1.02 6.033-2.034 9.049-3.052.185-.062.389-.088.542-.291l.019-.439c.001-6.255-.001-12.511.006-18.766a1.38 1.38 0 00-.289-.873c-.948-1.269-1.877-2.551-2.812-3.828zm-.519-58.938c-.702-.889-1.596-1.171-2.692-.885-.477.125-.967.204-1.453.293-1.594.292-3.19.579-4.784.868-2.334.424-4.667.852-7.001 1.272-1.848.332-3.697.659-5.546.983l-7.418 1.298c-.311.054-.625.108-.925.204-.437.14-.563.414-.363.825.163.336.366.657.586.959 1.534 2.114 3.075 4.223 4.616 6.333 2.124 2.909 4.249 5.817 6.374 8.724 1.798 2.46 3.598 4.92 5.397 7.379 1.414 1.932 2.828 3.864 4.244 5.795l.279.338 12.271-3.033.029-.636c.001-8.511-.001-17.022.006-25.534 0-.376-.091-.678-.328-.976-1.032-1.303-2.045-2.621-3.066-3.933l-.226-.274zm3.301 41.241c-1.856.446-3.719.87-5.62 1.373.201.357 5.415 7.395 5.718 7.729l.19.105.021-.429.001-2.963c.001-1.719.005-3.438.001-5.157 0-.209.059-.434-.085-.646l-.226-.012z"></path>
									</svg>Laravel</p>
							</td>
							<td>1年</td>
							<td><span class="stars">★★</span><span class="stars_residue">★★★</span></td>
						</tr>
						<tr>
							<td>
								<p class="skill_name">
									<svg viewBox="0 0 128 128" width="30px" height="30px">
										<g fill="#61DAFB">
											<circle cx="64" cy="64" r="11.4"></circle>
											<path d="M107.3 45.2c-2.2-.8-4.5-1.6-6.9-2.3.6-2.4 1.1-4.8 1.5-7.1 2.1-13.2-.2-22.5-6.6-26.1-1.9-1.1-4-1.6-6.4-1.6-7 0-15.9 5.2-24.9 13.9-9-8.7-17.9-13.9-24.9-13.9-2.4 0-4.5.5-6.4 1.6-6.4 3.7-8.7 13-6.6 26.1.4 2.3.9 4.7 1.5 7.1-2.4.7-4.7 1.4-6.9 2.3C8.2 50 1.4 56.6 1.4 64s6.9 14 19.3 18.8c2.2.8 4.5 1.6 6.9 2.3-.6 2.4-1.1 4.8-1.5 7.1-2.1 13.2.2 22.5 6.6 26.1 1.9 1.1 4 1.6 6.4 1.6 7.1 0 16-5.2 24.9-13.9 9 8.7 17.9 13.9 24.9 13.9 2.4 0 4.5-.5 6.4-1.6 6.4-3.7 8.7-13 6.6-26.1-.4-2.3-.9-4.7-1.5-7.1 2.4-.7 4.7-1.4 6.9-2.3 12.5-4.8 19.3-11.4 19.3-18.8s-6.8-14-19.3-18.8zM92.5 14.7c4.1 2.4 5.5 9.8 3.8 20.3-.3 2.1-.8 4.3-1.4 6.6-5.2-1.2-10.7-2-16.5-2.5-3.4-4.8-6.9-9.1-10.4-13 7.4-7.3 14.9-12.3 21-12.3 1.3 0 2.5.3 3.5.9zM81.3 74c-1.8 3.2-3.9 6.4-6.1 9.6-3.7.3-7.4.4-11.2.4-3.9 0-7.6-.1-11.2-.4-2.2-3.2-4.2-6.4-6-9.6-1.9-3.3-3.7-6.7-5.3-10 1.6-3.3 3.4-6.7 5.3-10 1.8-3.2 3.9-6.4 6.1-9.6 3.7-.3 7.4-.4 11.2-.4 3.9 0 7.6.1 11.2.4 2.2 3.2 4.2 6.4 6 9.6 1.9 3.3 3.7 6.7 5.3 10-1.7 3.3-3.4 6.6-5.3 10zm8.3-3.3c1.5 3.5 2.7 6.9 3.8 10.3-3.4.8-7 1.4-10.8 1.9 1.2-1.9 2.5-3.9 3.6-6 1.2-2.1 2.3-4.2 3.4-6.2zM64 97.8c-2.4-2.6-4.7-5.4-6.9-8.3 2.3.1 4.6.2 6.9.2 2.3 0 4.6-.1 6.9-.2-2.2 2.9-4.5 5.7-6.9 8.3zm-18.6-15c-3.8-.5-7.4-1.1-10.8-1.9 1.1-3.3 2.3-6.8 3.8-10.3 1.1 2 2.2 4.1 3.4 6.1 1.2 2.2 2.4 4.1 3.6 6.1zm-7-25.5c-1.5-3.5-2.7-6.9-3.8-10.3 3.4-.8 7-1.4 10.8-1.9-1.2 1.9-2.5 3.9-3.6 6-1.2 2.1-2.3 4.2-3.4 6.2zM64 30.2c2.4 2.6 4.7 5.4 6.9 8.3-2.3-.1-4.6-.2-6.9-.2-2.3 0-4.6.1-6.9.2 2.2-2.9 4.5-5.7 6.9-8.3zm22.2 21l-3.6-6c3.8.5 7.4 1.1 10.8 1.9-1.1 3.3-2.3 6.8-3.8 10.3-1.1-2.1-2.2-4.2-3.4-6.2zM31.7 35c-1.7-10.5-.3-17.9 3.8-20.3 1-.6 2.2-.9 3.5-.9 6 0 13.5 4.9 21 12.3-3.5 3.8-7 8.2-10.4 13-5.8.5-11.3 1.4-16.5 2.5-.6-2.3-1-4.5-1.4-6.6zM7 64c0-4.7 5.7-9.7 15.7-13.4 2-.8 4.2-1.5 6.4-2.1 1.6 5 3.6 10.3 6 15.6-2.4 5.3-4.5 10.5-6 15.5C15.3 75.6 7 69.6 7 64zm28.5 49.3c-4.1-2.4-5.5-9.8-3.8-20.3.3-2.1.8-4.3 1.4-6.6 5.2 1.2 10.7 2 16.5 2.5 3.4 4.8 6.9 9.1 10.4 13-7.4 7.3-14.9 12.3-21 12.3-1.3 0-2.5-.3-3.5-.9zM96.3 93c1.7 10.5.3 17.9-3.8 20.3-1 .6-2.2.9-3.5.9-6 0-13.5-4.9-21-12.3 3.5-3.8 7-8.2 10.4-13 5.8-.5 11.3-1.4 16.5-2.5.6 2.3 1 4.5 1.4 6.6zm9-15.6c-2 .8-4.2 1.5-6.4 2.1-1.6-5-3.6-10.3-6-15.6 2.4-5.3 4.5-10.5 6-15.5 13.8 4 22.1 10 22.1 15.6 0 4.7-5.8 9.7-15.7 13.4z"></path>
										</g>
									</svg>
									React
								</p>
							</td>
							<td>1ヶ月</td>
							<td><span class="stars">★</span><span class="stars_residue">★★★★</span></td>
						</tr>
						<tr>
							<td>
								<p class="skill_name"><svg fill="none" width="30px" height="30px" xmlns="http://www.w3.org/2000/svg" viewBox="0.155 0 37.299 38">
										<g fill="#0085ca">
											<path d="M37.454 36.845V1.155C37.454.578 37 0 36.317 0H1.292C.61 0 .155.462.155 1.155v35.69C.155 37.423.61 38 1.292 38h35.025c.682 0 1.137-.578 1.137-1.155zm-1.478-.346H1.634V1.502h34.342z" />
											<path d="M14.37 30.84c5.117 0 8.415-2.889 8.415-10.396V7.739h-3.753V20.79c0 4.967-1.933 6.584-4.662 6.584s-4.435-1.617-4.435-6.584V7.854h-3.98V20.56c0 7.392 3.298 10.28 8.415 10.28zM29.835 10.857c1.365 0 2.388-.924 2.388-2.194 0-1.386-1.023-2.31-2.388-2.31s-2.388.924-2.388 2.31c0 1.27 1.024 2.194 2.388 2.194zM31.768 13.86h-3.866v16.98h3.866z" />
										</g>
									</svg>UiPath</p>
							</td>
							<td>2年</td>
							<td><span class="stars">★★★★</span><span class="stars_residue">★</span></td>
						</tr>
					</tbody>
				</table>
				<div class="skill_type fade-in">
					<h3>データベース</h3>
					<p>MySQL：実務ではDMLが主。今後、データベースをより幅広く扱うことができるよう勉強中</p>
				</div>
				<table class="fade-in">
					<thead>
						<tr>
							<th>技術名</th>
							<th>経験年数</th>
							<th>スキルレベル</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<p class="skill_name"><svg viewBox="0 0 128 128" width="30px" height="30px">
										<path fill="#00618A" d="M116.948 97.807c-6.863-.187-12.104.452-16.585 2.341-1.273.537-3.305.552-3.513 2.147.7.733.809 1.829 1.365 2.731 1.07 1.73 2.876 4.052 4.488 5.268 1.762 1.33 3.577 2.751 5.465 3.902 3.358 2.047 7.107 3.217 10.34 5.268 1.906 1.21 3.799 2.733 5.658 4.097.92.675 1.537 1.724 2.732 2.147v-.194c-.628-.8-.79-1.898-1.366-2.733l-2.537-2.537c-2.48-3.292-5.629-6.184-8.976-8.585-2.669-1.916-8.642-4.504-9.755-7.609l-.195-.195c1.892-.214 4.107-.898 5.854-1.367 2.934-.786 5.556-.583 8.585-1.365l4.097-1.171v-.78c-1.531-1.571-2.623-3.651-4.292-5.073-4.37-3.72-9.138-7.437-14.048-10.537-2.724-1.718-6.089-2.835-8.976-4.292-.971-.491-2.677-.746-3.318-1.562-1.517-1.932-2.342-4.382-3.511-6.633-2.449-4.717-4.854-9.868-7.024-14.831-1.48-3.384-2.447-6.72-4.293-9.756-8.86-14.567-18.396-23.358-33.169-32-3.144-1.838-6.929-2.563-10.929-3.513-2.145-.129-4.292-.26-6.438-.391-1.311-.546-2.673-2.149-3.902-2.927C17.811 4.565 5.257-2.16 1.633 6.682c-2.289 5.581 3.421 11.025 5.462 13.854 1.434 1.982 3.269 4.207 4.293 6.438.674 1.467.79 2.938 1.367 4.489 1.417 3.822 2.652 7.98 4.487 11.511.927 1.788 1.949 3.67 3.122 5.268.718.981 1.951 1.413 2.145 2.927-1.204 1.686-1.273 4.304-1.95 6.44-3.05 9.615-1.899 21.567 2.537 28.683 1.36 2.186 4.567 6.871 8.975 5.073 3.856-1.57 2.995-6.438 4.098-10.732.249-.973.096-1.689.585-2.341v.195l3.513 7.024c2.6 4.187 7.212 8.562 11.122 11.514 2.027 1.531 3.623 4.177 6.244 5.073v-.196h-.195c-.508-.791-1.303-1.119-1.951-1.755-1.527-1.497-3.225-3.358-4.487-5.073-3.556-4.827-6.698-10.11-9.561-15.609-1.368-2.627-2.557-5.523-3.709-8.196-.444-1.03-.438-2.589-1.364-3.122-1.263 1.958-3.122 3.542-4.098 5.854-1.561 3.696-1.762 8.204-2.341 12.878-.342.122-.19.038-.391.194-2.718-.655-3.672-3.452-4.683-5.853-2.554-6.07-3.029-15.842-.781-22.829.582-1.809 3.21-7.501 2.146-9.172-.508-1.666-2.184-2.63-3.121-3.903-1.161-1.574-2.319-3.646-3.124-5.464-2.09-4.731-3.066-10.044-5.267-14.828-1.053-2.287-2.832-4.602-4.293-6.634-1.617-2.253-3.429-3.912-4.683-6.635-.446-.968-1.051-2.518-.391-3.513.21-.671.508-.951 1.171-1.17 1.132-.873 4.284.29 5.462.779 3.129 1.3 5.741 2.538 8.392 4.294 1.271.844 2.559 2.475 4.097 2.927h1.756c2.747.631 5.824.195 8.391.975 4.536 1.378 8.601 3.523 12.292 5.854 11.246 7.102 20.442 17.21 26.732 29.269 1.012 1.942 1.45 3.794 2.341 5.854 1.798 4.153 4.063 8.426 5.852 12.488 1.786 4.052 3.526 8.141 6.05 11.513 1.327 1.772 6.451 2.723 8.781 3.708 1.632.689 4.307 1.409 5.854 2.34 2.953 1.782 5.815 3.903 8.586 5.855 1.383.975 5.64 3.116 5.852 4.879zM29.729 23.466c-1.431-.027-2.443.156-3.513.389v.195h.195c.683 1.402 1.888 2.306 2.731 3.513.65 1.367 1.301 2.732 1.952 4.097l.194-.193c1.209-.853 1.762-2.214 1.755-4.294-.484-.509-.555-1.147-.975-1.755-.556-.811-1.635-1.272-2.339-1.952z"></path>
									</svg>MySQL</p>
							</td>
							<td>1年</td>
							<td><span class="stars">★★</span><span class="stars_residue">★★★</span></td>
						</tr>
					</tbody>
				</table>
				<div class="skill_type fade-in">
					<h3>ツール</h3>
					<p>Git：実務ではソースをGitで管理。ブランチの切り替えやコミット、プッシュ、プル等の基本的な操作は習得済み</p>
					<p>microCMS：自作ブログの記事やタグを管理するのに使用</p>
					<p>Docker：最近になってEC-CUBE開発での環境構築で使用（今まではXAMPP）</p>
				</div>
				<table class="fade-in">
					<thead>
						<tr>
							<th>技術名</th>
							<th>経験年数</th>
							<th>スキルレベル</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<p class="skill_name"><svg viewBox="0 0 128 128" width="30px" height="30px">
										<path fill="#F34F29" d="M124.737 58.378L69.621 3.264c-3.172-3.174-8.32-3.174-11.497 0L46.68 14.71l14.518 14.518c3.375-1.139 7.243-.375 9.932 2.314 2.703 2.706 3.461 6.607 2.294 9.993l13.992 13.993c3.385-1.167 7.292-.413 9.994 2.295 3.78 3.777 3.78 9.9 0 13.679a9.673 9.673 0 01-13.683 0 9.677 9.677 0 01-2.105-10.521L68.574 47.933l-.002 34.341a9.708 9.708 0 012.559 1.828c3.778 3.777 3.778 9.898 0 13.683-3.779 3.777-9.904 3.777-13.679 0-3.778-3.784-3.778-9.905 0-13.683a9.65 9.65 0 013.167-2.11V47.333a9.581 9.581 0 01-3.167-2.111c-2.862-2.86-3.551-7.06-2.083-10.576L41.056 20.333 3.264 58.123a8.133 8.133 0 000 11.5l55.117 55.114c3.174 3.174 8.32 3.174 11.499 0l54.858-54.858a8.135 8.135 0 00-.001-11.501z"></path>
									</svg>Git</p>
							</td>
							<td>1年</td>
							<td><span class="stars">★★★</span><span class="stars_residue">★★</span></td>
						</tr>
						<tr>
							<td>
								<p class="skill_name"><img src="img/microcms.svg" width="30px" height="30px">microCMS</p>
							</td>
							<td>1年</td>
							<td><span class="stars">★★</span><span class="stars_residue">★★★</span></td>
						</tr>
						<tr>
							<td>
								<p class="skill_name"><svg viewBox="0 0 128 128" width="30px" height="30px">
										<path d="M124.8 52.1c-4.3-2.5-10-2.8-14.8-1.4-.6-5.2-4-9.7-8-12.9l-1.6-1.3-1.4 1.6c-2.7 3.1-3.5 8.3-3.1 12.3.3 2.9 1.2 5.9 3 8.3-1.4.8-2.9 1.9-4.3 2.4-2.8 1-5.9 2-8.9 2H79V49H66V24H51v12H26v13H13v14H1.8l-.2 1.5c-.5 6.4.3 12.6 3 18.5l1.1 2.2.1.2c7.9 13.4 21.7 19 36.8 19 29.2 0 53.3-13.1 64.3-40.6 7.4.4 15-1.8 18.6-8.9l.9-1.8-1.6-1zM28 39h10v11H28V39zm13.1 44.2c0 1.7-1.4 3.1-3.1 3.1-1.7 0-3.1-1.4-3.1-3.1 0-1.7 1.4-3.1 3.1-3.1 1.7.1 3.1 1.4 3.1 3.1zM28 52h10v11H28V52zm-13 0h11v11H15V52zm27.7 50.2c-15.8-.1-24.3-5.4-31.3-12.4 2.1.1 4.1.2 5.9.2 1.6 0 3.2 0 4.7-.1 3.9-.2 7.3-.7 10.1-1.5 2.3 5.3 6.5 10.2 14 13.8h-3.4zM51 63H40V52h11v11zm0-13H40V39h11v11zm13 13H53V52h11v11zm0-13H53V39h11v11zm0-13H53V26h11v11zm13 26H66V52h11v11zM38.8 81.2c-.2-.1-.5-.2-.8-.2-1.2 0-2.2 1-2.2 2.2 0 1.2 1 2.2 2.2 2.2s2.2-1 2.2-2.2c0-.3-.1-.6-.2-.8-.2.3-.4.5-.8.5-.5 0-.9-.4-.9-.9.1-.4.3-.7.5-.8z" fill="#019BC6"></path>
									</svg>Docker</p>
							</td>
							<td>1年</td>
							<td><span class="stars">★</span><span class="stars_residue">★★★★</span></td>
						</tr>
					</tbody>
				</table>
				<div class="skill_type fade-in">
					<h3>注目している技術 / 今後やりたいこと</h3>
					<p>・ECサイトのSPA化</p>
					<p>・3D技術を用いたECの商品販売</p>
					<p>・AR / VR端末におけるWebサイトのUI</p>
					<p>・AI、機械学習を活用した推奨商品表示やプロモーション</p>
				</div>
			</div>
		</section>
		<section id="contact">
			<div class="container">
				<div class="title fade-in">
					<div class="txt contact">
						<h2>Contact</h2>
					</div>
					<div class="line"></div>
				</div>
				<p class="description fade-in">お問い合わせは下記からお願い致します。全て入力必須となります。</p>
				<p class="note fade-in">※回答まで数日掛かる場合がございます。予めご了承下さい。</p>
				<form action="#contact" method="POST" class="fade-in">
					<dl class="contactForm">
						<dt>
							<p>お名前</p>
							<?php if (isset($error['name'])) : ?>
								<p class="error"><?php echo $error['name']; ?></p>
							<?php endif; ?>
						</dt>
						<dd>
							<input type="text" name="name" maxlength="40" value="<?php if (isset($_POST['name'])) {
																						echo h($_POST['name']);
																					} ?>">
						</dd>
						<dt>
							<p>メールアドレス</p>
							<?php if (isset($error['email']) && $error['email']) : ?>
								<p class="error"><?php echo $error['email']; ?></p>
							<?php endif; ?>
						</dt>
						<dd>
							<input type="text" name="email" maxlength="40" value="<?php if (isset($_POST['email'])) {
																						echo h($_POST['email']);
																					} ?>">
						</dd>
						<dt>
							<p>お問い合わせ内容</p>
							<?php if (isset($error['message']) && $error['message']) : ?>
								<p class="error"><?php echo $error['message']; ?></p>
							<?php endif; ?>
						</dt>
						<dd>
							<textarea rows="6" cols="60" name="message" maxlength="500"><?php if (isset($_POST['message'])) {
																							echo h($_POST['message']);
																						} ?></textarea>
						</dd>
					</dl>
					<input type="submit" name="check" id="button" value="送信">
				</form>
			</div>
		</section>
	</main>
	<div class="footer_line"></div>
	<footer>
		<div class="left-box">
			<nav>
				<ul class="nav_menu">
					<li><a href="#top">TOP</a></li>
					<li><a href="#profile">Profile</a></li>
					<li><a href="#works">Works</a></li>
					<li><a href="#skills">Skills</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
			</nav>
		</div>
		<div class="right-box">
			<div class="sns">
				<a href="https://github.com/okuda1506" target="_blank" rel="noopener noreferrer"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"  alt="GitHubアイコン"></a>
				<a href="https://www.instagram.com/nnnt0k/" target="_blank" rel="noopener noreferrer"><img src="img/Instagram.svg" alt="Instagramアイコン"></a>
				<a href="https://www.facebook.com/profile.php?id=100014434240702" target="_blank" rel="noopener noreferrer"><img src="img/facebook.png" alt="facebookアイコン"></a>
			</div>
			<p class="copyright">&copy; takuyaokuda, 2023 All Rights Reserved.</p>
		</div>
	</footer>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="js/slick.js"></script>
	<script src="js/script.js"></script>
</body>

</html>