<?php
$uploadMessage = '';

if (isset($_FILES['image'])) {
    $uploadDir = __DIR__ . '/images/'; // upload to 'images' folder
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $fileType = mime_content_type($_FILES['image']['tmp_name']);

    // Make sure 'images' folder exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (in_array($fileType, $allowedTypes)) {
        $fileName = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName);
        $uploadMessage = "✅ Image uploaded successfully!";
    } else {
        $uploadMessage = "❌ Only JPG, PNG, GIF, and WEBP files are allowed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Image</title>
    <style>
        :root {
            --prtaqali: #a83e1f;
            --prtaqali-kal: #f74f1e;
            --dark: #222222;
            --white: #ffffff;
        }

        @font-face {
            font-family: 'Nrt-bold';
            src: url('NRT-Bd.ttf');
        }

        @font-face {
            font-family: 'logo';
            src: url('headway.ttf');
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Nrt-bold', Arial, sans-serif;
            padding: 20px;
            background: var(--dark);
            color: var(--white);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: var(--white);
            color: var(--dark);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            font-family: 'logo', Arial, sans-serif;
            text-align: center;
            margin-bottom: 20px;
            color: var(--prtaqali);
            font-size: 28px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="file"] {
            padding: 10px;
            border: 2px dashed var(--prtaqali);
            border-radius: 8px;
            background: #fafafa;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="file"]:hover {
            border-color: var(--prtaqali-kal);
        }

        button {
            background: var(--prtaqali);
            color: var(--white);
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            font-family: 'Nrt-bold', Arial, sans-serif;
        }

        button:hover {
            background: var(--prtaqali-kal);
        }

        .message {
            margin: 15px 0;
            padding: 12px;
            border-radius: 8px;
            background: #e0ffe0;
            color: #2d7a2d;
            text-align: center;
            font-weight: bold;
            font-family: 'Nrt-bold', Arial, sans-serif;
        }

        .back-button {
            margin-top: 20px;
            text-align: center;
        }

        .back-button a button {
            width: 100%;
            background: var(--prtaqali);
        }

        @media (max-width: 500px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="container">
<h1 class="logo all hh"><span>Upload</span> New <span class="all">Image</span></h1>
            <br>

    <?php if ($uploadMessage): ?>
        <div class="message"><?php echo $uploadMessage; ?></div>
    <?php endif; ?>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>

    <div class="back-button">
        <a href="index.php"><button type="button">Back to Gallery</button></a>
    </div>
</div>

</body>
</html>
