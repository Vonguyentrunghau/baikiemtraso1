<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            transition: all 0.3s ease-in-out;
        }
        body {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h1 {
            font-size: 22px;
            color: #333;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        input, button {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s ease-in-out;
        }
        input:focus {
            border-color: #007BFF;
            box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.5);
            transform: scale(1.02);
        }
        button {
            background: #28a745;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }
        button:hover {
            background: #218838;
            transform: scale(1.05);
            box-shadow: 0px 4px 10px rgba(40, 167, 69, 0.5);
        }
        .btn-back {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-back:hover {
            text-decoration: underline;
            color: #0056b3;
        }
        .image-preview {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 5px;
            display: none;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 5px;
            background: #f8f8f8;
            transform: scale(0.9);
            transition: 0.5s ease-in-out;
        }
        .image-preview.show {
            transform: scale(1);
            opacity: 1;
        }
        
    </style>
</head>
<body>

<div class="container">
    <h1>Thêm Sản Phẩm</h1>
    <form action="products.index.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Tên sản phẩm" required>
        <input type="number" name="price" placeholder="Giá sản phẩm" required>
        <input type="file" id="imageUpload" accept="image/*">
        <img id="imagePreview" class="image-preview">
        <button type="submit">Lưu</button>
    </form>
    <a href="products.index.php" class="btn-back">← Quay lại danh sách</a>
</div>

<script>
    document.getElementById("imageUpload").addEventListener("change", function(event) {
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let img = document.getElementById("imagePreview");
                img.src = e.target.result;
                img.style.display = "block";
                img.classList.add("show");
            };
            reader.readAsDataURL(file);
        }
    });
</script>

</body>
</html>
