document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('header');
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    let lastScrollTop = 0;

    // ハンバーガーメニューの開閉
    menuToggle.addEventListener('click', function() {
        mainNav.classList.toggle('active');
        this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');
    });

    // スクロール時のヘッダー表示/非表示
    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (window.innerWidth <= 768) {
            // モバイル版では常に表示
            header.classList.remove('hidden');
        } else {
            if (scrollTop > lastScrollTop) {
                header.classList.add('hidden');
            } else {
                header.classList.remove('hidden');
            }
        }
    }, false);

    // ウィンドウサイズ変更時の処理
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 769) {
            mainNav.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
            mainNav.style.display = 'flex'; // PC版でナビゲーションを表示
        } else {
                   mainNav.style.display = 'none'; // モバイル版でナビゲーションを非表示
        }
    });

    // スライドショーの機能
    let slideIndex = 1;
    showSlides(slideIndex);

    // 次/前のコントロール
    window.plusSlides = function(n) {
        showSlides(slideIndex += n);
    }

    // サムネイルイメージコントロール
    window.currentSlide = function(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("slide");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.opacity = "0";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.opacity = "1";
        dots[slideIndex-1].className += " active";
    }

    // 自動スライドショー
    setInterval(function() {
        plusSlides(1);
    }, 5000);
});
// ハンバーガーメニューのスタイル
const style = document.createElement('style');
style.textContent = `
    .menu-toggle {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
    }

    .menu-toggle span {
        display: block;
        width: 100%;
        height: 3px;
        background-color: #333;
        transition: all 0.3s ease;
    }

    .menu-toggle.active span:nth-child(1) {
        transform: translateY(8px) rotate(45deg);
    }

    .menu-toggle.active span:nth-child(2) {
        opacity: 0;
    }

    .menu-toggle.active span:nth-child(3) {
        transform: translateY(-8px) rotate(-45deg);
    }
`;
document.head.appendChild(style);