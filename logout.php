<?php
session_start();
session_destroy();
setcookie("username", "", time() - 3600, "/");
setcookie("email", "", time() - 3600, "/");
setcookie("password", "", time() - 3600, "/");
header("Location: ./login.php");
exit();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng xuất...</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            text-align: center;
            color: #fff;
        }
        .container {
            padding: 20px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            animation: fadeOut 3s forwards;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        p {
            font-size: 16px;
        }
        @keyframes fadeOut {
            0% { opacity: 1; transform: scale(1); }
            100% { opacity: 0; transform: scale(0.9); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Đang đăng xuất...</h2>
        <p>Bạn sẽ được chuyển về trang đăng nhập trong giây lát.</p>
    </div>
</body>
</html>
<?php include 'footer.php'; 