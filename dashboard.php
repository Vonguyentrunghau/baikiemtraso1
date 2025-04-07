<?php
$page_title = "Dashboard";

// Static values for the counts (you can change these as needed)
$product_count = 150;  // Example count for products
$user_count = 75;      // Example count for users
$order_count = 120;    // Example count for orders
?>

<!-- Navbar Section -->
<nav class="navbar">
    <a href="images/55536772-c460-4374-b64e-f5fc5017bedb.jpg" class="logo">UIA</a>
    <ul class="menu">
        <li><a href="index.php">Trang Chủ</a></li>
        <li><a href="gioithieu.php">Giới Thiệu</a></li>
        <li><a href="contact.php">Liên Hệ</a></li>
        <li><a href="products.index.php">Cửa Hàng</a></li>
        <li><a href="logout.php">Đăng Xuất</a></li>
    </ul>
</nav>

<!-- Dashboard Stats -->s
<div class="stats">
    <div class="stat-box">
        <h3>Sản phẩm</h3>
        <p><?php echo $product_count; ?></p>
    </div>
    <div class="stat-box">
        <h3>Người dùng</h3>
        <p><?php echo $user_count; ?></p>
    </div>
    <div class="stat-box">
        <h3>Đơn hàng</h3>
        <p><?php echo $order_count; ?></p>
    </div>  
</div>

<a href="products.index.php" class="btn">Xem Danh Sách Sản Phẩm</a>

<!-- Styles -->
<style>
    /* Navbar Styles */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 2px 0px;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        animation: navbarFadeIn 0.5s ease-in;
    }

    @keyframes navbarFadeIn {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .logo {
        font-size: 22px;
        font-weight: bold;
        color: white;
        text-transform: uppercase;
        text-decoration: none;
        background: linear-gradient(to right, rgb(255, 255, 255), rgb(0, 0, 0));
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

    .menu li a {
        text-decoration: none;
        color: white;
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .menu li a:hover {
        color: #00c6ff;
    }

    /* Stats Section Styles */
    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-top: 100px; /* Add margin to prevent navbar from covering content */
    }

    .stat-box {
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .stat-box:hover {
        transform: translateY(-5px);
    }

    .stat-box h3 {
        color: #666;
        font-size: 16px;
        margin-bottom: 15px;
    }

    .stat-box p {
        font-size: 28px;
        font-weight: bold;
        color: #333;
    }

    .btn {
        display: inline-block;
        padding: 12px 25px;
        background: #1a73e8;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #1557b0;
    }

    @media (max-width: 768px) {
        .stats {
            grid-template-columns: 1fr;
        }
    }
</style>

<?php include 'footer.php'; ?>
