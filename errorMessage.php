<?php
session_start();

// クリックジャッキング対策
header('X-FRAME-OPTIONS: DENY');

if (!isset($_SESSION['send'])) {
	header('Location: index.php');
	exit();
}

$error = $_SESSION['error'];

// セッション破棄
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TAKUYA OKUDA PORTFOLIO</title>
	<meta name="description" content="TAKUYA OKUDA PORTFOLIO">
	<!-- CSS -->
	<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&family=Noto+Serif+JP:wght@600&display=swap" rel="stylesheet">
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
		<section id="contact">
			<div class="container">
				<div class="title">
					<div class="txt contact">
						<h2>Contact</h2>
					</div>
					<div class="line"></div>
				</div>
				<p class="description check_contact"><?php echo $error; ?></p>
				<form action="" method="GET" class="check_contact">
					<input type="button" class="back" name="back" value="戻る" onClick="location.href='index.php'">
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
				<a href="https://github.com/okuda1506" target="_blank" rel="noopener noreferrer"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg" alt="GitHubアイコン"></a>
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