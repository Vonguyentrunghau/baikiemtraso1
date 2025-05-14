<?php
session_start();
require 'db_connect.php';

$page_title = "Dashboard";

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch dynamic counts from database
try {
    // Count users
    $stmt = $pdo->query("SELECT COUNT(*) AS count FROM users");
    $user_count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    // Count products (adjust table name if different)
    $stmt = $pdo->query("SELECT COUNT(*) AS count FROM products");
    $product_count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    // Count orders (adjust table name if different)
    $stmt = $pdo->query("SELECT COUNT(*) AS count FROM orders");
    $order_count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
} catch (PDOException $e) {
    // Fallback to static values if database query fails
    $product_count = 150;
    $user_count = 75;
    $order_count = 120;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> - UIA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
            padding: 20px;
            overflow-x: hidden;
        }

        /* Navbar Styles */
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
            z-index: 1000;
            animation: navbarFadeIn 0.5s ease-in;
        }

        @keyframes navbarFadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .logo {
            font-size: 24px;
            font-weight: 600;
            text-transform: uppercase;
            text-decoration: none;
            background: linear-gradient(to right, #fff, #ccc);
            -webkit-background-clip: text;
            color: transparent;
        }

        .menu {
            list-style: none;
            display: flex;
            align-items: center;
        }

        .menu li {
            margin: 0 20px;
        }

        .menu li a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s ease, text-shadow 0.3s ease;
        }

        .menu li a:hover {
            color: #00c6ff;
            text-shadow: 0 0 10px rgba(0, 198, 255, 0.8);
        }

        /* Welcome Section */
        .welcome {
            text-align: center;
            margin-top: 100px;
            margin-bottom: 40px;
            animation: fadeIn 1s ease-out;
        }

        .welcome h2 {
            font-size: 28px;
            font-weight: 600;
            color: #1a73e8;
            background: linear-gradient(to right, #1a73e8, #00c6ff);
            -webkit-background-clip: text;
            color: transparent;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Stats Section */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .stat-box {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #1a73e8, #00c6ff);
        }

        .stat-box i {
            font-size: 40px;
            color: #1a73e8;
            margin-bottom: 15px;
            transition: color 0.3s ease;
        }

        .stat-box:hover i {
            color: #00c6ff;
        }

        .stat-box h3 {
            color: #555;
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .stat-box p {
            font-size: 32px;
            font-weight: 600;
            color: #333;
            background: linear-gradient(to right, #1a73e8, #00c6ff);
            -webkit-background-clip: text;
            color: transparent;
        }

        /* Button */
        .btn {
            display: block;
            width: fit-content;
            margin: 40px auto;
            padding: 15px 30px;
            background: linear-gradient(90deg, #1a73e8, #00c6ff);
            color: #fff;
            text-decoration: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 500;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.5);
            background: linear-gradient(90deg, #00c6ff, #1a73e8);
        }

        /* Responsive Design */
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

            .welcome h2 {
                font-size: 24px;
            }

            .stats {
                padding: 0 15px;
            }

            .stat-box {
                padding: 20px;
            }

            .stat-box p {
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            .welcome h2 {
                font-size: 20px;
            }

            .stat-box i {
                font-size: 32px;
            }

            .stat-box h3 {
                font-size: 16px;
            }

            .stat-box p {
                font-size: 24px;
            }

            .btn {
                padding: 12px 25px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="logo">UIA</a>
        <ul class="menu">
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="gioithieu.php">Giới Thiệu</a></li>
            <li><a href="contact.php">Liên Hệ</a></li>
            <li><a href="products.index.php">Cửa Hàng</a></li>
            <li><a href="logout.php">Đăng Xuất</a></li>
        </ul>
    </nav>

    <div class="welcome">
        <h2>Chào mừng, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    </div>

    <div class="stats">
        <div class="stat-box">
            <i class="fas fa-box-open"></i>
            <h3>Sản phẩm</h3>
            <p><?php echo htmlspecialchars($product_count); ?></p>
        </div>
        <div class="stat-box">
            <i class="fas fa-users"></i>
            <h3>Người dùng</h3>
            <p><?php echo htmlspecialchars($user_count); ?></p>
        </div>
        <div class="stat-box">
            <i class="fas fa-shopping-cart"></i>
            <h3>Đơn hàng</h3>
            <p><?php echo htmlspecialchars($order_count); ?></p>
        </div>  
    </div>

    <a href="products.index.php" class="btn">Xem Danh Sách Sản Phẩm</a>

    <?php if (file_exists('footer.php')) include 'footer.php'; ?>
</body>
</html>