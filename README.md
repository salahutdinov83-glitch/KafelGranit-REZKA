<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#0a0a0a">
    <title>Bellezza Tech × КафельГранит — Партнёрское предложение</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        :root {
            --gold: #D4AF37;
            --gold-light: #F4E8C1;
            --black: #0a0a0a;
            --dark-gray: #1a1a1a;
            --white: #ffffff;
            --bronze: #8B7355;
            --gray-text: #888888;
            --green: #00c853;
            --blue: #0080ff;
        }

        html, body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: var(--black);
            color: var(--white);
            height: 100%;
            overflow: hidden;
            line-height: 1.6;
        }

        .presentation {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease;
            padding: 20px 20px 100px 20px;
            background: linear-gradient(135deg, var(--black) 0%, var(--dark-gray) 100%);
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .slide.active {
            display: flex;
            opacity: 1;
        }

        /* Навигация */
        .nav {
            position: fixed;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 6px;
            z-index: 1000;
            background: rgba(0,0,0,0.9);
            padding: 8px 12px;
            border-radius: 30px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212,175,55,0.3);
            flex-wrap: wrap;
            justify-content: center;
            max-width: 95vw;
        }

        @media (min-width: 768px) {
            .nav {
                bottom: 20px;
                gap: 8px;
                padding: 10px 16px;
            }
        }

        .nav-btn {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            padding: 0;
        }

        .nav-btn:hover, .nav-btn.active {
            background: var(--gold);
            transform: scale(1.4);
        }

        .nav-arrows {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            gap: 8px;
            z-index: 1000;
        }

        .arrow-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(212,175,55,0.2);
            border: 1px solid var(--gold);
            color: var(--gold);
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            touch-action: manipulation;
        }

        .arrow-btn:hover, .arrow-btn:active {
            background: var(--gold);
            color: var(--black);
        }

        /* Прогресс и номер слайда */
        .progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--gold), var(--bronze));
            transition: width 0.3s;
            z-index: 1001;
        }

        .slide-number {
            position: fixed;
            top: 15px;
            right: 15px;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.5);
            z-index: 1000;
            background: rgba(0,0,0,0.5);
            padding: 5px 10px;
            border-radius: 15px;
        }

        .slide-number span {
            color: var(--gold);
            font-weight: 600;
        }

        /* Типографика */
        h1, h2, h3 {
            font-weight: 700;
            line-height: 1.2;
        }

        h1 { font-size: clamp(1.5rem, 5vw, 2.5rem); }
        h2 { font-size: clamp(1.3rem, 4vw, 2rem); color: var(--gold); margin-bottom: 20px; }
        h3 { font-size: clamp(1rem, 3vw, 1.3rem); }

        /* Слайд 1: Интро */
        .slide-1 {
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: 
                radial-gradient(circle at 30% 50%, rgba(212,175,55,0.1) 0%, transparent 50%),
                linear-gradient(135deg, var(--black) 0%, var(--dark-gray) 100%);
        }

        .logo-container {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .logo-img {
            max-width: 200px;
            max-height: 80px;
            object-fit: contain;
        }

        .logo-main {
            font-size: clamp(2rem, 8vw, 4rem);
            font-weight: 900;
            color: var(--gold);
            margin-bottom: 10px;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .logo-sub {
            font-size: clamp(0.9rem, 3vw, 1.2rem);
            color: var(--gold-light);
            margin-bottom: 30px;
            letter-spacing: 5px;
        }

        .hook-text {
            font-size: clamp(1.1rem, 4vw, 1.8rem);
            max-width: 800px;
            line-height: 1.4;
            margin-bottom: 25px;
            font-weight: 300;
            padding: 0 20px;
        }

        .hook-text span {
            color: var(--gold);
            font-weight: 600;
        }

        .patent-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(212,175,55,0.1);
            border: 1px solid var(--gold);
            padding: 12px 24px;
            border-radius: 30px;
            font-size: 0.85rem;
            color: var(--gold);
        }

        /* Слайд 2: О компании */
        .slide-2 {
            flex-direction: column;
            justify-content: center;
        }

        .company-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .company-logo-img {
            max-width: 150px;
            max-height: 150px;
            object-fit: contain;
            margin-bottom: 20px;
            border-radius: 15px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            max-width: 600px;
            margin: 0 auto;
            width: 100%;
        }

        .stat-item {
            background: rgba(255,255,255,0.05);
            padding: 20px;
            border-radius: 12px;
            border-left: 3px solid var(--gold);
            text-align: center;
        }

        .stat-number {
            font-size: clamp(1.5rem, 5vw, 2rem);
            font-weight: 700;
            color: var(--gold);
            display: block;
        }

        .stat-label {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.7);
            margin-top: 5px;
            line-height: 1.3;
        }

        /* Слайд 3: Проблема */
        .slide-3 {
            flex-direction: column;
            justify-content: center;
        }

        .problem-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .problem-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 25px 15px;
            border-radius: 15px;
            text-align: center;
        }

        .problem-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .problem-card h3 {
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
            font-weight: 400;
        }

        .vs-divider {
            text-align: center;
            margin: 25px 0;
            font-size: 1.2rem;
            color: var(--gold);
            font-weight: 600;
        }

        /* Технологические слайды */
        .tech-slide {
            flex-direction: column;
            justify-content: center;
        }

        .tech-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .tech-badge {
            display: inline-block;
            background: var(--gold);
            color: var(--black);
            padding: 8px 18px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .tech-title {
            font-size: clamp(2rem, 6vw, 3rem);
            margin-bottom: 15px;
        }

        .tech-desc {
            font-size: 1rem;
            line-height: 1.5;
            color: rgba(255,255,255,0.8);
            margin-bottom: 20px;
        }

        .tech-features {
            list-style: none;
        }

        .tech-feature {
            padding: 10px 0;
            padding-left: 25px;
            position: relative;
            font-size: 0.95rem;
        }

        .tech-feature::before {
            content: "→";
            color: var(--gold);
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        .tech-visual {
            background: rgba(255,255,255,0.03);
            border-radius: 20px;
            overflow: hidden;
            margin-top: 20px;
            border: 1px solid rgba(212,175,55,0.2);
            position: relative;
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tech-visual img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .tech-visual-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.9));
            padding: 20px;
            text-align: center;
            color: var(--gold);
            font-weight: 600;
        }

        /* Слайд 7: CER-SINK */
        .slide-7 {
            flex-direction: column;
            justify-content: center;
        }

        .sink-showcase {
            background: linear-gradient(135deg, #2a2a2a, #1a1a1a);
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 25px;
            border: 2px solid rgba(212,175,55,0.3);
            position: relative;
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sink-showcase img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .sink-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.9));
            padding: 25px;
        }

        .sink-label {
            color: var(--gold);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .sink-name {
            font-size: 1.5rem;
            color: var(--white);
            font-weight: 600;
        }

        .sink-content h2 {
            margin-bottom: 15px;
        }

        .sink-benefits {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .sink-benefit {
            background: rgba(255,255,255,0.05);
            padding: 15px;
            border-radius: 10px;
            border-left: 3px solid var(--gold);
        }

        .sink-benefit h4 {
            color: var(--gold);
            margin-bottom: 5px;
            font-size: 0.95rem;
        }

        .sink-benefit p {
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
        }

        /* Слайд 8: Тесты */
        .slide-8 {
            flex-direction: column;
            justify-content: center;
        }

        .test-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .test-card {
            background: rgba(255,255,255,0.05);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .test-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            display: block;
        }

        .test-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--gold);
            margin-bottom: 5px;
        }

        .test-result {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.7);
        }

        /* Слайд 9: Продукты */
        .slide-9 {
            flex-direction: column;
            justify-content: center;
        }

        .products-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            margin-top: 20px;
        }

        .product-card {
            background: rgba(255,255,255,0.03);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .product-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .product-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--gold-light);
        }

        .product-list {
            list-style: none;
            font-size: 0.9rem;
            color: rgba(255,255,255,0.7);
        }

        .product-list li {
            margin: 5px 0;
            padding-left: 15px;
            position: relative;
        }

        .product-list li::before {
            content: "•";
            color: var(--gold);
            position: absolute;
            left: 0;
        }

        .product-highlight {
            background: rgba(212,175,55,0.1);
            border: 1px solid var(--gold);
            border-radius: 8px;
            padding: 10px;
            margin-top: 15px;
            font-size: 0.85rem;
            color: var(--gold);
        }

        /* Слайд 10: Кейсы */
        .slide-10 {
            flex-direction: column;
        }

        .cases-header {
            text-align: center;
            margin-bottom: 20px;
            margin-top: 10px;
        }

        .cases-subtitle {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.7);
            margin-top: 5px;
        }

        .cases-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            overflow-y: auto;
            padding-bottom: 80px;
        }

        .case-card {
            background: rgba(255,255,255,0.03);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid rgba(255,255,255,0.1);
            position: relative;
        }

        .case-number {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 2rem;
            font-weight: 900;
            color: rgba(212,175,55,0.15);
        }

        .case-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--gold);
            margin-bottom: 15px;
            padding-right: 50px;
        }

        .case-spec {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            font-size: 0.85rem;
        }

        .case-spec:last-child {
            border-bottom: none;
        }

        .case-spec-label {
            color: rgba(255,255,255,0.6);
        }

        .case-spec-value {
            color: var(--white);
            font-weight: 500;
            text-align: right;
            max-width: 60%;
        }

        .case-profit {
            background: rgba(0,200,83,0.1);
            border: 1px solid var(--green);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            margin-top: 15px;
        }

        .case-profit-label {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.7);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .case-profit-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--green);
        }

        .case-margin {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.8);
            margin-top: 5px;
        }

        /* Слайд 11: Партнёрство */
        .slide-11 {
            flex-direction: column;
            justify-content: center;
        }

        .benefits-list {
            margin-top: 20px;
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin: 15px 0;
            padding: 18px;
            background: rgba(255,255,255,0.03);
            border-radius: 12px;
            border-left: 3px solid var(--gold);
        }

        .benefit-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gold);
            line-height: 1;
            min-width: 30px;
        }

        .benefit-text h4 {
            font-size: 1rem;
            margin-bottom: 3px;
            color: var(--white);
        }

        .benefit-text p {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.7);
            line-height: 1.4;
        }

        .margin-highlight {
            background: rgba(212,175,55,0.1);
            border: 2px solid var(--gold);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            margin-top: 25px;
        }

        .margin-value {
            font-size: 2.5rem;
            color: var(--gold);
            font-weight: 700;
        }

        /* Слайд 12: Контакты */
        .slide-12 {
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: 
                radial-gradient(circle at 70% 50%, rgba(212,175,55,0.15) 0%, transparent 50%),
                linear-gradient(135deg, var(--black) 0%, var(--dark-gray) 100%);
        }

        .final-title {
            font-size: clamp(1.5rem, 5vw, 2.2rem);
            color: var(--gold);
            margin-bottom: 15px;
        }

        .final-subtitle {
            font-size: 1rem;
            color: rgba(255,255,255,0.8);
            margin-bottom: 30px;
            max-width: 500px;
        }

        .contacts-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
            width: 100%;
            max-width: 400px;
            margin-bottom: 25px;
        }

        .contact-item {
            background: rgba(255,255,255,0.05);
            padding: 18px;
            border-radius: 12px;
            border: 1px solid rgba(212,175,55,0.3);
            text-decoration: none;
            color: inherit;
            display: block;
            transition: all 0.3s;
        }

        .contact-item:hover, .contact-item:active {
            background: rgba(212,175,55,0.1);
            transform: scale(1.02);
        }

        .contact-label {
            font-size: 0.75rem;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .contact-value {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--white);
        }

        .messengers {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .messenger-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .messenger-btn:hover, .messenger-btn:active {
            transform: translateY(-2px);
        }

        .btn-whatsapp {
            background: #25D366;
            color: white;
        }

        .btn-telegram {
            background: #0088cc;
            color: white;
        }

        .btn-phone {
            background: var(--gold);
            color: var(--black);
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, var(--gold), var(--bronze));
            color: var(--black);
            padding: 16px 40px;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 700;
            text-decoration: none;
            margin-top: 10px;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(212,175,55,0.3);
        }

        .cta-button:hover, .cta-button:active {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(212,175,55,0.4);
        }

        .logos-footer {
            display: flex;
            gap: 20px;
            margin-top: 30px;
            align-items: center;
            font-size: 1rem;
            color: rgba(255,255,255,0.5);
        }

        .footer-logo.gold {
            color: var(--gold);
            font-weight: 700;
        }

        /* Адаптивность для планшетов и ПК */
        @media (min-width: 768px) {
            .slide {
                padding: 40px 60px;
            }

            .problem-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .tech-slide {
                flex-direction: row;
                align-items: center;
                gap: 40px;
            }

            .tech-slide.reverse {
                flex-direction: row-reverse;
            }

            .tech-content, .tech-visual {
                flex: 1;
            }

            .tech-visual {
                margin-top: 0;
                min-height: 350px;
            }

            .slide-7 {
                flex-direction: row;
                gap: 40px;
            }

            .sink-showcase, .sink-content {
                flex: 1;
            }

            .sink-showcase {
                min-height: 350px;
            }

            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .cases-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .contacts-grid {
                grid-template-columns: repeat(3, 1fr);
                max-width: 800px;
            }

            .test-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .sink-benefits {
                grid-template-columns: repeat(2, 1fr);
            }

            .logo-container {
                flex-direction: row;
                gap: 30px;
            }
        }

        /* Анимации */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide.active > * {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Скрытие скроллбара но сохранение функциональности */
        .slide::-webkit-scrollbar {
            width: 0;
            background: transparent;
        }

        .img-fallback {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            min-height: 200px;
        }
    
        /* Кнопка управления звуком */
        .mute-btn {
            position: fixed;
            bottom: 20px;
            right: 110px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(212,175,55,0.2);
            border: 1px solid var(--gold);
            color: var(--gold);
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            touch-action: manipulation;
        }

        .mute-btn:hover, .mute-btn:active {
            background: var(--gold);
            color: var(--black);
        }

        .mute-btn.muted {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.3);
            color: rgba(255,255,255,0.5);
        }

    </style>
