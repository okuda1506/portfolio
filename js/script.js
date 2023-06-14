$(function() {
    // アニメーション
    $('header').css("opacity", "0").animate({opacity: 1}, 1000);
    $('.title').css("opacity", "0").animate({opacity: 1}, 1000);
    $('.title').css('transform', 'scaleX(1)').css('transform-origin', 'left center').css('transition', 'transform 700ms');
    $('.header_line').css('transform', 'scaleX(1)').css('transform-origin', 'right center').css('transition', 'transform 700ms');
    $("#myPic .main_visual").css("opacity", "0").animate({opacity: 1}, 1000);
    $('#myPic .main_visual img').css('transform', 'scaleX(1)').css('transform-origin', 'left center').css('transition', 'transform 700ms');
    $("#myPic .nav_menu").css("opacity", "0").animate({opacity: 1}, 1000);
    $('#myPic nav').css('transform', 'scaleX(1)').css('transform-origin', 'right center').css('transition', 'transform 700ms');
    $('.check_contact').addClass('scroll-in');
    // 問い合わせ確認・完了画面におけるContact表示のアニメーション
    if ($('.title').find('#contact_animation').length) {
        $('section .title .txt').css('transform', 'scaleX(1)').css('transform-origin', 'left center').css('transition', 'transform 700ms');
        $('section .title .line').css('transform', 'scaleX(1)').css('transform-origin', 'right center').css('transition', 'transform 700ms');
    }
    // アニメーション（SP）
    $('#top #sp .nav_menu').css("opacity", "0").animate({opacity: 1}, 1000);
    $('#top #sp .nav_menu').css('transform', 'scaleX(1)').css('transform-origin', 'right center').css('transition', 'transform 700ms');
    // クリックイベント
    $('.hamburger_btn, .slide-in a').on('click', function() {
        $('.slide-in').toggleClass('active');
        $('.hamburger_btn').toggleClass('active');
    });
    $('a[href^="#"]').click(function() {
        var target = $($(this).attr('href'));
        if (target.length) {
            var offsetTop = target.offset().top;
            $('html,body').animate({ scrollTop: offsetTop }, 800);
            return false;
        }
    });
    // スクロールイベント
    $(window).scroll(function (){
		$('.fade-in').each(function(){
			var elemPos = $(this).offset().top;
			var scroll = $(window).scrollTop();
			var windowHeight = $(window).height();
			if (scroll > elemPos - windowHeight + 200) {
				$(this).addClass('scroll-in');
                $(this).find('.txt').css('transform', 'scaleX(1)').css('transform-origin', 'left center').css('transition', 'transform 700ms');
                $(this).find('.line').css('transform', 'scaleX(1)').css('transform-origin', 'right center').css('transition', 'transform 700ms');
			}
		});
        // SP
        if ($(window).width() <= 767) {
            if ($('#top').height() < $(this).scrollTop() + $('#top').height()) {
                $('.hamburger_btn span').addClass('change-color');
            } else {
                $('.hamburger_btn span').removeClass('change-color');
            }
        }
	});
});