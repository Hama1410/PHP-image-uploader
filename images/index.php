<?php
// Handle deletion
if (isset($_GET['delete'])) {
    $fileToDelete = basename($_GET['delete']); // Prevent path traversal
    $filePath = __DIR__ . '/' . $fileToDelete;

    if (file_exists($filePath) && is_file($filePath)) {
        unlink($filePath);
        header("Location: index.php");
        exit();
    }
}

// Get all image files
$images = glob("*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- IMPORTANT for responsiveness -->
    <title>Image Gallery</title>
    <link rel="stylesheet" href="index.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }
        .image-card {
            
            background: #424242;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .image-card:hover {
            transform: scale(1.02);
        }
        img {
            width: 100%;
            height: auto;
            max-height: 250px;
            object-fit: cover;
            filter: blur(20px);
            transition: filter 0.5s ease;
        }
        img.loaded {
            filter: blur(0);
        }
        .buttons {
            margin: 10px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        .buttons a {
            padding: 8px 12px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background 0.3s;
        }
        .buttons a.delete {
            background: #e74c3c;
        }
        .buttons a:hover {
            opacity: 0.9;
        }
        button {
            padding: 10px 15px;
            background: #f74f1e;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        button:hover {
            background: #27ae60;
        }
        @media (max-width: 500px) {
            .buttons a {
                font-size: 12px;
                padding: 6px 10px;
            }
            button {
                font-size: 14px;
                padding: 8px 12px;
            }
        }
    </style>
</head>
<body>
<h1 class="logo all hh"><span>IM</span>AGE<span class="all"> GALLERY</span></h1>
            <br>


<a href="../index.php"><button>Back</button></a>
<br><br>

<div class="gallery">
    <?php foreach ($images as $image): ?>
        <div class="image-card">
            <img src="<?= htmlspecialchars($image) ?>" loading="lazy" alt="Image" onload="this.classList.add('loaded')">
            <div class="buttons">
                <a href="<?= htmlspecialchars($image) ?>" download>Download</a>
                <a href="?delete=<?= urlencode($image) ?>" class="delete" onclick="return confirm('Delete this image?')">Delete</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