<base target="_blank">
</head>
<body>
    <div class="progress-bar" id="progressBar"></div>
    <div class="slide-number"><span id="currentSlideNum">1</span> / 12</div>

    <div class="presentation">
        <!-- Слайд 1: Интро -->
        <div class="slide slide-1 active" data-slide="1">
            <div class="logo-container">
                <img src="https://i.ibb.co/tpWDXKvX/image.png" alt="Bellezza Tech" class="logo-img" onerror="this.style.display='none'">
                <img src="https://i.ibb.co/SwN70KNS/111.png" alt="КафельГранит" class="logo-img" onerror="this.style.display='none'">
            </div>
            <div class="logo-main">Bellezza Tech</div>
            <div class="logo-sub">КАФЕЛЬГРАНИТ</div>
            <h1 class="hook-text">
                Что, если столешница может <span>готовить еду сама</span>?<br>
                Без плиты. Без комфорок. Без чёрных квадратов.
            </h1>
            <div class="patent-badge">★ Международный патент</div>
        </div>

        <!-- Слайд 2: О компании -->
        <div class="slide slide-2" data-slide="2">
            <div class="company-header">
                <img src="https://i.ibb.co/SwN70KNS/111.png" alt="КафельГранит" class="company-logo-img" onerror="this.style.display='none'">
                <h2>КафельГранит</h2>
                <p style="color: rgba(255,255,255,0.8); font-size: 1rem; max-width: 600px; margin: 0 auto;">
                    Пять лет создаём мебель из керамики и спеченного камня. 
                    Каждый третий пост в Pinterest — о камне в интерьере.
                </p>
            </div>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">600 м²</span>
                    <span class="stat-label">Собственное производство<br>г. Красноярск</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">5+ лет</span>
                    <span class="stat-label">Опыт работы<br>с инновационными материалами</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">12</span>
                    <span class="stat-label">Реализованных проектов<br>с индукцией (3 в Москву)</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">2-3 недели</span>
                    <span class="stat-label">Срок изготовления<br>от замеров до монтажа</span>
                </div>
            </div>
        </div>

        <!-- Слайд 3: Проблема -->
        <div class="slide slide-3" data-slide="3">
            <h2 style="text-align: center;">Проблема традиционных решений</h2>
            <div class="problem-grid">
                <div class="problem-card">
                    <div class="problem-icon">🔪</div>
                    <h3>Царапаются от ножа</h3>
                </div>
                <div class="problem-card">
                    <div class="problem-icon">🔥</div>
                    <h3>Боятся высоких температур</h3>
                </div>
                <div class="problem-card">
                    <div class="problem-icon">🍷</div>
                    <h3>Впитывают пятна</h3>
                </div>
                <div class="problem-card">
                    <div class="problem-icon">⬛</div>
                    <h3>Варочные панели портят интерьер</h3>
                </div>
            </div>
            <div class="vs-divider">НОВЫЙ СТАНДАРТ</div>
            <p style="text-align: center; font-size: 1.2rem; color: var(--gold); font-weight: 600;">
                Технологии, которые меняют правила игры
            </p>
        </div>

        <!-- Слайд 4: Invisible -->
        <div class="slide tech-slide slide-4" data-slide="4">
            <div class="tech-content">
                <div class="tech-header">
                    <div class="tech-badge">Bellezza Tech</div>
                    <h2 class="tech-title" style="color: var(--gold);">INVISIBLE</h2>
                </div>
                <p class="tech-desc">
                    Скрытая индукция под столешницей. Нет видимых комфорок — 
                    только чистый мрамор. Готовьте прямо на камне.
                </p>
                <ul class="tech-features">
                    <li class="tech-feature">Индукционные элементы под поверхностью</li>
                    <li class="tech-feature">Абсолютно ровная текстура камня</li>
                    <li class="tech-feature">Международный патент на технологию</li>
                </ul>
            </div>
            <div class="tech-visual">
                <img src="https://i.ibb.co/LhJWvXCP/photo-5274125982027682674-y.jpg" alt="Скрытая индукция" onerror="this.parentElement.innerHTML='<div class=img-fallback><div style=font-size:4rem;>🔥</div><div style=color:var(--gold)>Индукция под камнем</div></div>'">
                <div class="tech-visual-caption">Индукция под камнем</div>
            </div>
        </div>

        <!-- Слайд 5: Energy -->
        <div class="slide tech-slide reverse slide-5" data-slide="5">
            <div class="tech-visual" style="border-color: rgba(0,255,100,0.3);">
                <img src="https://i.ibb.co/HTdqkDF1/photo-5274125982027682673-y.jpg" alt="Беспроводная зарядка" onerror="this.parentElement.innerHTML='<div class=img-fallback><div style=font-size:4rem;>⚡</div><div style=color:#00ff64>Беспроводная зарядка</div></div>'">
                <div class="tech-visual-caption" style="color: #00ff64;">Беспроводная зарядка</div>
            </div>
            <div class="tech-content">
                <div class="tech-header">
                    <div class="tech-badge" style="background: #00ff64; color: #000;">Bellezza Tech</div>
                    <h2 class="tech-title" style="color: #00ff64;">ENERGY</h2>
                </div>
                <p class="tech-desc">
                    Беспроводная зарядка встроена в столешницу. 
                    Просто положите телефон — он начнёт заряжаться.
                </p>
                <ul class="tech-features">
                    <li class="tech-feature">Работает на острове и рабочей зоне</li>
                    <li class="tech-feature">Совместимость со всеми Qi-устройствами</li>
                    <li class="tech-feature">Не заметна визуально</li>
                </ul>
            </div>
        </div>

        <!-- Слайд 6: Smart -->
        <div class="slide tech-slide slide-6" data-slide="6">
            <div class="tech-content">
                <div class="tech-header">
                    <div class="tech-badge" style="background: #0080ff; color: #fff;">Bellezza Tech</div>
                    <h2 class="tech-title" style="color: #0080ff;">SMART</h2>
                </div>
                <p class="tech-desc">
                    Интеграция с системами «Умный дом». 
                    Управление со смартфона. Будущее, доступное сегодня.
                </p>
                <ul class="tech-features">
                    <li class="tech-feature">Управление индукцией через приложение</li>
                    <li class="tech-feature">Интеграция с Alexa, Google Home, Apple HomeKit, Алиса AI</li>
                    <li class="tech-feature">Программирование сценариев работы</li>
                </ul>
            </div>
            <div class="tech-visual" style="border-color: rgba(0,128,255,0.3);">
                <img src="https://i.ibb.co/ZpXTCmWs/photo-5274125982027682672-y.jpg" alt="Умный дом" onerror="this.parentElement.innerHTML='<div class=img-fallback><div style=font-size:4rem;>🏠</div><div style=color:#0080ff>Умный дом в камне</div></div>'">
                <div class="tech-visual-caption" style="color: #0080ff;">Умный дом в камне</div>
            </div>
        </div>

        <!-- Слайд 7: CER-SINK FULL -->
        <div class="slide slide-7" data-slide="7">
            <div class="sink-showcase">
                <img src="https://i.ibb.co/MDS6vq0w/photo-5274125982027682671-y.jpg" alt="Мойка Cer-Sink Full" onerror="this.parentElement.innerHTML='<div style=display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;><div style=font-size:5rem;>🚰</div><div class=sink-label>Интегрированная система</div><div class=sink-name>Cer-Sink Full</div></div>'">
                <div class="sink-overlay">
                    <div class="sink-label">Интегрированная система</div>
                    <div class="sink-name">Cer-Sink Full</div>
                </div>
            </div>
            <div class="sink-content">
                <div style="display: inline-block; background: linear-gradient(135deg, #666, #888); color: var(--white); padding: 6px 14px; border-radius: 15px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Новинка</div>
                <h2 style="margin-bottom: 10px;">Мойка = Столешница</h2>
                <p style="color: rgba(255,255,255,0.8); margin-bottom: 20px; font-size: 0.95rem;">
                    Уникальная система интегрированных кухонных моек. 
                    Никаких швов, никаких герметиков, никакой плесени.
                </p>
                <div class="sink-benefits">
                    <div class="sink-benefit">
                        <h4>Идеальная гигиена</h4>
                        <p>Нет щелей для бактерий и грязи</p>
                    </div>
                    <div class="sink-benefit">
                        <h4>Единый декор</h4>
                        <p>Мойка и столешница в одном цвете</p>
                    </div>
                    <div class="sink-benefit">
                        <h4>Вечный срок службы</h4>
                        <p>Не протекает, не отклеивается</p>
                    </div>
                    <div class="sink-benefit">
                        <h4>Визуальная чистота</h4>
                        <p>Бесшовное решение премиум-класса</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Слайд 8: Тесты -->
        <div class="slide slide-8" data-slide="8">
            <h2 style="text-align: center;">Материал, который неубиваем</h2>
            <p style="text-align: center; color: rgba(255,255,255,0.7); font-size: 0.95rem; margin-bottom: 20px;">
                Режьте, лейте, жарьте, рубите — идеальная поверхность останется идеальной
            </p>
            <div class="test-grid">
                <div class="test-card">
                    <span class="test-icon">🔪</span>
                    <div class="test-name">Режем ножом</div>
                    <div class="test-result">Нет царапин</div>
                </div>
                <div class="test-card">
                    <span class="test-icon">🍷</span>
                    <div class="test-name">Льём вино/сок</div>
                    <div class="test-result">Не впитывается</div>
                </div>
                <div class="test-card">
                    <span class="test-icon">🔥</span>
                    <div class="test-name">Жарим горелкой</div>
                    <div class="test-result">Нет следов ожога</div>
                </div>
                <div class="test-card">
                    <span class="test-icon">🪓</span>
                    <div class="test-name">Рубим топором*</div>
                    <div class="test-result">Поверхность цела</div>
                </div>
            </div>
            <p style="text-align: center; margin-top: 15px; font-size: 0.8rem; color: rgba(255,255,255,0.6);">
                * Рекомендуем использовать разделочную доску Bellezza Tech для сохранения идеальной поверхности
            </p>
        </div>

        <!-- Слайд 9: Продукты -->
        <div class="slide slide-9" data-slide="9">
            <h2 style="text-align: center;">Продуктовая линейка</h2>
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-icon">🍳</div>
                    <div class="product-title">Кухни</div>
                    <ul class="product-list">
                        <li>Столешницы с индукцией</li>
                        <li>Кухонные острова</li>
                        <li>Фартуки</li>
                        <li>Обеденные столы</li>
                    </ul>
                    <div class="product-highlight">
                        ⭐ Cer-Sink Full — интегрированные мойки
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-icon">🛁</div>
                    <div class="product-title">Ванные комнаты</div>
                    <ul class="product-list">
                        <li>Раковины</li>
                        <li>Столешницы</li>
                        <li>Ванны</li>
                        <li>Аксессуары</li>
                    </ul>
                </div>
                <div class="product-card">
                    <div class="product-icon">🚪</div>
                    <div class="product-title">Фасады и элементы</div>
                    <ul class="product-list">
                        <li>Мебельные фасады</li>
                        <li>Лестничные ступени</li>
                        <li>Подоконники</li>
                        <li>Откосы</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Слайд 10: Кейсы -->
        <div class="slide slide-10" data-slide="10">
            <div class="cases-header">
                <h2>Сколько зарабатывает партнёр</h2>
                <p class="cases-subtitle">Расчёт для спечённого камня толщиной 12 мм</p>
                <p class="cases-subtitle" style="color: var(--gold); font-weight: 600; margin-top: 8px;">
                    ⚠️ Стоимость указана за изготовление и материал.<br>
                    Замеры, доставка, монтаж — оплачиваются отдельно.
                </p>
            </div>
            <div class="cases-grid">
                <div class="case-card">
                    <div class="case-number">01</div>
                    <div class="case-title">Кухня 3 м с индукцией INVISIBLE</div>
                    <div class="case-spec">
                        <span class="case-spec-label">Состав</span>
                        <span class="case-spec-value">Столешница 3 м, 2 комфорки</span>
                    </div>
                    <div class="case-spec">
                        <span class="case-spec-label">Ваша цена</span>
                        <span class="case-spec-value">145 000 ₽</span>
                    </div>
                    <div class="case-spec">
                        <span class="case-spec-label">Рекомендуемая цена</span>
                        <span class="case-spec-value">280 000–320 000 ₽</span>
                    </div>
                    <div class="case-profit">
                        <div class="case-profit-label">Прибыль партнёра</div>
                        <div class="case-profit-value">135 000–175 000 ₽</div>
                        <div class="case-margin">Маржа: 93–121%</div>
                    </div>
                </div>

                <div class="case-card">
                    <div class="case-number">01б</div>
                    <div class="case-title">Кухня 3 м БЕЗ индукции</div>
                    <div class="case-spec">
                        <span class="case-spec-label">Состав</span>
                        <span class="case-spec-value">Столешница 3 м, без комфорок</span>
                    </div>
                    <div class="case-spec">
                        <span class="case-spec-label">Ваша цена</span>
                        <span class="case-spec-value">78 300 ₽</span>
                    </div>
                    <div class="case-spec">
                        <span class="case-spec-label">Рекомендуемая цена</span>
                        <span class="case-spec-value">140 000–180 000 ₽</span>
                    </div>
                    <div class="case-profit">
                        <div class="case-profit-label">Прибыль партнёра</div>
                        <div class="case-profit-value">61 700–101 700 ₽</div>
                        <div class="case-margin">Маржа: 79–130%</div>
                    </div>
                </div>

                <div class="case-card">
                    <div class="case-number">02</div>
                    <div class="case-title">Остров с комплексом технологий</div>
                    <div class="case-spec">
                        <span class="case-spec-label">Состав</span>
                        <span class="case-spec-value">Остров 2000×800 + индукция + зарядка</span>
                    </div>
                    <div class="case-spec">
                        <span class="case-spec-label">Ваша цена</span>
                        <span class="case-spec-value">234 000 ₽</span>
                    </div>
                    <div class="case-spec">
                        <span class="case-spec-label">Рекомендуемая цена</span>
                        <span class="case-spec-value">380 000–450 000 ₽</span>
                    </div>
                    <div class="case-profit">
                        <div class="case-profit-label">Прибыль партнёра</div>
                        <div class="case-profit-value">146 000–216 000 ₽</div>
                        <div class="case-margin">Маржа: 62–92%</div>
                    </div>
                </div>

                <div class="case-card">
                    <div class="case-number">03</div>
                    <div class="case-title">Комплекс «Премиум кухня»</div>
                    <div class="case-spec">
                        <span class="case-spec-label">Состав</span>
                        <span class="case-spec-value">Кухня 4 м + остров + мойка Cer-Sink</span>
                    </div>
                    <div class="case-spec">
                        <span class="case-spec-label">Ваша цена</span>
                        <span class="case-spec-value">363 600 ₽</span>
                    </div>
                    <div class="case-spec">
                        <span class="case-spec-label">Рекомендуемая цена</span>
                        <span class="case-spec-value">700 000–850 000 ₽</span>
                    </div>
                    <div class="case-profit">
                        <div class="case-profit-label">Прибыль партнёра</div>
                        <div class="case-profit-value">336 400–486 400 ₽</div>
                        <div class="case-margin">Маржа: 93–134%</div>
                    </div>
                </div>

                <div class="case-card">
                    <div class="case-number">04</div>
                    <div class="case-title">Мебельные фасады 12 м² (фасады кухни ~12 кв.м)</div>
                    <div class="case-spec">
                        <span class="case-spec-label">Состав</span>
                        <span class="case-spec-value">Фасады кухни из камня</span>
                    </div>
                    <div class="case-spec">
                        <span class="case-spec-label">Ваша цена</span>
                        <span class="case-spec-value">402 000 ₽</span>
                    </div>
                    <div class="case-spec">
                        <span class="case-spec-label">Рекомендуемая цена</span>
                        <span class="case-spec-value">650 000–750 000 ₽</span>
                    </div>
                    <div class="case-profit">
                        <div class="case-profit-label">Прибыль партнёра</div>
                        <div class="case-profit-value">248 000–348 000 ₽</div>
                        <div class="case-margin">Маржа: 62–87%</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Слайд 11: Партнёрство -->
        <div class="slide slide-11" data-slide="11">
            <h2 style="text-align: center;">Партнёрство с Bellezza Tech</h2>
            <p style="text-align: center; color: rgba(255,255,255,0.8); font-size: 0.95rem; margin-bottom: 20px;">
                Премиум-сегмент с маржой в 3–5 раз выше рынка
            </p>
            <div class="benefits-list">
                <div class="benefit-item">
                    <div class="benefit-number">01</div>
                    <div class="benefit-text">
                        <h4>Уникальный продукт</h4>
                        <p>Международный патент. Конкурентов нет. Технологии Invisible + Cer-Sink Full.</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-number">02</div>
                    <div class="benefit-text">
                        <h4>Полный цикл под ключ</h4>
                        <p>Замеры, изготовление, доставка, монтаж — берём всё на себя.</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-number">03</div>
                    <div class="benefit-text">
                        <h4>Гибкие условия</h4>
                        <p>Скидка 40% от розницы. Отсрочка 2 недели. Заказ от 1 изделия.</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-number">04</div>
                    <div class="benefit-text">
                        <h4>Гарантия и надёжность</h4>
                        <p>12 месяцев на изделие, 36 месяцев на индукцию. 12 реализованных проектов.</p>
                    </div>
                </div>
            </div>
            <div class="margin-highlight">
                <div style="font-size: 0.9rem; color: rgba(255,255,255,0.7); margin-bottom: 5px;">Маржа партнёра</div>
                <div class="margin-value">100–250%</div>
                <div style="font-size: 0.9rem; color: rgba(255,255,255,0.7);">vs 30–50% на рынке</div>
            </div>
        </div>

        <!-- Слайд 12: Контакты -->
        <div class="slide slide-12" data-slide="12">
            <h1 class="final-title">Давайте обсудим<br>вашу прибыль</h1>
            <p class="final-subtitle">
                Запишитесь на презентацию-знакомство с дегустацией технологий
            </p>
            
            <div class="contacts-grid">
                <a href="tel:+79029786302" class="contact-item">
                    <div class="contact-label">Телефон</div>
                    <div class="contact-value">8 (902) 978-63-02</div>
                </a>
                <a href="tel:+79837004929" class="contact-item">
                    <div class="contact-label">Телефон</div>
                    <div class="contact-value">8 (983) 700-49-29</div>
                </a>
                <a href="mailto:89029786302@bk.ru" class="contact-item">
                    <div class="contact-label">Email</div>
                    <div class="contact-value" style="font-size: 1rem;">89029786302@bk.ru</div>
                </a>
            </div>

            <div class="messengers">
                <a href="https://wa.me/79029786302" class="messenger-btn btn-whatsapp" target="_blank">
                    <span>💬</span> WhatsApp
                </a>
                <a href="https://t.me/+79029786302" class="messenger-btn btn-telegram" target="_blank">
                    <span>✈️</span> Telegram
                </a>
            </div>

            <a href="tel:+79029786302" class="cta-button">Позвонить сейчас</a>

            <div class="logos-footer">
                <div class="footer-logo gold">Bellezza Tech</div>
                <div>×</div>
                <div class="footer-logo">КАФЕЛЬГРАНИТ</div>
            </div>
        </div>
    </div>

    <!-- Навигация -->
    <div class="nav" id="navDots"></div>
    <div class="nav-arrows">
        <button class="arrow-btn" onclick="prevSlide()" aria-label="Предыдущий слайд">←</button>
        <button class="arrow-btn" onclick="nextSlide()" aria-label="Следующий слайд">→</button>
    </div>

    <!-- Фоновая музыка -->
    <audio id="bgMusic" loop>
        <source src="490d2512635edf2.mp3" type="audio/mpeg">
    </audio>

    <!-- Кнопка управления звуком -->
    <button id="muteBtn" class="mute-btn" onclick="toggleMute()" aria-label="Выключить звук">
        <span id="muteIcon">🔊</span>
    </button>

    <script>
        let currentSlide = 1;
        const totalSlides = 12;
        const bgMusic = document.getElementById('bgMusic');
        const muteBtn = document.getElementById('muteBtn');
        const muteIcon = document.getElementById('muteIcon');
        let isMuted = false;

        function init() {
            const navContainer = document.getElementById('navDots');
            for (let i = 1; i <= totalSlides; i++) {
                const dot = document.createElement('button');
                dot.className = 'nav-btn' + (i === 1 ? ' active' : '');
                dot.onclick = () => goToSlide(i);
                dot.setAttribute('aria-label', 'Слайд ' + i);
                navContainer.appendChild(dot);
            }
            updateSlide();
        }

        function updateSlide() {
            const slides = document.querySelectorAll('.slide');
            const progressBar = document.getElementById('progressBar');
            const currentSlideEl = document.getElementById('currentSlideNum');
            
            slides.forEach((slide, index) => {
                slide.classList.remove('active');
                if (index + 1 === currentSlide) {
                    slide.classList.add('active');
                }
            });

            const dots = document.querySelectorAll('.nav-btn');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index + 1 === currentSlide);
            });

            const progress = (currentSlide / totalSlides) * 100;
            progressBar.style.width = progress + '%';
            currentSlideEl.textContent = currentSlide;
        }

        function nextSlide() {
            if (currentSlide < totalSlides) {
                currentSlide++;
                updateSlide();
            }
        }

        function prevSlide() {
            if (currentSlide > 1) {
                currentSlide--;
                updateSlide();
            }
        }

        function goToSlide(n) {
            currentSlide = n;
            updateSlide();
        }

        function toggleMute() {
            isMuted = !isMuted;
            if (bgMusic) {
                bgMusic.muted = isMuted;
            }
            if (isMuted) {
                muteBtn.classList.add('muted');
                muteIcon.textContent = '🔇';
                muteBtn.setAttribute('aria-label', 'Включить звук');
            } else {
                muteBtn.classList.remove('muted');
                muteIcon.textContent = '🔊';
                muteBtn.setAttribute('aria-label', 'Выключить звук');
            }
        }

        // Клавиатурная навигация
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight' || e.key === ' ' || e.key === 'PageDown') {
                e.preventDefault();
                nextSlide();
            } else if (e.key === 'ArrowLeft' || e.key === 'PageUp') {
                e.preventDefault();
                prevSlide();
            } else if (e.key === 'Home') {
                e.preventDefault();
                goToSlide(1);
            } else if (e.key === 'End') {
                e.preventDefault();
                goToSlide(totalSlides);
            }
        });

        // Свайп на мобильных
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        }, {passive: true});

        document.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, {passive: true});

        function handleSwipe() {
            const swipeThreshold = 50;
            if (touchEndX < touchStartX - swipeThreshold) nextSlide();
            if (touchEndX > touchStartX + swipeThreshold) prevSlide();
        }

        // Автозапуск музыки с обработкой политик браузера
        document.addEventListener('DOMContentLoaded', function() {
            init();
            
            if (bgMusic) {
                bgMusic.volume = 0.3;
                
                // Пытаемся запустить сразу
                const playPromise = bgMusic.play();
                
                if (playPromise !== undefined) {
                    playPromise.catch(error => {
                        console.log('Автозапуск заблокирован, ждём взаимодействия');
                        muteIcon.textContent = '🔇';
                        
                        // Запускаем при любом первом взаимодействии
                        const startAudio = function() {
                            bgMusic.play().then(() => {
                                muteIcon.textContent = '🔊';
                                muteBtn.classList.remove('muted');
                            });
                            document.removeEventListener('click', startAudio);
                            document.removeEventListener('touchstart', startAudio);
                            document.removeEventListener('scroll', startAudio);
                            document.removeEventListener('keydown', startAudio);
                        };
                        
                        document.addEventListener('click', startAudio, { once: true });
                        document.addEventListener('touchstart', startAudio, { once: true });
                        document.addEventListener('scroll', startAudio, { once: true });
                        document.addEventListener('keydown', startAudio, { once: true });
                    });
                }
            }
        });

        // Предотвращение случайного масштабирования на мобильных
        document.addEventListener('gesturestart', function (e) {
            e.preventDefault();
        });
    </script>
</body>
</html>
