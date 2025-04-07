<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uia</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Video Background */
        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        /* Lớp phủ tối */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        /* Thanh điều hướng */
        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
            text-decoration: none;
            background: linear-gradient(to right,rgb(255, 255, 255),rgb(0, 0, 0));
            -webkit-background-clip: text;
            color: transparent;
        }

        .menu {
            list-style: none;
            display: flex;
        }

        .menu li {
            margin: 0 15px;
        }

        .menu a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .menu a:hover {
            color: #00c6ff;
            text-shadow: 0px 0px 10px rgba(0, 198, 255, 0.8);
        }

        /* Nội dung chính */
        .container {
            background: rgba(0, 0, 0, 0);
            backdrop-filter: blur(10px);
            padding: 30px;  
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
            animation: fadeIn 1s ease-in-out;
        }

        /* Hiệu ứng mờ dần khi tải trang */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 36px;
            font-weight: 600;
            background: linear-gradient(to right, #00c6ff,rgb(255, 255, 255));
            -webkit-background-clip: text;
            color: transparent;
        }

        p {
            font-size: 18px;
            color: #fff;
            margin-bottom: 20px;
        }

        /* Hiệu ứng nút */
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

        /* Nút chính */
        .btn-primary {
            background: linear-gradient(90deg,rgba(0, 200, 255, 0.14), #0072ff);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #0072ff, #00c6ff);
            transform: scale(1.05);
            box-shadow: 0px 0px 15px rgba(0, 198, 255, 0.7);
        }

        /* Nút phụ */
        .btn-secondary {
            background: transparent;
            border: 2px solid white;
            color: white;
        }

        .btn-secondary:hover {
            background: white;
            color: black;
            transform: scale(1.05);
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.7);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: center;
                padding: 10px;
            }

            .menu {
                flex-direction: column;
                text-align: center;
                margin-top: 10px;
            }

            .menu li {
                margin: 10px 0;
            }

            .container {
                width: 90%;
                padding: 20px;
            }

            h1 {
                font-size: 28px;
            }

            p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <!-- Video nền -->
    <video autoplay loop muted class="video-background">
        <source src="images/1.mp4" type="video/mp4">
    </video>

    <!-- Lớp phủ tối -->
    <div class="overlay"></div>

    <!-- Thanh điều hướng -->
    <nav class="navbar">
        <a href="images/55536772-c460-4374-b64e-f5fc5017bedb.jpg" class="logo">UIA</a>
        <ul class="menu">
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="gioithieu.php">Giới Thiệu</a></li>
            <li><a href="contact.php">Liên Hệ</a></li>
            <li><a href="products.index.php">Cửa Hàng</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="logout.php">Đăng Xuất</a></li>
            <?php else: ?>
                <li><a href="login.php">Đăng Nhập</a></li>
            <?php endif; ?> 
        </ul>
    </nav>

    <!-- Nội dung -->
    <div class="container">
        <h1>Chào mừng đến với chúng tôi</h1>
        <p>Nơi cung cấp nhiều thể loại truyện</p>
        <button class="btn btn-primary" onclick="location.href='register.php'">Đăng Ký</button>
        <button class="btn btn-secondary" onclick="location.href='login.php'">Đăng Nhập</button>
        <button id="unmuteButton" class="btn btn-primary">Đừng bấm vào</button>

<script>
    document.getElementById("unmuteButton").addEventListener("click", function () {
        let video = document.querySelector(".video-background");
        video.muted = false; // Bỏ tắt tiếng
        video.play(); // Chạy lại video nếu cần
    });
</script>

    </div>

</body>
</html>
<?php include 'footer.php'; 