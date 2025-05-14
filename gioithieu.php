<?php
$members = [
    ['name' => 'Võ Nguyễn Trung Hậu', 'role' => 'Chuyên gia phát triển web, đam mê sáng tạo giao diện', 'image' => 'images/nhat-niem-vinh-hang.jpg'],
    ['name' => 'Hoàng Thi Hải', 'role' => 'Quản lý danh mục sản phẩm, đảm bảo chất lượng tối ưu', 'image' => 'images/images.jpg'],
    ['name' => 'Nguyễn Dương Hoài An', 'role' => 'Nhà thiết kế sáng tạo, xây dựng giao diện thân thiện', 'image' => 'images/thach-hao-thuvienanime-17.jpg']
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới Thiệu Thành Viên</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            padding: 80px 20px 20px;
            position: relative;
            overflow-x: hidden;
            background: linear-gradient(135deg, #1a1a1a, #2c3e50);
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 15px 30px;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
            background: linear-gradient(to right, #ffffff, #00c6ff);
            -webkit-background-clip: text;
            color: transparent;
            text-decoration: none;
        }

        .menu {
            list-style: none;
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .menu li {
            position: relative;
        }

        .menu a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .menu a:hover {
            color: #00c6ff;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 10px rgba(0, 198, 255, 0.3);
        }

        .hamburger {
            display: none;
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
        }

        h1 {
            color: white;
            text-align: center;
            margin: 30px 0;
            font-size: 2.5rem;
        }

        .introduction {
            color: white;
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto 40px;
            text-align: center;
            line-height: 1.6;
        }

        .team {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .member {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .member img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #007BFF;
        }

        .member h2 {
            font-size: 1.2rem;
            color: #007BFF;
            margin-bottom: 10px;
        }

        .member p {
            font-size: 0.9rem;
            color: #333;
            line-height: 1.4;
        }

        .member:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
        }

        .unmute-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            z-index: 1000;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 10px 20px;
            }

            .menu {
                display: none;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                background: rgba(0, 0, 0, 0.9);
                flex-direction: column;
                padding: 20px;
            }

            .menu.active {
                display: flex;
            }

            .hamburger {
                display: block;
            }

            h1 {
                font-size: 1.8rem;
            }

            .introduction {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <video class="video-background" autoplay loop muted playsinline>
        <source src="images/98c7ab5b-c2a3-45e5-83f3-475337813ad1.mp4" type="video/mp4">
    </video>
    <div class="overlay"></div>

    <nav class="navbar">
        <a href="index.php" class="logo">UIA</a>
        <span class="hamburger">☰</span>
        <ul class="menu">
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="gioithieu.php">Giới Thiệu</a></li>
            <li><a href="contact.php">Liên Hệ</a></li>
            <li><a href="products.index.php">Cửa Hàng</a></li>
        </ul>
    </nav>

    <h1>Giới Thiệu Thành Viên</h1>
    <p class="introduction">Chào mừng bạn đến với trang giới thiệu đội ngũ của chúng tôi! Chúng tôi là một nhóm các chuyên gia tận tâm trong lĩnh vực công nghệ, thiết kế và quản lý sản phẩm, luôn hướng đến việc mang lại trải nghiệm tốt nhất cho khách hàng.</p>

    <div class="team">
        <?php foreach ($members as $member): ?>
            <div class="member">
                <img src="<?= htmlspecialchars($member['image']) ?>" alt="<?= htmlspecialchars($member['name']) ?>">
                <h2><?= htmlspecialchars($member['name']) ?></h2>
                <p><?= htmlspecialchars($member['role']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <button class="unmute-button" id="unmuteButton">Bật âm thanh</button>

    <script>
        // Hamburger menu toggle
        document.querySelector('.hamburger').addEventListener('click', () => {
            document.querySelector('.menu').classList.toggle('active');
        });

        // Video unmute toggle
        document.getElementById('unmuteButton').addEventListener('click', () => {
            const video = document.querySelector('.video-background');
            video.muted = !video.muted;
            document.getElementById('unmuteButton').textContent = video.muted ? 'Bật âm thanh' : 'Tắt âm thanh';
        });
    </script>

    <?php include 'footer.php'; ?>
</body>
</html>