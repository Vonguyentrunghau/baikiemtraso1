<?php
$members = [
    ['name' => 'Võ Nguyễn Trung Hậu', 'role' => 'THG nghiện tiểu thuyết làm web  ', 'image' => 'images/download.jpg'],
    ['name' => 'Hoàng Thi Hải', 'role' => 'Quản lý danh mục sản phẩm và đảm bảo rằng mọi mặt hàng trên trang web đều đáp ứng tiêu chuẩn chất lượng cao nhất.', 'image' => 'images/7d1e3b455e2156874221bde9e8f0427f.jpg'],
    ['name' => 'Nguyễn Dương Hoài An', 'role' => 'Là một nhà thiết kế sáng tạo, đảm bảo giao diện của trang web không chỉ đẹp mắt mà còn thân thiện"chúa nhát"', 'image' => 'images/download (1).jpg']
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
            transition: all 0.3s ease-in-out;
        }
        body {
            text-align: center;
            padding: 60px;
            animation: fadeIn 1s ease-in-out;
            position: relative;
            overflow: hidden;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }
        h1 {
            color: white;
            margin-bottom: 20px;
        }
        .introduction {
            color: white;
            font-size: 18px;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .team {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .member {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 250px;
            text-align: center;
        }
        .member img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .member h2 {
            font-size: 18px;
            color: #007BFF;
        }
        .member p {
            font-size: 14px;
            color: #666;
        }
        .member:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 15px rgba(0, 123, 255, 0.5);
        }
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
        btn {
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

    </style>
</head>
<body>
<button id="unmuteButton" class="btn btn-primary">Đừng bấm vào</button>

<script>
    document.getElementById("unmuteButton").addEventListener("click", function () {
        let video = document.querySelector(".video-background");
        video.muted = false; // Bỏ tắt tiếng
        video.play(); // Chạy lại video nếu cần
    });
</script>
<video autoplay loop muted class="video-background">
    <source src="images/1.mp4" type="video/mp4">
</video>
<div class="overlay"></div>
<nav class="navbar">
        <a href="images/lich-chieu-phim-tien-nghich-4.jpg" class="logo">UIA</a>
        <ul class="menu">
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="gioithieu.php">Giới Thiệu</a></li>
            <li><a href="contact.php">Liên Hệ</a></li>
            <li><a href="products.index.php">Cửa Hàng</a></li>
        </ul>
    </nav>
<h1>Giới Thiệu Thành Viên</h1>
<p class="introduction">Chào mừng bạn đến với trang giới thiệu đội ngũ của chúng tôi! Chúng tôi là một nhóm các chuyên gia tận tâm trong lĩnh vực công nghệ, thiết kế và marketing, luôn hướng đến việc mang lại trải nghiệm tốt nhất cho khách hàng.</p>

<div class="team">
    <?php foreach ($members as $member): ?>
        <div class="member">
            <img src="<?= $member['image'] ?>" alt="<?= $member['name'] ?>">
            <h2><?= $member['name'] ?></h2>
            <p><?= $member['role'] ?></p>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
<?php include 'footer.php'; 