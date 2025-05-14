<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="UIA - Nơi cung cấp nhiều thể loại truyện">
    <title>UIA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
            background: linear-gradient(to right, #fff, #000);
            -webkit-background-clip: text;
            color: transparent;
        }

        .menu {
            list-style: none;
            display: flex;
            align-items: center;
        }

        .menu li {
            margin: 0 15px;
        }

        .menu a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s ease, text-shadow 0.3s ease;
        }

        .menu a:hover {
            color: #00c6ff;
            text-shadow: 0 0 10px rgba(0, 198, 255, 0.8);
        }

        .container {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
            animation: fadeIn 1s ease-in-out;
            max-width: 600px;
            width: 100%;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 36px;
            font-weight: 600;
            background: linear-gradient(to right, #00c6ff, #fff);
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #fff;
            margin-bottom: 20px;
        }

        .btn {
            padding: 12px 25px;
            font-size: 16px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            margin: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn:focus {
            outline: 2px solid #00c6ff;
            outline-offset: 2px;
        }

        .btn-primary {
            background: linear-gradient(90deg, rgba(0, 200, 255, 0.14), #0072ff);
            color: #fff;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #0072ff, #00c6ff);
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 198, 255, 0.7);
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid #fff;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #fff;
            color: #000;
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.7);
        }

        .btn-toggle-audio {
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.14), #ff4444);
            color: #fff;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .btn-toggle-audio:hover {
            background: linear-gradient(90deg, #ff4444, #ff8888);
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(255, 68, 68, 0.7);
        }

        .btn-toggle-audio.muted {
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.14), #666);
        }

        .btn-toggle-audio.muted:hover {
            background: linear-gradient(90deg, #666, #999);
            box-shadow: 0 0 15px rgba(153, 153, 153, 0.7);
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 10px;
            }

            .menu {
                flex-direction: column;
                margin-top: 10px;
            }

            .menu li {
                margin: 10px 0;
            }

            .container {
                padding: 20px;
                max-width: 90%;
            }

            h1 {
                font-size: 28px;
            }

            p {
                font-size: 16px;
            }

            .btn-toggle-audio {
                bottom: 20px;
                right: 20px;
                padding: 12px 25px;
            }
        }
    </style>
</head>
<body>
    <noscript>
        <p style="color: #ff4444; text-align: center; margin: 1rem;">
            Vui lòng bật JavaScript để sử dụng đầy đủ chức năng của trang.
        </p>
    </noscript>

    <video autoplay loop muted class="video-background" poster="images/fallback-image.jpg" aria-hidden="true">
        <source src="images/98c7ab5b-c2a3-45e5-83f3-475337813ad1.mp4" type="video/mp4">
        Trình duyệt của bạn không hỗ trợ video.
    </video>

    <div class="overlay"></div>

    <nav class="navbar" role="navigation" aria-label="Main navigation">
        <a href="index.php" class="logo">UIA</a>
        <ul class="menu">
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="gioithieu.php">Giới Thiệu</a></li>
            <li><a href="contact.php">Liên Hệ</a></li>
            <li><a href="products.php">Cửa Hàng</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="logout.php">Đăng Xuất</a></li>
            <?php else: ?>
                <li><a href="login.php">Đăng Nhập</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <main class="container">
        <h1>Chào mừng đến với chúng tôi</h1>
        <p>Nơi cung cấp nhiều thể loại truyện</p>
        <button class="btn btn-primary" onclick="location.href='register.php'">Đăng Ký</button>
        <button class="btn btn-secondary" onclick="location.href='login.php'">Đăng Nhập</button>
    </main>

    <button id="toggleAudioButton" class="btn btn-toggle-audio muted" aria-label="Bật âm thanh video">Bật Âm Thanh</button>

    <script>
        const toggleAudioButton = document.getElementById('toggleAudioButton');
        const video = document.querySelector('.video-background');

        if (toggleAudioButton && video) {
            toggleAudioButton.addEventListener('click', () => {
                video.muted = !video.muted;
                toggleAudioButton.textContent = video.muted ? 'Bật Âm Thanh' : 'Tắt Âm Thanh';
                toggleAudioButton.classList.toggle('muted', video.muted);
                toggleAudioButton.setAttribute('aria-label', video.muted ? 'Bật âm thanh video' : 'Tắt âm thanh video');
            });
        }
    </script>

    <?php if (file_exists('footer.php')) include 'footer.php'; ?>
</body>
</html>