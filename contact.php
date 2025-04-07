        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST["name"]);
            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
            $subject = htmlspecialchars($_POST["subject"]);
            $message = htmlspecialchars($_POST["message"]);

            if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
                $success = "Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.";
            } else {
                $error = "Vui lòng điền đầy đủ thông tin!";
            }
        }
        ?>

        <!DOCTYPE html>
        <html lang="vi">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Liên Hệ</title>
            <style>
                * {
                    box-sizing: border-box;
                    margin: 0;
                    padding: 0;
                    font-family: "Arial", sans-serif;
                }

                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    background: linear-gradient(135deg, #667eea, #764ba2);
                    animation: fadeIn 1s ease-in-out;
                }

                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(-20px); }
                    to { opacity: 1; transform: translateY(0); }
                }

                /* Form liên hệ */
                .contact-form {
                    width: 50%;
                    padding: 30px;
                }

                h2 {
                    font-size: 26px;
                    color: #333;
                    margin-bottom: 20px;
                    text-align: center;
                }

                .input-group {
                    text-align: left;
                    margin-bottom: 15px;
                }

                label {
                    font-weight: bold;
                    font-size: 14px;
                    color: #555;
                    display: block;
                    margin-bottom: 5px;
                }

                input, textarea {
                    width: 100%;
                    padding: 12px;
                    border: 2px solid #ddd;
                    border-radius: 10px;
                    outline: none;
                    transition: 0.3s;
                }

                input:focus, textarea:focus {
                    border-color: #00c6ff;
                    box-shadow: 0 0 10px rgba(0, 198, 255, 0.5);
                    transform: scale(1.02);
                }

                textarea {
                    height: 120px;
                    resize: none;
                }

                .btn {
                    width: 100%;
                    background: linear-gradient(90deg, #00c6ff, #0072ff);
                    color: white;
                    padding: 12px;
                    border: none;
                    border-radius: 10px;
                    font-size: 16px;
                    cursor: pointer;
                    transition: 0.3s;
                    position: relative;
                    overflow: hidden;
                }

                .btn:hover {
                    background: linear-gradient(90deg, #0072ff, #00c6ff);
                    transform: scale(1.05);
                    box-shadow: 0px 0px 15px rgba(0, 198, 255, 0.7);
                }

                .success {
                    color: green;
                    margin-bottom: 10px;
                    animation: fadeIn 0.5s ease-in-out;
                }

                .error {
                    color: red;
                    margin-bottom: 10px;
                    animation: fadeIn 0.5s ease-in-out;
                }

                /* Điều khoản */
                .terms {
                    width: 50%;
                    padding: 30px;
                    background: #f8f8f8;
                    border-left: 2px solid #ddd;
                    overflow-y: auto;
                }

                .terms h3 {
                    font-size: 22px;
                    margin-bottom: 15px;
                    color: #444;
                }

                .terms p {
                    font-size: 14px;
                    line-height: 1.6;
                    color: #666;
                    margin-bottom: 10px;
                }

                /* Hiệu ứng cuộn */
                .terms {
                    max-height: 400px;
                    overflow-y: auto;
                    scrollbar-width: thin;
                }

                /* Mobile responsive */
                @media (max-width: 768px) {
                    .wrapper {
                        flex-direction: column;
                        width: 90%;
                    }
                    .contact-form, .terms {
                        width: 100%;
                    }
                }
                .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 10px;
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

        .menu li a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .menu li a:hover {
            color: #00c6ff;
        }
                /* Wrapper cho cả form và điều khoản */
.wrapper {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    width: 90%;
    margin: 0 auto;
    gap: 30px; /* Giảm khoảng cách giữa form và điều khoản */
}

/* Form liên hệ */
.contact-form {
    width: 60%;
    padding: 30px;
    background: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

h2 {
    font-size: 26px;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

.input-group {
    text-align: left;
    margin-bottom: 15px;
}

label {
    font-weight: bold;
    font-size: 14px;
    color: #555;
    display: block;
    margin-bottom: 5px;
}

input, textarea {
    width: 100%;
    padding: 12px;
    border: 2px solid #ddd;
    border-radius: 10px;
    outline: none;
    transition: 0.3s;
}

input:focus, textarea:focus {
    border-color: #00c6ff;
    box-shadow: 0 0 10px rgba(0, 198, 255, 0.5);
    transform: scale(1.02);
}

textarea {
    height: 120px;
    resize: none;
}

.btn {
    width: 100%;
    background: linear-gradient(90deg, #00c6ff, #0072ff);
    color: white;
    padding: 12px;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
    position: relative;
    overflow: hidden;
}

.btn:hover {
    background: linear-gradient(90deg, #0072ff, #00c6ff);
    transform: scale(1.05);
    box-shadow: 0px 0px 15px rgba(0, 198, 255, 0.7);
}

.success {
    color: green;
    margin-bottom: 10px;
    animation: fadeIn 0.5s ease-in-out;
}

.error {
    color: red;
    margin-bottom: 10px;
    animation: fadeIn 0.5s ease-in-out;
}

/* Điều khoản */
.terms {
    width: 35%;
    padding: 30px;
    background: #f8f8f8;
    border-left: 2px solid #ddd;
    border-radius: 10px;
    max-height: 400px;
    overflow-y: auto;
}

.terms h3 {
    font-size: 22px;
    margin-bottom: 15px;
    color: #444;
}

.terms p {
    font-size: 14px;
    line-height: 1.6;
    color: #666;
    margin-bottom: 10px;
}

/* Mobile responsive */
@media (max-width: 768px) {
    .wrapper {
        flex-direction: column;
        width: 90%;
    }

    .contact-form, .terms {
        width: 100%;
        margin-bottom: 20px; /* Thêm khoảng cách dưới */
    }
}

            </style>
        </head>
        <body>
        <nav class="navbar">
    <a href="images/55536772-c460-4374-b64e-f5fc5017bedb.jpg" class="logo">UIA</a>
    <ul class="menu">
        <li><a href="index.php">Trang Chủ</a></li>
        <li><a href="gioithieu.php">Giới Thiệu</a></li>
        <li><a href="contact.php">Liên Hệ</a></li>
        <li><a href="products.index.php">Cửa Hàng</a></li>
    </ul>
</nav>
    </nav>
            <div class="wrapper">
                <!-- Form liên hệ -->
                <div class="contact-form">
                    <h2>Liên Hệ Với Chúng Tôi</h2>

                    <?php if (!empty($success)): ?>
                        <p class="success"><?php echo $success; ?></p>
                    <?php elseif (!empty($error)): ?>
                        <p class="error"><?php echo $error; ?></p>
                    <?php endif; ?>

                    <form action="contact.php" method="POST">
                        <div class="input-group">
                            <label for="name">Họ và Tên</label>
                            <input type="text" id="name" name="name" placeholder="Nhập họ tên" required>
                        </div>
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Nhập email" required>
                        </div>
                        <div class="input-group">
                            <label for="subject">Chủ đề</label>
                            <input type="text" id="subject" name="subject" placeholder="Nhập chủ đề" required>
                        </div>
                        <div class="input-group">
                            <label for="message">Nội dung</label>
                            <textarea id="message" name="message" placeholder="Nhập nội dung tin nhắn" required></textarea>
                        </div>
                        <button type="submit" class="btn">Gửi Tin Nhắn</button>
                    </form>
                </div>

                <!-- Điều khoản -->
                <div class="terms">
                    <h3>Điều khoản & Điều kiện</h3>
                    <p><strong>1. Sử dụng dịch vụ:</strong> Khi sử dụng trang web của chúng tôi, bạn đồng ý tuân theo tất cả các điều khoản được liệt kê.</p>
                    <p><strong>2. Bảo mật thông tin:</strong> Chúng tôi cam kết bảo mật thông tin cá nhân của bạn và không chia sẻ với bên thứ ba.</p>
                    <p><strong>3. Quyền hạn:</strong> Chúng tôi có quyền thay đổi, cập nhật nội dung mà không cần thông báo trước.</p>
                    <p><strong>4. Hỗ trợ:</strong> Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ qua email.</p>
                </div>
            </div>

        </body>
        </html>
        <?php include 'footer.php'; 